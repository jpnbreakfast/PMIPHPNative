<?php
$q_kode = dapatkandata('pendonor');
$kodt_baru = '';
$angka_baru = 0;
$kata = '5171DG545MA';

if (mysqli_num_rows($q_kode)!=0)
	{
		while($r_kode=mysqli_fetch_array($q_kode)){
			$kode = $r_kode['id_pendonor'];
			$angka_kode = str_replace($kata,'',$kode);
			
			if ($angka_baru<$angka_kode){
			$angka_baru = $angka_kode;
			$angka = $angka_baru+1;
			$kodt_baru = $kata.''.$angka;
			}
		}
	}
		
	else
	{
		$kodt_baru = $kata.'1';
	}
?>
<script>
	sembunyiform();
	function cekKebenaran(halaman,batas,idelement,pesan){
    var value = $(idelement).val().length;
    if (value < batas){
		$("#infoSalah").html(pesan);
		$("#modalInfo").modal();
		$("#buttonKembali").hide();
    }else{
		if(halaman=='ubah'){
			$("#buttonKembali").show();
		}else{
			
		}
	}
}
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
    </div>
  </div>
</div>
<section class="content-header">
<h1>
Tambah
<small>Pendonor</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Pendonor</li>
<li class="active">Tambah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Tambah Pendonor</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_pendonor" class="control-label">ID Pendonor</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $kodt_baru; ?>" id="id_pendonor">
			  <input type="hidden" name="id_pendonor" value="<?php echo $kodt_baru;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="nama_lengkap" class="control-label">Nama</label>
			<div>
			  <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
			<div>
			  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
					<option value="Laki-Laki">Laki-Laki</option>
					<option value="Perempuan">Perempuan</option>
            </select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="tanggal_lahir" class="control-label">Tanggal Lahir</label>
			<div>
			  <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="tempat_lahir" class="control-label">Tempat Lahir</label>
			<div>
			  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="alamat" class="control-label">Alamat</label>
			<div>
			  <input type="text" class="form-control" id="alamat" name="alamat" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="pekerjaan" class="control-label">Pekerjaan</label>
			<div>
			  <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="golongan_darah" class="control-label">Golongan Darah</label>
			<div>
			   <select class="form-control" id="golongan_darah" name="golongan_darah" required>
					<option value="">Pilih Golongan Darah</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="O">O</option>
					<option value="AB">AB</option>
            </select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="nomor_telepon" class="control-label">Nomor Telepon</label>
			<div>
			  <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url(); ?>admin/pendonor/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$t_id_pendonor				= htmlspecialchars($_POST['id_pendonor'], ENT_QUOTES, 'UTF-8');
	$t_nama_lengkap_pendonor	= htmlspecialchars($_POST['nama_lengkap'], ENT_QUOTES, 'UTF-8');
	$t_jenis_kelamin_pendonor  	= htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES, 'UTF-8');
	$t_tanggal_lahir_pendonor  	= htmlspecialchars($_POST['tanggal_lahir'], ENT_QUOTES, 'UTF-8');
	$t_tempat_lahir_pendonor 	= htmlspecialchars($_POST['tempat_lahir'], ENT_QUOTES, 'UTF-8');
	$t_alamat_pendonor 			= htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8');
	$t_pekerjaan_pendonor 		= htmlspecialchars($_POST['pekerjaan'], ENT_QUOTES, 'UTF-8');
	$t_golongan_darah_pendonor	= htmlspecialchars($_POST['golongan_darah'], ENT_QUOTES, 'UTF-8');
	$t_no_telp_pendonor 		= htmlspecialchars($_POST['nomor_telepon'], ENT_QUOTES, 'UTF-8');
	$q_tambah	= 'INSERT INTO pendonor VALUES("'.$t_id_pendonor.'","'.$t_nama_lengkap_pendonor.'","'.$t_jenis_kelamin_pendonor.'","'.$t_tanggal_lahir_pendonor.'","'.$t_tempat_lahir_pendonor.'","'.$t_alamat_pendonor.'","'.$t_pekerjaan_pendonor.'","'.$t_golongan_darah_pendonor.'","'.$t_no_telp_pendonor.'")';
	$q_tambah	= mysqli_query(koneksi_global(),$q_tambah) or die(mysqli_error());
	if ($q_tambah){
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
		setTimeout(function(){window.location='".base_url()."/admin/pendonor/';}, 1000);
	 </script>";
}else{
echo "<script>
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
?>