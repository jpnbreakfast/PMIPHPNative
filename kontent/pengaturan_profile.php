<script>
	sembunyiform();
</script>
<section class="content-header">
<h1>
Pengaturan Profile
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Pengaturan Profile</li>
</ol>
</section>
<section class="content">
<div id="statusOK" class="callout ">
	<h4 id="judulInfo">Berhasil!</h4>
	<p id="isiInfo"></p>
</div>
<div class="row">
<div class="col-md-3">
  <div class="box box-danger">
	<div class="box-body box-profile">
	  <img class="profile-user-img img-responsive img-circle" src="<?php echo $url.'img/'.dapatkaninfo(username)[2]; ?>" alt="User profile picture">

	  <h3 class="profile-username text-center"><?php echo dapatkaninfo(username)[0]; ?></h3>
	  <p class="text-muted text-center">Administrator</p>
	</div>
  </div>

</div>
<div class="col-md-9">
  <div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
	  <li><a href="#password" data-toggle="tab">Password</a></li>
	</ul>
	<div class="tab-content">
	  <div class="active tab-pane" id="profile">
	  <div class="tab-pane" id="profile">
		<form method="post" enctype="multipart/form-data" class="form-horizontal">
		  <div class="form-group">
			<label for="nama_profile" class="col-sm-2 control-label">Nama</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="nama_profile" name="nama_profile">
			</div>
		  </div>
		  <div class="form-group">
			<label for="username_profile" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="username_profile" name="username_profile">
			</div>
		  </div>
		  <div class="form-group">
			<label for="foto_profile" class="col-sm-2 control-label">Foto Profile</label>
			<div class="col-sm-10">
			  <input type="file" class="form-control" id="foto_profile" name="foto_profile">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" name="submit_profile" class="btn btn-danger"><i class="fa fa-save"></i> Ubah</button>
			</div>
		  </div>
		</form>
	  </div>
	</div>
	
	
	  <div class="tab-pane" id="password">
		<form method="post" enctype="multipart/form-data" class="form-horizontal">
		  <div class="form-group">
			<label for="password_lama_profile" class="col-sm-2 control-label">Password Lama</label>

			<div class="col-sm-10">
			  <input type="password" class="form-control" id="password_lama_profile" name="password_lama_profile" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="password_baru_profile" class="col-sm-2 control-label">Password Baru</label>

			<div class="col-sm-10">
			  <input type="password" class="form-control" id="password_baru_profile" name="password_baru_profile" required>
			</div>
		  </div>
		  <div id="verif_password" class="form-group">
			<label for="password_baru_verifikasi_profile" class="col-sm-2 control-label">Verifikasi Password Baru</label>

			<div class="col-sm-10">
			  <input type="password" class="form-control" id="password_baru_verifikasi_profile"name="password_baru_verifikasi_profile" required>
			  <span id="statuspassword" class="help-block"></span>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" name="submit_password" class="btn btn-danger"><i class="fa fa-save"></i> Ubah</button>
			</div>
		  </div>
		</form>
	  </div>
  </div>
</div>
</div>
</section>
<?php
	if(isset($_POST['submit_profile'])){
		$lokasi_file = $_FILES['foto_profile']['tmp_name'];
		if(!empty($lokasi_file)){
			$e_foto = dapatkaninfo(username)[3].'_'.$_FILES['foto_profile']['name'];
			$lokasi_tujuan = '../img/'.$e_foto.'';
			move_uploaded_file($lokasi_file,$lokasi_tujuan);
		}else{
			$e_foto = dapatkaninfo(username)[2];
		}
		
		if(!empty(strlen($_POST['nama_profile']))){
			$e_nama = $_POST['nama_profile'];
		}else{
			$e_nama = dapatkaninfo(username)[0];
		}
		
		$q = 'UPDATE petugas SET nama_petugas="'.$e_nama.'", foto_petugas="'.$e_foto.'" WHERE id_petugas="'.dapatkaninfo(username)[3].'"';
		$p = mysqli_query(koneksi_global(),$q) or die(mysql_error());
		if($p){
			echo'<script>
					$(document).ready(function(){
						calloutInfo("berhasil","Berhasil!","Harap Tunggu...");
					});
					setTimeout(function(){window.location = window.location.href;}, 3000);
				</script>';
		}
	}
	if(isset($_POST['submit_password'])){
		$e_pass_lama = $_POST['password_lama_profile'];
		$e_pass_baru = $_POST['password_baru_verifikasi_profile'];
		$q1 = dapatkandatapilihan('login','username_login',username);
		if(mysqli_num_rows($q1) != 0){
		$n = mysqli_fetch_array($q1);
		
		$passwordlogin = $n['password_login'];
		if(strtolower($passwordlogin)==md5($e_pass_lama)){
			$q = 'UPDATE login SET password_login="'.md5($e_pass_baru).'" WHERE username_login="'.username.'"';
			$p = mysqli_query(koneksi_global(),$q) or die(mysqli_error());
				if($p){
					echo'<script>
						$(document).ready(function(){
							calloutInfo("berhasil","Berhasil!","Harap Tunggu...");
						});
						setTimeout(function(){window.location = window.location.href;}, 3000);
					</script>';
				}
			}else{
				echo'<script>
					$(document).ready(function(){
						calloutInfo("gagal","Gagal!","Password Lama Yang Anda Masukan Salah. <br/> Cek Kembali Password Anda :D");
					});
				</script>';
			}
		}
	}
echo mysqli_error(koneksi_global());
?>
<script>
$(document).ready(function () {
   $("#password_baru_verifikasi_profile").keyup(cekpassword);
});
</script>