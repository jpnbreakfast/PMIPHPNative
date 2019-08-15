<?php
session_start();

include('fungsi.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMI Denpasar | Log In</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="dist/js/jquery.min.js"type="text/javascript"></script>
	<script src="dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$("#gagal").hide();
			$("#berhasil").hide();
			$("#info").hide();
		});
	</script>

</head>

<body class="hold-transition login-page">
<!-- /.Modal -->
<div class="box-body">
<div id="gagal" class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Kesalahan!</h4>
		Pastikan Username dan Password yang dimasukan benar.
</div>

<div id="berhasil" class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Sukses!</h4>
		Mohon Menunggu...
</div>
<div id="info" class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-warning"></i> Info!</h4>
		Username dan Password belum disi.
</div>
</div>
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>PMI</b> Denpasar</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Isikan Infomasi Untuk Masuk</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="fa fa-key form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input class="btn btn-primary btn-block btn-flat" type="submit" name="submit" value="Masuk">
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<?php
 	if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
				$q = 'SELECT * FROM login WHERE username_login="'.$username.'" AND password_login= "'.md5($password).'"';
				$p = mysqli_query($GLOBALS['conn'],$q) or die(mysql_error());
				$n = mysqli_num_rows($p);
				$f = mysqli_fetch_array($p);
				if($n>0){ 
					$_SESSION['sesi']= 'admin';
					$_SESSION['username']= $f['username_login'];	
					echo'
					<script>
						$(document).ready(function(){
							$("#gagal").hide();
							$("#berhasil").show();
							$("#info").hide();
							setTimeout(function(){window.location="'.$url.'admin";}, 1000);
						});
					</script>';
			}elseif(strlen($username) == 0 || strlen($password) == 0){
					echo'
					<script>
						$(document).ready(function(){
							$("#gagal").hide();
							$("#berhasil").hide();
							$("#info").show();
						});
					</script>';
			}else{
					echo'
					<script>
						$(document).ready(function(){
							$("#gagal").show();
							$("#info").hide();
							$("#berhasil").hide();
						});
					</script>';
			}
		}	
 ?>

</body>
</html>
