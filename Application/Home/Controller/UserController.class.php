<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{

	public function zone($uid){
		if(!$_SESSION['uid']){ //检查登录
			$this->error("Please log in first.", __APP__);
			exit();
		}
		if($_SESSION['uid'] !== $uid){ //检查是否越权
			redirect(__APP__.'/home/user/zone/uid/'.$_SESSION["uid"]);
			exit();
		}

		$where['uid'] = $uid;

		$emaildata = D('user');
		$ebasedata = $emaildata->where($where)->find();

		$tagsdata = M('utags', null, 'DB_CONFIG1');
		$tbasedata = $tagsdata->where($where)->select();
		//var_dump($tbasedata);

		for ($i = 0; $i < count($tbasedata); $i++){
			$data['tags'] .= "<a href=#><span class='label label-danger' style='display:inline-block;margin-top:5px;'>".$tbasedata[$i]['tags']."</span></a> ";
		}
		//var_dump($data['tags']);

		$data['email'] = $ebasedata['uemail'];
		$data['uname'] = $_SESSION['uname'];
		$data['uid'] = $_SESSION['uid'];

		$this->assign($data);
		$this->display();
	}

	public function resetpwd($uid){
		if($uid != $_SESSION[uid]){
			$this->error("illegal operation!");
			exit();
		}

		if(IS_POST){
			$repwd = D('user');
			$data = $_POST;

			if (!preg_match('/^([a-zA-Z0-9@*#]{6,22})$/', $data['rpassword'])){
				$this->error("The new password is not match the rule.");
				exit();
			}

			$udata['uid'] = $uid;
			$repwdquery = $repwd->where($udata)->find();

			if ($repwdquery['upwd'] == $data['opassword']){
				if ($repwdquery['upwd'] == $data['rpassword']){
					$this->error("your reset password can't be the same as the original password.");
					exit();
				}
				$updpwdre = $repwd->where($udata)->setField('upwd', $data['rpassword']);	

				if ($updpwdre){
					$this->success("Reset password seccessfully!");
				}else{
					$this->error("Reset password failed.");
				}
			}else{
				$this->error("Original password wrong, please check your input.");
			}
		}else{
			redirect(__APP__."/home/user/zone/uid/".$_SESSION['uid']);
		}
	}

	public function changeinfo($uid){
		if($uid != $_SESSION[uid]){
			$this->error("illegal operation!");
			exit();
		}

		$data['uid'] = $_SESSION['uid'];

		if(IS_POST){
			$items = array('email' => 0, 'tags' => 1);

			if($_POST['email']){
				$resetemail = D('user');
			
				if(!$createmail = $resetemail->create()){
					header("Content-type: text/html; charset=utf-8");
	                exit($resetemail->getError());  
				}

				$emailresult = $resetemail->where($data)->find();
				if($emailresult['uemail'] == $createmail['uemail']){
					$items['email'] = 1;
				}else if($resetemail->where($data)->setField('uemail', $createmail['uemail'])){
					$items['email'] = 1;
				}
			}else{
				$this->error("Email can't be blank.");
			}
			//var_dump($_POST);

			if($_POST['newtags']){
				$addtags = M('utags', null, 'DB_CONFIG1');
				$newtags = split(";", $_POST['newtags']);
				$basetags['uid'] = $data['uid'];
				$flag = 1;

				$tagsresult = $addtags->where($data)->select();
				foreach ($newtags as $c){
					foreach ($tagsresult as $key => $value) {
						if(in_array($c, $value)){
							$flag = 0;
							break;
						}
					}
					if ($flag){
						$basetags['tags'] = $c;
						if(!$addtags->add($basetags)){
							$items['tags'] = 0;
							break;
						}
					}
				}
			}

			if(!in_array(0, $items)){
				$this->success("Update information seccessfully!");
			}else{
				$errorlist = array();
				foreach($items as $key => $value){
					if(!$value){
						array_push($errorlist, $key);
					}
				}

				$errorinfo = "Update failed. Please check the following items: ";
				foreach($errorlist as $value){
					$errorinfo .= $value." ";
				}

				$this->error($errorinfo);
			}
		}else{
			redirect(__APP__."/home/user/zone/uid/".$_SESSION['uid']);
		}
	}

	public function updatepic($uid){
		if($uid != $_SESSION[uid]){
			$this->error("illegal operation!");
			exit();
		}

		if(IS_POST){
			$upload = new \Think\Upload();
			$upload->maxSize  = 3145728;
			$upload->saveName = array('uniqid', '');
			$upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath = "./Public/upload/";
			$upload->savePath = '';
			$upload->subName  = array('data', 'Ymd');

			$info = $upload->upload();
			if(!$info){
				$this->error($upload->getError());
			}else{
			 	$pidbar = M('photo_id',    null, 'DB_CONFIG2');
			 	$pudbar = M('photos',      null, 'DB_CONFIG3');
			 	$tagbar = M('photos_tags', null, 'DB_CONFIG3');

			 	$sdata['pid'] = '';
			 	$pidresult = $pidbar->add($sdata);

			 	$sdata['pid'] = (int) $pidresult;
			 	//var_dump($sdata['pid']);
			 	$sdata['photo'] = __ROOT__."/Public/upload".$info['newphoto']['savepath'].$info['newphoto']['savename'];
			 	$sdata['ptime'] = date('Y-m-d', time());
			 	$sdata['uid'] = $uid;
			 	if(!$pudbar->add($sdata)){
			 		$this->error($pudbar->getError());
			 	}

			 	if ($_POST['tags']){
			 		$picaddtags = split(";", $_POST['tags']);
				 	$tdata['pid'] = $sdata['pid'];
				 	foreach ($picaddtags as $value) {
				 		$tdata['tag'] = $value;
				 		if (!$tagbar->add($tdata)){
				 			$this->error($tagbar->getError());
				 			exit();
			 			}
			 		}
				}			 	
				$this->success("Upload successfully!");
			}
		}
	}

	public function upcomment($uid, $pid){
		if($uid != $_SESSION['uid']){
			$this->error("illegal operation!");
			exit();
		}

		if(IS_POST){
			$cominbar = M('comment_id', null, 'DB_CONFIG2');

			if($_POST['optionsRadios']){
				$cindata['cid'] = '';
				$cid = $cominbar->add($cindata);

				$userbar = M('photos_uid_comments', null, 'DB_CONFIG3');
				$cdata['cid'] = (int)$cid;
				$cdata['pid'] = $pid;

				if($_POST['optionsRadios'] == 'option1'){
					$cdata['uid'] = $uid;	
				}				
				$cdata['contents'] = $_POST['comment'];
				$cdata['posttime'] = date("Y-m-d", time());

				if($userbar->add($cdata)){
					$this->success("Post comment successfully!");
				}else{
					$this->error($userbar->getError());
				}
			}else{
				//var_dump($_POST);
				$this->error("Choose your identity frist.");
			}
		}
	}
}
?>