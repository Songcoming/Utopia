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

<body style="padding-top:50px">
<script type="text/javascript" src="/ThinkPHP/Public/js/jquery.js"></script>
<script type="text/javascript" src="/ThinkPHP/Public/js/bootstrap.js"></script>
<!--script type="text/javascript" src="/Public/js/jquery-2.2.0.min.js"></script--> 
<!--script type="text/javascript" src="/Public/js/bootstrap.js"></script-->
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
        <li><a href="#">Log in</a></li>
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
      <form action="/ThinkPHP/index.php/home/search/searchbar" class="navbar-form navbar-left" role="search" method="post">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="searchtext">
    			<select class="form-control" name="searchrange">
      			<option>pictures</option>
      			<option>users</option>
    			</select>
        </div>
        <button type="submit" class="btn btn-default" name="submit">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <!--li><a data-toggle="modal" data-target="#myModal1">Log in</a></li>
        <li><a data-toggle="modal" data-target="#myModal2">Sign in</a></li-->
        <?php echo ($right); ?>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title">Log in</h4>
	    </div>
	    <div class="modal-body">
	      <form action="/ThinkPHP/index.php/home/index/login" method="post" role="form">
	      <div class="form-group">
	        <label for="username">Username</label>
	        <input type="text" class="form-control" name="username" placeholder="Enter username" />
		  </div>
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" name="password" placeholder="Enter password">
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary" name="submit">Log in</button>
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
      <h4 class="modal-title">Sign in</h4>
    </div>
    <div class="modal-body">
      <form action="/ThinkPHP/index.php/home/index/signin" method="post" role="form">
      <div class="form-group">
        <label for="username">Email</label>
        <input type="text" class="form-control" name="email" placeholder="eee@example.com" />
		  </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Enter your username" />
		  </div>
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" name="password" placeholder="Enter your password">
		  </div>
		  <div class="form-group">
		    <label for="password">Repeat Password</label>
		    <input type="password" class="form-control" name="repassword" placeholder="Enter your password again">
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
	    </div>
	    </form>
	  </div>
	</div>
</div>
<div class="jumbotron">
  <div class="container">
    <h1>Horizon <small>Just for One</small></h1>
    <p>What events, what experiences, what associations should we crowd into those last hours as mortal beings, what regrets? </p>
    <p><a class="btn btn-default btn-lg" role="button">Come on!</a></p>
  </div>
</div>
<div class="container">
<?php echo ($sresult); ?>
</div>