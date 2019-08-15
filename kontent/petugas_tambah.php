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
<div class="modal fade" id="modalInfo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informasi</h4>
      </div>
      <div class="modal-body">
        <p id="infoSalah"></p>
      </div>
      <div id="buttonOK" class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
      </div>
	  <div id="buttonKembali" class="modal-footer">
        <a href="<?php echo base_url(); ?>admin/petugas/"><button type="button" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i>  Kembali</button></a>
      </div>
    </div>
  </div>
</div>
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
<div id="statusOK" class="callout callout-info">
	<h4>Berhasil!</h4>
	Tunggu Sebentar Akan Dikembalikan Ke Dashboard....
</div>
<div id="statusBAD" class="callout callout-warning">
	<h4>Kesalahan!</h4>
	Nama Petugas Yang Anda Masukan Mungkin Sudah Ada, Cek Kembali Atau Masukan Petugas Baru.!
</div>
<div id="statusBAD2" class="callout callout-warning">
	<h4>Kesalahan!</h4>
	Username Dan Password Tidak Boleh Kosong Saat Anda Memilih Posisi Administrator Web.!
</div>
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
	$e_id_petugas				= $_POST['id_petugas'];
	$e_posisi_petugas			= $_POST['posisi_petugas'];
	$e_nama_petugas				= $_POST['nama_lengkap'];
	$e_username_petugas  		= $_POST['username_petugas'];
	$e_password_petugas  		= $_POST['password_petugas'];
	$lokasi_file = $_FILES['foto_petugas']['tmp_name'];
		if(!empty($lokasi_file)){
			$e_foto = $e_id_petugas.'_'.$_FILES['foto_petugas']['name'];
			$lokasi_tujuan = '../img/'.$e_foto.'';
			move_uploaded_file($lokasi_file,$lokasi_tujuan);
		}else{
			$e_foto = '../img/default_profile.jpg';
		}
	
	{
if(cek_user('petugas',$e_nama_petugas)=='sama'){
	echo '<script>
				$(document).ready(function(){
					$("#statusBAD").show();
				});
			 </script>';
	}else{
	$q_edit	= 'INSERT INTO petugas VALUES("'.$e_id_petugas.'", "'.$e_username_petugas.'", "'.$e_nama_petugas.'", "'.$e_posisi_petugas.'", "'.$e_foto.'")';
	$p_edit	= mysqli_query(koneksi_global(),$q_edit) or die(mysqli_error());
	if ($p_edit){
		if(strlen($e_username_petugas) == 0 && strlen($e_password_petugas) == 0){
		
		}else if($e_posisi_petugas == "Administrator Web"){
			$nomorlogin = intval(dapatkantotal('login'))+1;
			$q_edit_password 	= 'INSERT INTO login VALUES("'.$nomorlogin.'","'.$e_username_petugas.'","'.md5($e_password_petugas).'")';
			$p_edit_password	= mysqli_query(koneksi_global(),$q_edit_password) or die(mysqli_error());
		}
		echo '<script>
				$(document).ready(function(){
					$("#statusOK").show();
				});
				setTimeout(function(){window.location="'.base_url().'admin/petugas/";}, 1000);
			 </script>';
			}
		}

}
}
?>