<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<!--link href="/Public/css/bootstrap.css" rel="stylesheet" type="text/css"-->
<link rel="stylesheet" type="text/css" href="/ThinkPHP/Public/css/bootstrap.css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
 <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
 <![endif]-->
</head>

<body style="padding-top:50px;background-color:black;">
	<script type="text/javascript" src="/ThinkPHP/Public/js/jquery.js"></script>
	<script type="text/javascript" src="/ThinkPHP/Public/js/bootstrap.js"></script>
	<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	  <div class="container-fluid"> 
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	      <a class="navbar-brand" href="#">Brand</a></div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="defaultNavbar1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#">Link<span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	            <li class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#">Welcome back, <?php echo ($uname); ?></a></li>
	        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Persenal Set<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a data-toggle="modal" data-target="#myModal2">information reset</a></li>
	            <li><a data-toggle="modal" data-target="#myModal1">password reset</a></li>
	            <li class="divider"></li>
	            <li><a data-toggle="modal" data-target="#myModal3">Update new photos</a></li>
	            <li class="divider"></li>
	            <li><a href="/ThinkPHP/index.php/home/index/logout">log out</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	    <!-- /.navbar-collapse --> 
	  </div>
	  <!-- /.container-fluid --> 
	</nav>
	<div class="carousel slide" id="myCarousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
		<div class="carousel-inner">
      <div class="item active"> <img src="/ThinkPHP/Public/img/2.jpg" alt="" class="img-responsive center-block"/> </div>
      <div class="item"> <img src="/ThinkPHP/Public/img/3.jpg" alt="" class="img-responsive center-block"/> </div>
      <div class="item"> <img src="/ThinkPHP/Public/img/4.jpg" alt="" class="img-responsive center-block"/> </div>
		</div>
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>

	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title">Password reset</h4>
	    </div>
	    <div class="modal-body">
	      <form action="/ThinkPHP/index.php/home/user/resetpwd/uid/<?php echo ($uid); ?>" method="post" role="form">
	      <div class="form-group">
	        <label for="username">Original password</label>
	        <input type="text" class="form-control" name="opassword" placeholder="Original password" />
		  </div>
		  <div class="form-group">
		    <label for="password">Reset password</label>
		    <input type="password" class="form-control" name="rpassword" placeholder="Reset password">
		  </div>
		  <div class="form-group">
		    <label for="password">Repeat reset password</label>
		    <input type="password" class="form-control" name="rrpassword" placeholder="Repeat reset password">
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
	    </div>
	    </form>
	  </div>
	</div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Change personal information</h4>
    </div>
    <div class="modal-body">
      <form action="/ThinkPHP/index.php/home/user/changeinfo/uid/<?php echo ($uid); ?>" method="post" role="form">
      <div class="form-group">
        <label for="username">Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo ($email); ?>" />
		  </div>
      <div class="form-group">
        <label for="username">concened tags</label>
        <input type="text" class="form-control" name="newtags" placeholder="Enter your new tags splited by ;" />
        <h6>The tags you are interested in:</h6>
        <?php echo ($tags); ?>
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
	    </div>
	    </form>
	  </div>
	</div>
</div>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title">Update new photos</h4>
	    </div>
	    <div class="modal-body">
	      <form action="/ThinkPHP/index.php/home/user/updatepic/uid/<?php echo ($uid); ?>" method="post" role="form" enctype="multipart/form-data">
	      <div class="form-group">
	        <label for="photo">Choose your photos:</label>
	        <input type="file" name="newphoto" id="photo" />
	        <p class="help-block">Only jpg, png, gif are available.</p>
		  </div>
		  <div class="form-group">
		    <label for="tags">Add tags for new photo:</label>
		    <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter your new tags splited by ;">
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
	    </div>
	    </form>
	  </div>
	</div>
</div>
</body>