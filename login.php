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
  <link rel="stylesheet" href="dist/css/bootstrap.css">
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $url; ?>dist/css/sweetalert2.min.css">
  <script src="<?php echo $url; ?>dist/js/jquery.min.js"></script>
  <script src="<?php echo $url; ?>dist/js/sweetalert2.min.js"></script>


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

</head>

<body class="hold-transition login-page">
<!-- /.Modal -->
<div class="box-body">
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
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
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
			$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
				$q = 'SELECT * FROM login WHERE username_login="'.$username.'"';
				$p = mysqli_query($GLOBALS['conn'],$q) or die(mysql_error());
				$n = mysqli_num_rows($p);
				$f = mysqli_fetch_array($p);
				if($n>0){ 
					if (password_verify($password, htmlspecialchars($f['password_login'], ENT_QUOTES, 'UTF-8'))) {
					$_SESSION['sesi']= 'admin';
					$_SESSION['username'] = htmlspecialchars($f['username_login'], ENT_QUOTES, 'UTF-8');	
					echo "<script>
					$(document).ready(function(){
						Swal.fire({
							title: 'Berhasil!',
							text: 'Login Berhasil!,Harap Menungu Halaman Akan Admin Akan Diarahkan!',
							type: 'success',
							showCancelButton: false,
							showConfirmButton: false,
						})
					});
					setTimeout(function(){window.location='".base_url()."/admin';}, 1000);
				 </script>";
			}else{
				echo "
		<script>
		$(document).ready(function () {
				Swal.fire({
					title: 'Gagal!',
					text: 'Login Gagal, Harap Cek Kembali Username dan Password yang Dimasukan!',
					type: 'error',
					showCancelButton: false,
					showConfirmButton: true,
				})
			});
		</script>";
			}
		}else{
			echo "
		<script>
		$(document).ready(function () {
				Swal.fire({
					title: 'Gagal!',
					text: 'Login Gagal, Harap Cek Kembali Username dan Password yang Dimasukan!',
					type: 'error',
					showCancelButton: false,
					showConfirmButton: true,
				})
			});
		</script>";
	}	
}
 ?>

</body>
</html>
