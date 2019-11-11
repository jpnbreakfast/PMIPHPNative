<?php
$q_kode = dapatkandata('jadwal');

$kode_baru = '';
$angka_baru = 0;
$kata = 'jadwal';

if (mysqli_num_rows($q_kode)!=0)
	{
		while($r_kode=mysqli_fetch_array($q_kode)){
			$kode = $r_kode['id_jadwal'];
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
<div class="modal fade" id="mapModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Lokasi</h4>
		<p class="modal-title">Mungkin Penggunaan Pengisian Alamat Otomtasi Kurang Akurasi, Isikan Manual Jika Alamat Yang Akan Diisi Berdasarkan Tempat Yang Tertentu</p>
      </div>
        <div class="modal-body" id='map-canvas'></div>
      <div id="buttonOK" class="modal-footer">
	  <p id="infoAlamat" style="text-align:left;"></p>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<section class="content-header">
<h1>
Tambah
<small>Jadwal</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Jadwal</li>
<li class="active">Tambah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Tambah Jadwal</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_jadwal" class="control-label">ID Jadwal</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $kode_baru; ?>">
			  <input class="form-control" type="hidden" value="<?php echo $kode_baru; ?>" id="id_jadwal" name="id_jadwal">
			</div>
		  </div>
		  <div class="form-group">
			<label for="target" class="control-label">Target Jumlah</label>
			<div>
			  <input type="number" class="form-control" id="target" name="target" onchange="cekKebenaran('ubah',1,'#target','Pastikan Anda Mengisi Jumlah Target.!')" onkeypress="return hanyaNomor(event)" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="instasi" class="control-label">Instasi</label>
			<div>
			  <input type="text" class="form-control" id="instasi" name="instasi" onchange="cekKebenaran('tambah',1,'#instasi','Pastikan Instasi Terisi.!')" required>
			</div>
		  </div>
		   <div class="form-group">
			<label for="tanggal_jadwal" class="control-label">Tanggal Jadwal</label>
			<div>
			  <input type="date" class="form-control" id="tanggal_jadwal" name="tanggal_jadwal" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="jam_jadwal" class="control-label">Jam Jadwal</label>
			<div>
			  <input type="time" class="form-control" name="jam_jadwal" id="jam_jadwal" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="hari_jadwal" class="control-label">Hari Jadwal</label>
			<div>
			  <select class="form-control" id="hari_jadwal" name="hari_jadwal" required>
			  	<option>Pilih Hari</option>
            	<option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
			</div>
		  </div>
		   <div class="form-group">
			<label for="lokasi_jadwal" class="control-label">Lokasi Jadwal</label>
			<div class="input-group input-group-sm">
			  <input type="text" class="form-control" id="lokasi_jadwal" name="lokasi_jadwal" onchange="cekKebenaran('tambah',1,'#lokasi_jadwal','Pastikan Lokasi Terisi.!')" required> 
			  <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" id="showMap">Cari Lokasi Otomatis</button>
               </span>
			</div>
		  </div>
		  <div class="form-group">
			<label for="kecamatan_jadwal" class="control-label">Kecamatan</label>
			<div>
			  <select class="form-control" id="kecamatan_jadwal" name="kecamatan_jadwal" required>
			  	<option>Pilih Kecamatan</option>
            	<option value="Denpasar Timur">Denpasar Timur</option>
				<option value="Denpasar Selatan">Denpasar Selatan</option>
				<option value="Denpasar Barat">Denpasar Barat</option>
				<option value="Denpasar Utara">Denpasar Utara</option>
            </select>
			</div>
		  </div>
		   <div class="form-group">
			<label for="lat_peta_jadwal" class="control-label">Lattidue Lokasi</label>
			<div>
			  <input type="text" class="form-control" id="lat_peta_jadwal" maxlength="10" name="lat_peta_jadwal" onchange="cekKebenaran('tambah',10,'#lat_peta_jadwal','Pastikan Panjang Lattidue Google Map 10 Baris Angka.!')" required>
			</div>
		  </div>
		   <div class="form-group">
			<label for="lng_peta_jadwal" class="control-label">Longtidue Lokasi</label>
			<div>
			  <input type="text" class="form-control" id="lng_peta_jadwal" maxlength="10" name="lng_peta_jadwal" onchange="cekKebenaran(10,'#lng_peta_jadwal','Pastikan Panjang Longtidue Google Map 10 Baris Angka.!')" required>
			</div>
		  </div>
		   <div class="form-group">
			<label for="link_peta_jadwal" class="control-label">Link Lokasi</label>
			<div>
			  <input type="text" class="form-control" id="link_peta_jadwal" name="link_peta_jadwal" onchange="cekKebenaran(1,'#link_peta_jadwal','Pastikan Link Terisi.!')" required>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url();?>admin/jadwal/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$t_id_jadwal		= htmlspecialchars($_POST['id_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_instasi			= htmlspecialchars($_POST['instasi'], ENT_QUOTES, 'UTF-8');
	$t_target			= htmlspecialchars($_POST['target'], ENT_QUOTES, 'UTF-8');
	$t_tanggal_jadwal 	= htmlspecialchars($_POST['tanggal_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_jam_jadwal  		= htmlspecialchars($_POST['jam_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_hari_jadwal  	= htmlspecialchars($_POST['hari_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_kecamatan 		= htmlspecialchars($_POST['kecamatan_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_lokasi_jadwal 	= htmlspecialchars($_POST['lokasi_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_lat_peta_jadwal 	= htmlspecialchars($_POST['lat_peta_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_lng_peta_jadwal 	= htmlspecialchars($_POST['lng_peta_jadwal'], ENT_QUOTES, 'UTF-8');
	$t_link_peta_jadwal = htmlspecialchars($_POST['link_peta_jadwal'], ENT_QUOTES, 'UTF-8');
	$q_tambah	= 'INSERT INTO jadwal VALUES("'.$t_id_jadwal.'","'.$t_instasi.'","'.$t_target.'","'.$t_tanggal_jadwal.'","'.$t_hari_jadwal.'","'.$t_jam_jadwal.'","'.$t_lokasi_jadwal.'","'.$t_kecamatan.'","'.$t_lat_peta_jadwal.'","'.$t_lng_peta_jadwal.'","'.$t_link_peta_jadwal.'")';
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
				setTimeout(function(){window.location='".base_url()."/admin/jadwal/';}, 1000);
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