<?php
if(isset($_GET['id'])){
	$query = dapatkandatapilihan($_GET['halaman'],'id_transaksi',$_GET['id']);
	if(mysqli_num_rows($query) != 0){
		$r = mysqli_fetch_array($query);
		$id_transaksi			= htmlspecialchars($r['id_transaksi'], ENT_QUOTES, 'UTF-8');
		$id_pendonor			= htmlspecialchars($r['id_pendonor'], ENT_QUOTES, 'UTF-8');
		$nama_pendonor			= htmlspecialchars($r['nama_pendonor'], ENT_QUOTES, 'UTF-8');
		$nomor_kantong_darah 	= htmlspecialchars($r['nomor_kantong_darah'], ENT_QUOTES, 'UTF-8');
		$golongan_darah 		= htmlspecialchars($r['golongan_darah'], ENT_QUOTES, 'UTF-8');
		$id_jadwal 				= htmlspecialchars($r['id_jadwal'], ENT_QUOTES, 'UTF-8');
		$tanggal				= htmlspecialchars($r['tanggal'], ENT_QUOTES, 'UTF-8');
		$pengambilan			= htmlspecialchars($r['pengambilan'], ENT_QUOTES, 'UTF-8');
		$opsipengambilan  		= array('Biasa', 'Apheresis');
	}else{
		$id_transaksi			= '';
		$id_pendonor			= '';
		$nama_pendonor			= '';
		$nomor_kantong_darah 	= '';
		$golongan_darah 		= '';
		$id_jadwal 				= '';
		$tanggal				= '';
		$pengambilan			= '';;
		$opsipengambilan  		= array('Biasa', 'Apheresis');
		echo"
		<script>
			$(document).ready(function () {
				Swal.fire({
					title: 'Kesalahan!',
					text: 'Data Yang Dipilih Salah!',
					type: 'warning',
					showCancelButton: false,
					showConfirmButton: true,
				}).then((result) => {
					if (result.value) {
						window.location='".base_url()."/admin/jadwal/';
					} 
				  })
			});
		</script>";
	}
}
?>
<script>
	$(document).ready(function() {
		pilihpendonor();
		pilihjadwal2();
	});
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
    </div>
  </div>
</div>
<section class="content-header">
<h1>
Ubah
<small>Transaksi</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Transaksi</li>
<li class="active">Ubah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Ubah Transaksi</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_transaksi" class="control-label">ID Transaksi</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $id_transaksi; ?>" required>
			  <input class="form-control" type="hidden" value="<?php echo $id_transaksi; ?>" id="id_transaksi" name="id_transaksi">
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
								if($pil_id_pendonor == $id_pendonor){
									echo '<option selected="selected" namapendonor="'.$pil_nama_lengkap_pendonor.'" kantong="'.$nomor_kantong_darah.'" identitas="'.$pil_id_pendonor.'"  value="'.$pil_id_pendonor.'">['.$pil_id_pendonor.']&nbsp;'.$pil_nama_lengkap_pendonor.'</option>';
								}else{
									echo '<option namapendonor="'.$pil_nama_lengkap_pendonor.'" identitas="'.$pil_id_pendonor.'" kantong="'.$nomor_kantong_darah.'"  value="'.$pil_id_pendonor.'">['.$pil_id_pendonor.']&nbsp;'.$pil_nama_lengkap_pendonor.'</option>';
								}
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
			  <input type="text" id="gol_dar_disabled" class="form-control" value="<?php echo $golongan_darah; ?>" disabled="disabled" required>
			  <input class="form-control" id="gol_dar" type="hidden" value="<?php echo $golongan_darah; ?>" name="gol_dar">
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
							if($pil_id_jadwal == $id_jadwal){
							echo '<option selected="selected" idjad="'.$pil_id_jadwal.'" tanggal_jadwal="'.$pil_tanggal_jadwal.'"  value="'.$pil_id_jadwal.'">['.$pil_instasi_jadwal.']&nbsp;'.$pil_tanggal_jadwal.'</option>';
							}else{
								echo '<option idjad="'.$pil_id_jadwal.'" tanggal_jadwal="'.$pil_tanggal_jadwal.'"  value="'.$pil_id_jadwal.'">['.$pil_instasi_jadwal.']&nbsp;'.$pil_tanggal_jadwal.'</option>';
							}
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
				<?php 
					foreach($opsipengambilan as $option){
    			    if($pengambilan == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
            </select>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url(); ?>admin/transaksi/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-save"></i> Ubah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>
<script>
pilihjadwal();
pilihpendonor();
</script>
<?php
if (isset($_POST['submit'])){  
	$e_id_transaksi			= htmlspecialchars($_POST['id_transaksi'], ENT_QUOTES, 'UTF-8');
	$e_id_pendonor			= htmlspecialchars($_POST['id_pendonor'], ENT_QUOTES, 'UTF-8');
	$e_nama_pendonor		= htmlspecialchars($_POST['nama_pendonor'], ENT_QUOTES, 'UTF-8');
	$e_nomor_kantong_darah 	= htmlspecialchars($_POST['nomor_kantong_darah'], ENT_QUOTES, 'UTF-8');
	$e_gol_dar  			= htmlspecialchars($_POST['gol_dar'], ENT_QUOTES, 'UTF-8');
	$e_id_jadwal  			= htmlspecialchars($_POST['id_jadwal'], ENT_QUOTES, 'UTF-8');
	$e_tanggal 				= htmlspecialchars($_POST['tanggal'], ENT_QUOTES, 'UTF-8');
	$e_pengambilan 			= htmlspecialchars($_POST['pengambilan'], ENT_QUOTES, 'UTF-8');
	$q_edit	= 'UPDATE transaksi SET id_pendonor="'.$e_id_pendonor.'", nama_pendonor="'.$e_nama_pendonor.'", nomor_kantong_darah="'.$e_nomor_kantong_darah.'", golongan_darah="'.$e_gol_dar.'", id_jadwal="'.$e_id_jadwal.'", tanggal="'.$e_tanggal.'", pengambilan="'.$e_pengambilan.'" WHERE id_transaksi="'.$e_id_transaksi.'"';
	$p_edit	= mysqli_query(koneksi_global(),$q_edit) or die(mysqli_error());
	if ($p_edit){
		simpanLog(dapatkaninfo(username)[3], "Ubah", "transaksi", "$e_id_transaksi", "ID Transaksi : $e_id_transaksi <br/> ID Pendonor : $e_id_pendonor <br/> Nama Pendonor : $e_nama_pendonor <br/> Nomor Kantong Darah : $e_nomor_kantong_darah <br/> Golongan Darah : $e_gol_dar <br/> ID Jadwal : $e_id_jadwal <br/> Tanggal : $e_tanggal <br/> Pengambilan : $e_pengambilan");
		echo "<script>
		$(document).ready(function(){
			Swal.fire({
				title: 'Sukses!',
				text: 'Sukses Mengubah Data!,Harap Menungu Halaman Akan Di Refresh!',
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
			text: 'Kesalahan Dalam Mengubah Data!',
			type: 'warning',
			showCancelButton: false,
			showConfirmButton: true,
		})
	});
</script>";
}
}
?>