<?php
namespace Home\Controller;
use Think\Controller;

class ShowController extends Controller{
	public function picshow($pid){
		$navbar = '<li><a data-toggle="modal" data-target="#myModal1">Log in</a></li>
        	<li><a data-toggle="modal" data-target="#myModal2">Sign in</a></li>';
        	//var_dump($_SESSION); 

    	if(isset($_SESSION['uname'])){
	        $navbar = '<li><a href="'.__APP__.'/home/user/zone/uid/'.$_SESSION["uid"].'">Hello, '.$_SESSION["uname"].'</a></li>
	        	<li><a href="'.__APP__.'/home/index/logout">Log out</a></li>';
	    }

	    $data['right'] = $navbar;

	    $picinfobar =  M('photos', null, 'DB_CONFIG3');
	    $piccombar  =  M('photos_uid_comments', null, 'DB_CONFIG3');
	    $userbar    =  M('user', null, 'DB_CONFIG1');
	    $tagbar     =  M('photos_tags', null, 'DB_CONFIG3');

	    $picinforesult  =  $picinfobar->where('pid="'.$pid.'"')->find();
	    $userresult     =  $userbar->where('uid="'.$picinforesult['uid'].'"')->find();
	    $data['uid']    =  $picinforesult['uid'];
	    $data['photo']  =  $picinforesult['photo'];
	    $data['author'] =  $userresult['uname'];
	    $data['ptime']  =  $picinforesult['ptime'];

	    $tagresult = $tagbar->where('pid="'.$pid.'"')->select();
	    foreach ($tagresult as $v) {
	    	$data['tags'] .= "<a href='".__APP__."/home/search/searchpic/stext/".$v['tag']."/srange/pictures'><span class='label label-danger' style='display:inline-block;margin-top:5px;'>".$v['tag']."</span></a> ";
	    }

	    $piccomresult = $piccombar->where('pid="'.$pid.'"')->select();
	    $data['cnumber'] = count($piccomresult);
	    if(!$data['cnumber']){
	    	$data['comments'] = "<div class='well'>No comments.</div>";
	    }
	    foreach ($piccomresult as $v) {
	    	if($v['uid']){
	    		$caresult = $userbar->where('uid="'.$v['uid'].'"')->getField('uname');
	    		$cauthor = "<a href='".__APP__."/home/show/usershow/uid/".$v['uid']."'>".$caresult."</a>";
	    	}else{
	    		$cauthor = 'Guest';
	    	}
	    	
	    	$data['comments'] .= "<li class='media'> <a href='#' class='pull-left'> <img src=# height='64' width='64'/></a>
      			<div class='media-body'>
                <h4 class='media-heading'>".$cauthor."</h4><h4><small>".$v['posttime']."</small></h4>
        		<p>".$v['contents']."</p>
            	</div></li><hr>";
	    }

	    if($_SESSION['uid']){
	    	$data['cauthor'] = '<label>
	    				    		<input type="radio" name="optionsRadios" value="option1" checked>'.$_SESSION["uname"].'
	    				  		</label>';
	    }
	    $data['pid'] = $pid;
	    $data['cuid'] = $_SESSION['uid'];

	    $this->assign($data);
	    $this->display();
	}

	public function usershow($uid){
		$navbar = '<li><a data-toggle="modal" data-target="#myModal1">Log in</a></li>
        	<li><a data-toggle="modal" data-target="#myModal2">Sign in</a></li>';
        	//var_dump($_SESSION); 

    	if(isset($_SESSION['uname'])){
	        $navbar = '<li><a href="'.__APP__.'/home/user/zone/uid/'.$_SESSION["uid"].'">Hello, '.$_SESSION["uname"].'</a></li>
	        	<li><a href="'.__APP__.'/home/index/logout">Log out</a></li>';
	    }

	    $data['right'] = $navbar;
	    $userbar = M('user', null, 'DB_CONFIG1');
	    $picbar = M('photos', null, 'DB_CONFIG3');

	    $userreuslt = $userbar->where('uid="'.$uid.'"')->find();
	    $data['uname'] = $userreuslt['uname'];
	    $data['uintro'] = $userreuslt['uintro'];

	    $picresult = $picbar->where('uid="'.$uid.'"')->select();
	    foreach ($picresult as $k => $v) {
	    	if (!$k){
	    		$data['picture'] .= '<div class="item active"> <img src="'.$v['photo'].'" width="1366" height="768" alt=""/> </div>';	
	    	}else{
	    		$data['picture'] .= '<div class="item"> <img src="'.$v['photo'].'" width="1366" height="768" alt=""/> </div>';
	    	}	    	
	    }

	    for ($i = 0; $i < count($picresult); $i++){
	    	if(!$i){
	    		$data['pindecator'] .= '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
	    	}else{
	    		$data['pindecator'] .= '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
	    	}	    	
	    }

	    $this->assign($data);
	    $this->display();
	}
}