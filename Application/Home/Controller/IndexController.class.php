<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$navbar = '<li><a data-toggle="modal" data-target="#myModal1">Log in</a></li>
        	<li><a data-toggle="modal" data-target="#myModal2">Sign in</a></li>';
        	//var_dump($_SESSION); 

    	if(isset($_SESSION['uname'])){
	        $navbar = '<li><a href="'.__APP__.'/home/user/zone/uid/'.$_SESSION["uid"].'">Hello, '.$_SESSION["uname"].'</a></li>
	        	<li><a href="'.__APP__.'/home/index/logout">Log out</a></li>';
	    }
	    $this->assign('right', $navbar);
	    $this->display();
    }

    public function login(){
    	if (IS_POST){
    		$login = D('user');

    		if (!$data = $login->create()){
    			//var_dump("damn");
                header("Content-type: text/html; charset=utf-8");
                exit($login->getError());    			
    		}

    		//var_dump($data);
    		$where = array();
    		$where['uname'] = $data['uname'];
    		//var_dump($where['uname']);
    		$result = $login->where($where)->find();
    		//var_dump($result);
    		if ($result && $result['upwd'] == $data['upwd']){
    			session('uid',    $result['uid']);
    			session('uname',  $result['uname']);
    			session('ugroup', $result['ugroup']);
    			session('uflag',  $result['uflag']);
    			$this->success("Login successfully.");
    		} else {
    			$this->error("Login failed, please try again.");
    		}
    	} else {
    		$this->display();
    	}
    }

    public function signin(){
    	if(IS_POST){
    		$user = D('user');
    		//var_dump($_POST);

    		if(!$data = $user->create($_POST, 4)){
    			header("Content-type: text/html; charset=utf-8");
    			exit($user->getError());
    		}

    		if($id = $user->add($data)){
    			$result = $user->where($data)->setField(array("uflag" => 300, "ugroup" => "101"));
    			//var_dump($result);
    			$this->success("Registing successfully!");
    		}else{
    			$this->error("Registing failed, please check your data and try again.");
    		}
    	}else{
    		$this->display();
    	}
    }

    public function logout(){
    	session(null);
    	if(!$_SESSION){
    		$this->success("Log out successfully!");
    	}else{
    		$this->error("Log out error...");
    	}
    }
}
?>