<?php
$q_kode = dapatkandata('jadwallokasi');

$kodt_baru = '';
$angka_baru = 0;
$kata = 'lokasi';

if (mysqli_num_rows($q_kode)!=0)
	{
		while($r_kode=mysqli_fetch_array($q_kode)){
			$kode = $r_kode['id_jadwallokasi'];
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
<small>Jadwal Dan Lokasi</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Jadwal Dan Lokasi</li>
<li class="active">Tambah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Tambah Jadwal Dan Lokasi</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_lokasi" class="control-label">ID Lokasi</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $kodt_baru; ?>" id="id_lokasi">
			  <input type="hidden" name="id_lokasi" value="<?php echo $kodt_baru;?>">
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="jadwal" class="control-label">Jadwal</label>
			<div>
			<select class="form-control" name="jadwal" id="jadwal" onchange="pilihjadwal();" required>
			<option value="">Pilih Jadwal</option>
			<?php 
			$q	= dapatkandata('jadwal');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
								echo '<option instasi="'.$r['instasi_jadwal'].'" tgl="'.$r['hari_jadwal'].', '.date('j-F-Y',strtotime($r['tanggal_jadwal'])).'"  value="'.$r['id_jadwal'].'">['.$r['id_jadwal'].'] '.$r['instasi_jadwal'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="id_transaksi" class="control-label">Instasi</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" id="instasi_disabled" required>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="id_transaksi" class="control-label">Tanggal</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled"  id="tgl_disabled"  required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="dokter" class="control-label">Dokter</label>
			<div>
			<select class="form-control" name="dokter" required>
			<option value="">Pilih Dokter</option>
			<?php 
			$q	= dapatkandatapetugas('dokter');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] Dr. '.$r['nama_petugas'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="tensi" class="control-label">Tensi</label>
			<div>
			<select class="form-control" name="tensi" required>
			<option value="">Pilih Petugas Tensi</option>
			<?php 
			$q	= dapatkandatapetugas('tensi');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="hb" class="control-label">HB</label>
			<div>
			<select class="form-control" name="hb" required>
			<option value="">Pilih Petugas HB</option>
			<?php 
			$q	= dapatkandatapetugas('hb');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="aftaper" class="control-label">Aftaper</label>
			<div>
			<select class="form-control" name="aftaper" required>
			<option value="">Pilih Petugas Aftaper</option>
			<?php 
			$q	= dapatkandatapetugas('aftaper');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="admin" class="control-label">Admin</label>
			<div>
			<select class="form-control" name="admin" required>
			<option value="">Pilih Petugas Administrasi</option>
			<?php 
			$q	= dapatkandatapetugas('administrator');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  		  <div class="form-group">
			<label for="supir" class="control-label">Supir</label>
			<div>
			<select class="form-control" name="supir" required>
			<option value="">Pilih Supir</option>
			<?php 
			$q	= dapatkandatapetugas('supir');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
							}
						}
			?>
			</select>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url();?>admin/unitdarah/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$t_id_jadwallokasi				= htmlspecialchars($_POST['id_lokasi'], ENT_QUOTES, 'UTF-8');
	$t_id_jadwal					= htmlspecialchars($_POST['jadwal'], ENT_QUOTES, 'UTF-8');
	$t_doketer_jadwallokasi			= htmlspecialchars($_POST['dokter'], ENT_QUOTES, 'UTF-8');
	$t_tensi_jadwallokasi			= htmlspecialchars($_POST['tensi'], ENT_QUOTES, 'UTF-8');
	$t_hb_jadwallokasi				= htmlspecialchars($_POST['hb'], ENT_QUOTES, 'UTF-8');
	$t_aftaper_jadwallokasi			= htmlspecialchars($_POST['aftaper'], ENT_QUOTES, 'UTF-8');
	$t_admin_jadwallokasi			= htmlspecialchars($_POST['admin'], ENT_QUOTES, 'UTF-8');
	$t_supir_jadwallokasi			= htmlspecialchars($_POST['supir'], ENT_QUOTES, 'UTF-8');

	$q_tambah	= 'INSERT INTO jadwallokasi VALUES("'.$t_id_jadwallokasi.'","'.$t_id_jadwal.'","'.$t_doketer_jadwallokasi.'","'.$t_tensi_jadwallokasi.'","'.$t_hb_jadwallokasi.'","'.$t_aftaper_jadwallokasi.'","'.$t_admin_jadwallokasi.'","'.$t_supir_jadwallokasi.'")';
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
				setTimeout(function(){window.location='".base_url()."/admin/jadwallokasi/';}, 1000);
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