<?php
$q_kode = dapatkandata('petugas');
$q_kode_login = dapatkandata('login');
$kode_baru = '';
$angka_baru = 0;
$kata = 'petugas';
$kata_login = 'login';
if (mysqli_num_rows($q_kode)!=0)
	{
		while($r_kode=mysqli_fetch_array($q_kode)){
			$kode = $r_kode['id_petugas'];
			$kode_login = $r_kode['id_petugas'];
			$angka_kode = str_replace($kata,'',$kode);
			
			if ($angka_baru<$angka_kode){
			$angka_baru = $angka_kode;
			$angka = $angka_baru+1;
			$kode_baru = $kata.''.$angka;
			}
		}
		}
		
	else
	{
		$kode_baru = $kata.'1';
	}
?>
<script>
	sembunyiform();
</script>
<section class="content-header">
<h1>
Tambah
<small>Petugas</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Petugas</li>
<li class="active">Tambah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Tambah Petugas</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_petugas" class="control-label">ID Petugas</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $kode_baru; ?>" id="id_petugas">
			  <input type="hidden" name="id_petugas" value="<?php echo $kode_baru;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="nama_lengkap" class="control-label">Nama</label>
			<div>
			  <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="posisi_petugas" class="control-label">Posisi</label>
			<div>
			  <select class="form-control" id="posisi_petugas" name="posisi_petugas" onchange="petugas_level()" required>
				<option value="Dokter">Dokter</option>
				<option value="Supir">Supir</option>
				<option value="HB">HB</option>
				<option value="Aftaper">Aftaper</option>
				<option value="Tensi">Tensi</option>
				<option value="Administrator">Administrator</option>
				<option value="Administrator Web">Administrator Web</option>
            </select>
			</div>
		  </div>
		  <div id="username_layout" class="form-group">
			<label for="username_petugas" class="control-label">Username</label>
			<div>
			  <input type="username" class="form-control" id="username_petugas" name="username_petugas">
			</div>
		  </div>
		  <div  id="password_layout" class="form-group">
			<label for="password_petugas" class="control-label">Password</label>
			<div>
			  <input type="password" class="form-control" id="password_petugas" name="password_petugas">
			</div>
		  </div>
		  <div class="form-group">
			<label for="foto_petugas" class="control-label">Foto</label>
			<div>
			  <input type="file" class="form-control" id="foto_petugas" name="foto_petugas">
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url(); ?>admin/petugas/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		  </div>
		  		  </div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$e_id_petugas				= htmlspecialchars($_POST['id_petugas'], ENT_QUOTES, 'UTF-8');
	$e_posisi_petugas			= htmlspecialchars($_POST['posisi_petugas'], ENT_QUOTES, 'UTF-8');
	$e_nama_petugas				= htmlspecialchars($_POST['nama_lengkap'], ENT_QUOTES, 'UTF-8');
	$e_username_petugas  		= htmlspecialchars($_POST['username_petugas'], ENT_QUOTES, 'UTF-8');
	$e_password_petugas  		= htmlspecialchars($_POST['password_petugas'], ENT_QUOTES, 'UTF-8');
	$lokasi_file = $_FILES['foto_petugas']['tmp_name'];
		if(!empty($lokasi_file)){
			$e_foto = $e_id_petugas.'_'.$_FILES['foto_petugas']['name'];
			$lokasi_tujuan = '../img/'.$e_foto.'';
			move_uploaded_file($lokasi_file,$lokasi_tujuan);
		}else{
			$e_foto = 'default_profile.jpg';
		}
	
	{
if(cek_user('petugas',$e_nama_petugas)=='sama'){
	echo "
		<script>
		$(document).ready(function () {
				Swal.fire({
					title: 'Kesalahan!',
					text: 'Kesalahan Dalam Menambah Data!',
					type: 'warning',
					showCancelButton: false,
					showConfirmButton: true,
				})
			});
		</script>";

	}elseif($e_posisi_petugas == "Administrator Web" && strlen($e_username_petugas) == 0 && strlen($e_password_petugas) == 0){
		echo "
				<script>
				$(document).ready(function () {
						Swal.fire({
							title: 'Kesalahan!',
							text: 'Username Dan Password Tidak Boleh Kosong Saat Anda Memilih Posisi Administrator Web.!',
							type: 'warning',
							showCancelButton: false,
							showConfirmButton: true,
						})
					});
				</script>";
		
		
}else{
	$q_edit	= 'INSERT INTO petugas VALUES("'.$e_id_petugas.'", "'.$e_username_petugas.'", "'.$e_nama_petugas.'", "'.$e_posisi_petugas.'", "'.$e_foto.'")';
	$p_edit	= mysqli_query(koneksi_global(),$q_edit) or die(mysqli_error());
	if ($p_edit){
			$nomorlogin = intval(dapatkantotal('login'))+1;
			$q_edit_password 	= 'INSERT INTO login VALUES("'.$nomorlogin.'","'.$e_username_petugas.'","'.password_hash($e_password_petugas, PASSWORD_DEFAULT).'")';
			$p_edit_password	= mysqli_query(koneksi_global(),$q_edit_password) or die(mysqli_error());
		echo "<script>
				$(document).ready(function(){
					Swal.fire({
						title: 'Sukses!',
						text: 'Sukses Menambah Data!,Harap Menungu Halaman Akan Di Refresh!',
						type: 'success',
						showCancelButton: false,
						showConfirmButton: false,
					})
				});
				setTimeout(function(){window.location='".base_url()."/admin/petugas/';}, 1000);
			</script>";
			}else{
				echo "
				<script>
				$(document).ready(function () {
						Swal.fire({
							title: 'Kesalahan!',
							text: 'Kesalahan Dalam Menambah Data!',
							type: 'warning',
							showCancelButton: false,
							showConfirmButton: true,
						})
					});
				</script>";
				}
		}
		

}
}
?>