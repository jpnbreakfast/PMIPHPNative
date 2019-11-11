<?php
if(isset($_GET['id'])){
	$query = dapatkandatapilihan($_GET['halaman'],'id_pendonor',$_GET['id']);
	if(mysqli_num_rows($query) != 0){
		$r = mysqli_fetch_array($query);
		$id_pendonor 				= htmlspecialchars($r['id_pendonor'], ENT_QUOTES, 'UTF-8');
		$rama_lengkap_pendonor 		= htmlspecialchars($r['nama_lengkap_pendonor'], ENT_QUOTES, 'UTF-8');
		$jenis_kelamin_pendonor 	= htmlspecialchars($r['jenis_kelamin_pendonor'], ENT_QUOTES, 'UTF-8');
		$tanggal_lahir_pendonor 	= htmlspecialchars($r['tanggal_lahir_pendonor'], ENT_QUOTES, 'UTF-8');
		$tempat_lahir_pendonor 		= htmlspecialchars($r['tempat_lahir_pendonor'], ENT_QUOTES, 'UTF-8');
		$alamat_pendonor 			= htmlspecialchars($r['alamat_pendonor'], ENT_QUOTES, 'UTF-8');
		$pekerjaan_pendonor 		= htmlspecialchars($r['pekerjaan_pendonor'], ENT_QUOTES, 'UTF-8');
		$golongan_darah_pendonor 	= htmlspecialchars($r['golongan_darah_pendonor'], ENT_QUOTES, 'UTF-8');
		$ro_telp_pendonor 			= htmlspecialchars($r['no_telp_pendonor'], ENT_QUOTES, 'UTF-8');
		$options  = array('Laki-Laki','Perempuan');
		$optionsdarah  = array('A','B','O','AB');
	}else{
		$id_pendonor = '';
		$rama_lengkap_pendonor = '';
		$jenis_kelamin_pendonor = '';
		$tanggal_lahir_pendonor = '';
		$tempat_lahir_pendonor = '';
		$alamat_pendonor = '';
		$pekerjaan_pendonor = '';
		$golongan_darah_pendonor = '';
		$ro_telp_pendonor = '';
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
						window.location='".base_url()."/admin/pendonor/';
					} 
				  })
			});
		</script>";
	}
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
        <a href="<?php echo base_url(); ?>admin/pendonor/"><button type="button" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i>  Kembali</button></a>
      </div>
    </div>
  </div>
</div>
<section class="content-header">
<h1>
Ubah
<small>Pendonor</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Pendonor</li>
<li class="active">Ubah</li>
</ol>
</section>
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Ubah Pendonor</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="id_pendonor" class="control-label">ID Pendonor</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $id_pendonor; ?>" id="id_pendonor">
			  <input type="hidden" name="id_pendonor" value="<?php echo $id_pendonor;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="nama_lengkap" class="control-label">Nama</label>
			<div>
			  <input type="text" class="form-control" value="<?php echo $rama_lengkap_pendonor; ?>" id="nama_lengkap" name="nama_lengkap" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
			<div>
			  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
            	<?php
				foreach($options as $option){
    			    if($jenis_kelamin == $option){
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
			<label for="tanggal_lahir" class="control-label">Tanggal Lahir</label>
			<div>
			  <input type="date" class="form-control" value="<?php echo $tanggal_lahir_pendonor; ?>" id="tanggal_lahir" name="tanggal_lahir" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="tempat_lahir" class="control-label">Tempat Lahir</label>
			<div>
			  <input type="text" class="form-control" value="<?php echo $tempat_lahir_pendonor; ?>" id="tempat_lahir" name="tempat_lahir" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="alamat" class="control-label">Alamat</label>
			<div>
			  <input type="text" class="form-control" value="<?php echo $alamat_pendonor; ?>" id="alamat" name="alamat" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="pekerjaan" class="control-label">Pekerjaan</label>
			<div>
			  <input type="text" class="form-control" value="<?php echo $pekerjaan_pendonor; ?>" id="pekerjaan" name="pekerjaan" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="golongan_darah" class="control-label">Golongan Darah</label>
			  <select class="form-control" id="golongan_darah" name="golongan_darah" required>
			  <option value="">Pilih Golongan Darah</option>
            	<?php
				foreach($optionsdarah as $option){
    			    if($golongan_darah_pendonor == $option){
							echo "<option selected='selected' value='$option'>$option</option>" ;
						}else{
							echo "<option value='$option'>$option</option>" ;
						}
					}
				?>
            </select>
		  </div>
		  <div class="form-group">
			<label for="nomor_telepon" class="control-label">Nomor Telepon</label>
			<div>
			  <input type="text" class="form-control" value="<?php echo $ro_telp_pendonor; ?>" id="nomor_telepon" name="nomor_telepon" required>
			</div>
		  </div>
		  <div class="form-group">
			<div>
			 <a href="<?php echo base_url(); ?>admin/pendonor/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			  <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-save"></i> Ubah</button>
			</div>
		  </div>
		  		  </div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$e_id_pendonor				= htmlspecialchars($_POST['id_pendonor'], ENT_QUOTES, 'UTF-8');
	$e_nama_lengkap_pendonor	= htmlspecialchars($_POST['nama_lengkap'], ENT_QUOTES, 'UTF-8');
	$e_jenis_kelamin_pendonor  	= htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES, 'UTF-8');
	$e_tanggal_lahir_pendonor  	= htmlspecialchars($_POST['tanggal_lahir'], ENT_QUOTES, 'UTF-8');
	$e_tempat_lahir_pendonor 	= htmlspecialchars($_POST['tempat_lahir'], ENT_QUOTES, 'UTF-8');
	$e_alamat_pendonor 			= htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8');
	$e_pekerjaan_pendonor 		= htmlspecialchars($_POST['pekerjaan'], ENT_QUOTES, 'UTF-8');
	$e_golongan_darah_pendonor	= htmlspecialchars($_POST['golongan_darah'], ENT_QUOTES, 'UTF-8');
	$e_no_telp_pendonor 		= htmlspecialchars($_POST['nomor_telepon'], ENT_QUOTES, 'UTF-8');
	$q_edit	= 'UPDATE pendonor SET nama_lengkap_pendonor="'.$e_nama_lengkap_pendonor.'", jenis_kelamin_pendonor="'.$e_jenis_kelamin_pendonor.'", tanggal_lahir_pendonor="'.$e_tanggal_lahir_pendonor.'", tempat_lahir_pendonor="'.$e_tempat_lahir_pendonor.'", alamat_pendonor="'.$e_alamat_pendonor.'", pekerjaan_pendonor="'.$e_pekerjaan_pendonor.'", golongan_darah_pendonor="'.$e_golongan_darah_pendonor.'", no_telp_pendonor="'.$e_no_telp_pendonor.'" WHERE id_pendonor="'.$e_id_pendonor.'"';
	$p_edit	= mysqli_query(koneksi_global(),$q_edit) or die(mysqli_error());
	if ($p_edit){
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
		setTimeout(function(){window.location='".base_url()."/admin/pendonor/';}, 1000);
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