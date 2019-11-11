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
<div class="row">
<div class="col-md-3">
  <div class="box box-danger">
	<div class="box-body box-profile">
	  <img class="profile-user-img img-responsive img-circle" src="<?php echo $url.'img/'.htmlspecialchars(dapatkaninfo(username)[2], ENT_QUOTES, 'UTF-8'); ?>" alt="User profile picture">

	  <h3 class="profile-username text-center"><?php echo htmlspecialchars(dapatkaninfo(username)[0], ENT_QUOTES, 'UTF-8'); ?></h3>
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
		$uploadOk = 1;
		$lokasi_file = $_FILES['foto_profile']['tmp_name'];
		if(!empty($lokasi_file)){
			
			$imageFileType = strtolower(pathinfo($_FILES['foto_profile']['name'],PATHINFO_EXTENSION));
			if($imageFileType != "jpg") {
				echo"<script>
				$(document).ready(function(){
					Swal.fire({
						title: 'Kesalahan!',
						text: 'Foto Yang Diperbolehkan Hanya Berformat (.jpg)!',
						type: 'success',
						showCancelButton: false,
						showConfirmButton: true,
					})
				});
			</script>";
					$uploadOk = 0;
			}
			if ($uploadOk != 0) {
				unlink("../img/".dapatkaninfo(username)[2]);
				$e_foto = htmlspecialchars(dapatkaninfo(username)[3], ENT_QUOTES, 'UTF-8').'.jpg';
				$lokasi_tujuan = '../img/'.$e_foto.'';
				move_uploaded_file($lokasi_file,$lokasi_tujuan);
			}else{
				echo"<script>
						$(document).ready(function(){
							Swal.fire({
								title: 'Kesalahan!',
								text: 'Terjadi Kesalahan Dalam Memproses Data!',
								type: 'error',
								showCancelButton: false,
								showConfirmButton: true,
							})
						});
					</script>";
			}
		}else{
			$e_foto = htmlspecialchars(dapatkaninfo(username)[2], ENT_QUOTES, 'UTF-8');
		}
		
		if(!empty(strlen($_POST['nama_profile']))){
			$e_nama = $_POST['nama_profile'];
		}else{
			$e_nama = htmlspecialchars(dapatkaninfo(username)[0], ENT_QUOTES, 'UTF-8');
		}
		if ($uploadOk != 0) {
		$q = 'UPDATE petugas SET nama_petugas="'.$e_nama.'", foto_petugas="'.$e_foto.'" WHERE id_petugas="'.htmlspecialchars(dapatkaninfo(username)[3], ENT_QUOTES, 'UTF-8').'"';
		$p = mysqli_query(koneksi_global(),$q) or die(mysql_error());
		if($p){
			echo"<script>
					$(document).ready(function(){
						Swal.fire({
							title: 'Sukses!',
							text: 'Sukses Mengubah Profile!, Tunggu Sebentar...',
							type: 'success',
							showCancelButton: false,
							showConfirmButton: false,
						})
					});
					setTimeout(function(){window.location = window.location.href;}, 3000);
				</script>";
		}else{
			echo"<script>
					$(document).ready(function(){
						Swal.fire({
							title: 'Kesalahan!',
							text: 'Terjadi Kesalahan Dalam Memproses Data!',
							type: 'error',
							showCancelButton: false,
							showConfirmButton: true,
						})
					});
				</script>";
		}
		}
	}
	if(isset($_POST['submit_password'])){
		$e_pass_lama = htmlspecialchars($_POST['password_lama_profile'], ENT_QUOTES, 'UTF-8');
		$e_pass_baru = htmlspecialchars($_POST['password_baru_verifikasi_profile'], ENT_QUOTES, 'UTF-8');
		$q1 = dapatkandatapilihan('login','username_login',htmlspecialchars(username, ENT_QUOTES, 'UTF-8'));
		if(mysqli_num_rows($q1) != 0){
		$n = mysqli_fetch_array($q1);
		
		$passwordlogin = htmlspecialchars($n['password_login'], ENT_QUOTES, 'UTF-8');
		if(password_verify($passwordlogin)==$e_pass_lama){
			$q = 'UPDATE login SET password_login="'.md5($e_pass_baru).'" WHERE username_login="'.htmlspecialchars(username, ENT_QUOTES, 'UTF-8').'"';
			$p = mysqli_query(koneksi_global(),$q) or die(mysqli_error());
				if($p){
					echo"<script>
						$(document).ready(function(){
							Swal.fire({
								title: 'Sukses!',
								text: 'Sukses Mengubah Profile!, Tunggu Sebentar...',
								type: 'success',
								showCancelButton: false,
								showConfirmButton: false,
							})
						});
						setTimeout(function(){window.location = window.location.href;}, 3000);
					</script>";
				}else{
					echo"<script>
							$(document).ready(function(){
								Swal.fire({
									title: 'Kesalahan!',
									text: 'Terjadi Kesalahan Dalam Memproses Data!',
									type: 'error',
									showCancelButton: false,
									showConfirmButton: true,
								})
							});
						</script>";
				}
			}else{
				echo"<script>
					$(document).ready(function(){
						$(document).ready(function(){
							Swal.fire({
								title: 'Kesalahan!',
								text: 'Terjadi Kesalahan Dalam Memproses Data!',
								type: 'error',
								showCancelButton: false,
								showConfirmButton: true,
							})
					});
				</script>";
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