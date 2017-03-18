<?php
namespace Home\Controller;
use Think\Controller;

class SearchController extends Controller{
	public function searchbar(){
		if(isset($_POST['submit'])){
			//var_dump($_POST['searchrange']);
			switch($_POST['searchrange']){
				case 'pictures': 
					redirect(__APP__."/home/search/searchpic/stext/".$_POST['searchtext']."/srange/".$_POST['searchrange']);
					break;
				case 'users': 
					redirect(__APP__."/home/search/searchuser/stext/".$_POST['searchtext']."/srange/".$_POST['searchrange']);
					break;
			}
		}else{
			$this->error("illegal operation.");
		}
	}

	public function searchpic($stext, $srange){
		$navbar = '<li><a data-toggle="modal" data-target="#myModal1">Log in</a></li>
        	<li><a data-toggle="modal" data-target="#myModal2">Sign in</a></li>';
        	//var_dump($_SESSION); 

    	if(isset($_SESSION['uname'])){
	        $navbar = '<li><a href="'.__APP__.'/home/user/zone/uid/'.$_SESSION["uid"].'">Hello, '.$_SESSION["uname"].'</a></li>
	        	<li><a href="'.__APP__.'/home/index/logout">Log out</a></li>';
	    }

	    $data['right'] = $navbar;
	    $data['stext'] = $stext;
	    $data['select'] = "<option selected='selected'>pictures</option><option>users</option>";
	    //$this->assign('right', $navbar);
	    //$this->assign('stext', $stext);

		$pichandle = M('photos_tags', null, 'DB_CONFIG3');
		$picidhandle = M('photos', null, 'DB_CONFIG3');
		$picresult = $pichandle->select();
		//var_dump($picresult);
		$flag = 0;

		foreach($picresult as $v){
			if(preg_match("/^.*".$stext.".*$/", $v['tag'])){
				//var_dump(1);
				$picurl = $picidhandle->where('pid="'.$v['pid'].'"')->getField('photo');
				//var_dump($picurl);
				$data['sresult'] .= "<div class='thumbnail'><a href='".__APP__."/home/show/picshow/pid/".$v['pid']."'><img src='".$picurl."'></a></div>";
				$flag++;
			}
		}
		if (!$flag){
			$data['sresult'] = "<div class='well'><strong>No result.</strong>";
		}else{
			$data['sresult'] = "<div class='well'><strong>Here are the results we found, ".  			$flag." picture(s) for all.</strong></div>".$data['sresult'];
		}
		$this->assign($data);
		$this->display();
	}

	public function searchuser($stext, $srange){
		$navbar = '<li><a data-toggle="modal" data-target="#myModal1">Log in</a></li>
        	<li><a data-toggle="modal" data-target="#myModal2">Sign in</a></li>';
        	//var_dump($_SESSION); 

    	if(isset($_SESSION['uname'])){
	        $navbar = '<li><a href="'.__APP__.'/home/user/zone/uid/'.$_SESSION["uid"].'">Hello, '.$_SESSION["uname"].'</a></li>
	        	<li><a href="'.__APP__.'/home/index/logout">Log out</a></li>';
	    }
	    $data['right'] = $navbar;
	    $data['stext'] = $stext;
	    $data['select'] = "<option>pictures</option><option selected='selected'>users</option>";

	    $usrhandle = M('user', null, 'DB_CONFIG1');
	    $usrresult = $usrhandle->select();	
	    //var_dump($usrresult);    
	    $resultarr = array();
	    $flag = 0;

	    foreach ($usrresult as $v) {
	    	if(preg_match("/^.*".$stext.".*$/", $v['uname'])){
	    		array_push($resultarr, $v['uname']);
	    		$flag = 1;
	    	}    	
	    }
	    //var_dump($resultarr);

	    if(!$flag){
    		$data['sresult'] = "<div class='well'><strong>No result.</strong>";
    	}else{
    		$data['sresult'] = "<div class='well'><strong>Here are the results we found, ".count($resultarr)." user(s) for all.</strong></div><div class='row'>";
    		for ($i = 0; $i < count($resultarr); $i++){
    			if ($i != 0 && ($i % 6) == 0){
    				$data['result'] .= "</div><div class='row'>";
    			}

    			$arrhandle = $usrhandle->where('uname="'.$resultarr[$i].'"')->find();
    			$data['sresult'] .= 
    				"<div class='col-md-2'>
    					<div class='thumbnail'> <a href='#'> <img src='#' /> </a>
        					<div class='caption'>
          						<h3><a href=#>".$resultarr[$i]."</a></h3>
          						<p>".$arrhandle['intro']."</p>
          					</div>
          				</div>
          			</div>";
    		}
    	}
    	$this->assign($data);
    	$this->display();
	}
}
