<?php
if(isset($_GET['id'])){
	$query = dapatkandatapilihan($_GET['halaman'],'id_jadwallokasi',$_GET['id']);
	if(mysqli_num_rows($query) != 0){
		$r = mysqli_fetch_array($query);
		$id_jadwallokasi			= $r['id_jadwallokasi'];
		$id_jadwal					= $r['id_jadwal'];
		$doketer_jadwallokasi		= $r['doketer_jadwallokasi'];
		$tensi_jadwallokasi 		= $r['tensi_jadwallokasi'];
		$hb_jadwallokasi 			= $r['hb_jadwallokasi'];
		$aftaper_jadwallokasi 		= $r['aftaper_jadwallokasi'];
		$admin_jadwallokasi			= $r['admin_jadwallokasi'];
		$supir_jadwallokasi			= $r['supir_jadwallokasi'];
	}else{
		$id_jadwallokasi			= '';
		$id_jadwal					= '';
		$doketer_jadwallokasi		= '';
		$tensi_jadwallokasi 		= '';
		$hb_jadwallokasi 			= '';
		$aftaper_jadwallokasi 		= '';
		$admin_jadwallokasi			= '';
		$supir_jadwallokasi			= '';
		echo'
		<script>
			$(document).ready(function () {
				$("#infoSalah").html("Data Yang Dipilih Salah!");
				$("#modalInfo").modal();
				$("#buttonKembali").show();
				$("#buttonOK").hide();
			});
		</script>';
	}
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
<div id="statusOK" class="callout callout-info">
	<h4>Berhasil!</h4>
	Tunggu Sebentar Akan Dikembalikan Ke Dashboard....
</div>
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Tambah Jadwal Dan Lokasi</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_lokasi" class="control-label">ID Lokasi</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $id_jadwallokasi; ?>" id="id_lokasi">
			  <input type="hidden" name="id_lokasi" value="<?php echo $id_jadwallokasi;?>">
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
								if($id_jadwal == $r['id_jadwal']){
									echo '<option selected="selected" instasi="'.$r['instasi_jadwal'].'" tgl="'.$r['hari_jadwal'].', '.date('j-F-Y',strtotime($r['tanggal_jadwal'])).'"  value="'.$r['id_jadwal'].'">['.$r['id_jadwal'].'] '.$r['instasi_jadwal'].'</option>';
								}else{
									echo '<option instasi="'.$r['instasi_jadwal'].'" tgl="'.$r['hari_jadwal'].', '.date('j-F-Y',strtotime($r['tanggal_jadwal'])).'"  value="'.$r['id_jadwal'].'">['.$r['id_jadwal'].'] '.$r['instasi_jadwal'].'</option>';
								}
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
								if($doketer_jadwallokasi == $r['nama_petugas']){
									echo '<option selected="selected"  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] Dr. '.$r['nama_petugas'].'</option>';
								}else{
									echo '<option  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] Dr. '.$r['nama_petugas'].'</option>';
								}
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
								if($tensi_jadwallokasi == $r['nama_petugas']){
									echo '<option selected="selected"  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}else{
									echo '<option value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}	
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
								if($hb_jadwallokasi == $r['nama_petugas']){
									echo '<option selected="selected"  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}else{
									echo '<option value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}	
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
								if($aftaper_jadwallokasi == $r['nama_petugas']){
									echo '<option selected="selected"  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}else{
									echo '<option value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}	
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
							if($admin_jadwallokasi == $r['nama_petugas']){
									echo '<option selected="selected"  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}else{
									echo '<option value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}	
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
								if($supir_jadwallokasi == $r['nama_petugas']){
									echo '<option selected="selected"  value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}else{
									echo '<option value="'.$r['nama_petugas'].'">['.$r['id_petugas'].'] '.$r['nama_petugas'].'</option>';
								}	
							}
						}
			?>
			</select>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url();?>admin/jadwallokasi/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-save"></i> Ubah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>
<script>
pilihjadwal();
</script>
<?php
if (isset($_POST['submit'])){  
	$e_id_jadwallokasi				= $_POST['id_lokasi'];
	$e_id_jadwal					= $_POST['jadwal'];
	$e_doketer_jadwallokasi			= $_POST['dokter'];
	$e_tensi_jadwallokasi			= $_POST['tensi'];
	$e_hb_jadwallokasi				= $_POST['hb'];
	$e_aftaper_jadwallokasi			= $_POST['aftaper'];
	$e_admin_jadwallokasi			= $_POST['admin'];
	$e_supir_jadwallokasi			= $_POST['supir'];

	$q_edit	= 'UPDATE jadwallokasi SET id_jadwal="'.$e_id_jadwal.'",doketer_jadwallokasi="'.$e_doketer_jadwallokasi.'",tensi_jadwallokasi="'.$e_tensi_jadwallokasi.'",hb_jadwallokasi="'.$e_hb_jadwallokasi.'",aftaper_jadwallokasi="'.$e_aftaper_jadwallokasi.'",admin_jadwallokasi="'.$e_admin_jadwallokasi.'",supir_jadwallokasi="'.$e_supir_jadwallokasi.'" WHERE id_jadwallokasi="'.$e_id_jadwallokasi.'"';
	$p_edit	= mysqli_query(koneksi_global(),$q_edit) or die(mysqli_error());
	if ($q_edit){
		echo '<script>
				$(document).ready(function(){
					$("#statusOK").show();
					});
					setTimeout(function(){window.location="'.base_url().'admin/jadwallokasi/";}, 1000);
			 </script>';
			}
		}
?>