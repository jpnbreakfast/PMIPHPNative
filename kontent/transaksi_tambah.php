<?php
$q_kode = dapatkandata('transaksi');

$kode_baru = '';
$angka_baru = 0;
$kata = 'transaksi';

if (mysqli_num_rows($q_kode)!=0)
	{
		while($r_kode=mysqli_fetch_array($q_kode)){
			$kode = $r_kode['id_transaksi'];
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
<small>Transaksi</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Transaksi</li>
<li class="active">Tambah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Tambah Transaksi</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_transaksi" class="control-label">ID Transaksi</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $kode_baru; ?>" required>
			  <input class="form-control" type="hidden" value="<?php echo $kode_baru; ?>" id="id_transaksi" name="id_transaksi">
			</div>
		  </div>
		  <div class="form-group">
			<label for="id_pendonor" class="control-label">ID Pendonor</label>
			<div>
			<select class="form-control" name="id_pendonor" id="id_pendonor" onchange="pilihpendonor();" required>
			<option namapendonor=""  value="">Pilih Pendonor</option>
			<?php 
			$q	= dapatkandatadistinct('id_pendonor','nama_lengkap_pendonor','daftarpendonorunitdarah');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
								$pil_id_pendonor 			= htmlspecialchars($r['id_pendonor'], ENT_QUOTES, 'UTF-8');
								$pil_nama_lengkap_pendonor 	= htmlspecialchars($r['nama_lengkap_pendonor'], ENT_QUOTES, 'UTF-8');
							echo '<option namapendonor="'.$pil_nama_lengkap_pendonor.'" identitas="'.$pil_id_pendonor.'"  value="'.$pil_id_pendonor.'">['.$pil_id_pendonor.']&nbsp;'.$pil_nama_lengkap_pendonor.'</option>';
							}
						}
			echo "</select>";
			?>
			</div>
		  </div>
		  <div class="form-group">
			<label for="nama_pendonor_disabled" class="control-label">Nama Pendonor</label>
			<div>
			  <input type="text" id="nama_pendonor_disabled" class="form-control" disabled="disabled" required>
			  <input class="form-control" id="nama_pendonor" type="hidden" name="nama_pendonor">
			</div>
		  </div>
		  <div class="form-group">
			<label for="nomor_kantong_darah" class="control-label">Nomor Kantong Darah</label>
			<div>
			<select class="form-control" id="nomor_kantong_darah" name="nomor_kantong_darah" onchange="pilihgoldar();" required>
			<option  disabled="disabled"  value="">Pilih Kantong Darah</option>
			</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="gol_dar_disabled" class="control-label">Golongan Darah</label>
			<div>
			  <input type="text" id="gol_dar_disabled" class="form-control" disabled="disabled" required>
			  <input class="form-control" id="gol_dar" type="hidden" name="gol_dar">
			</div>
		  </div>
		  <div class="form-group">
			<label for="id_jadwal" class="control-label">Jadwal</label>
			<div>
			<select class="form-control" name="id_jadwal" id="id_jadwal" onchange="pilihjadwal2();" required>
			<option idjad=""  value="">Pilih Jadwal</option>
			<?php 
			$q	= dapatkandata('jadwal');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
								$pil_id_jadwal 		= htmlspecialchars($r['id_jadwal'], ENT_QUOTES, 'UTF-8');
								$pil_instasi_jadwal = htmlspecialchars($r['instasi_jadwal'], ENT_QUOTES, 'UTF-8');
								$pil_tanggal_jadwal = htmlspecialchars($r['tanggal_jadwal'], ENT_QUOTES, 'UTF-8');
							echo '<option instasi="'.$pil_instasi_jadwal.'" tanggal_jadwal="'.$pil_tanggal_jadwal.'"  value="'.$pil_id_jadwal.'">['.$pil_instasi_jadwal.']&nbsp;'.$pil_tanggal_jadwal.'</option>';
							}
						}
			echo "</select>";
			?>
			</div>
		  </div>
		  <div class="form-group">
			<label for="tanggal_disabled" class="control-label">Tanggal</label>
			<div>
			  <input type="text" id="tanggal_disabled" class="form-control" disabled="disabled" >
			  <input class="form-control" id="tanggal" type="hidden" name="tanggal">
			</div>
		  </div>
		  <div class="form-group">
			<label for="pengambilan" class="control-label">Pengambilan</label>
			<div>
			  <select class="form-control" id="pengambilan" name="pengambilan" required>
				<option value="">Pilih Cara Pengambilan Darah</option>
            	<option value="Biasa">Biasa</option>
                <option value="Apheresis">Apheresis</option>
            </select>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url(); ?>admin/transaksi/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$t_id_transaksi			= htmlspecialchars($_POST['id_transaksi'], ENT_QUOTES, 'UTF-8');
	$t_id_pendonor			= htmlspecialchars($_POST['id_pendonor'], ENT_QUOTES, 'UTF-8');
	$t_nama_pendonor		= htmlspecialchars($_POST['nama_pendonor'], ENT_QUOTES, 'UTF-8');
	$t_nomor_kantong_darah 	= htmlspecialchars($_POST['nomor_kantong_darah'], ENT_QUOTES, 'UTF-8');
	$t_gol_dar  			= htmlspecialchars($_POST['gol_dar'], ENT_QUOTES, 'UTF-8');
	$t_id_jadwal  			= htmlspecialchars($_POST['id_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_tanggal 				= htmlspecialchars($_POST['tanggal'], ENT_QUOTES, 'UTF-8');
	$t_pengambilan 			= htmlspecialchars($_POST['pengambilan'], ENT_QUOTES, 'UTF-8');
	$q_tambah	= 'INSERT INTO transaksi VALUES("'.$t_id_transaksi.'","'.$t_id_pendonor.'","'.dapatkaninfo(username)[3].'" ,"'.$t_nama_pendonor.'","'.$t_nomor_kantong_darah.'","'.$t_gol_dar.'","'.$t_id_jadwal.'","'.$t_tanggal.'","'.$t_pengambilan.'")';
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
		setTimeout(function(){window.location='".base_url()."/admin/transaksi/';}, 1000);
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
?>