<?php
if(isset($_GET['id'])){
	$query = dapatkandatapilihan('unit_darah','nomor_kantong_darah',$_GET['id']);
	if(mysqli_num_rows($query) != 0){
		$r = mysqli_fetch_array($query);
		$nomor_kantong_darah = $r['nomor_kantong_darah'];
		$id_pendonor = $r['id_pendonor'];
		$rhesus_darah = $r['rhesus_darah'];
		$rhesusOptions  = array('+','-');
	}else{
		$nomor_kantong_darah = '';
		$id_pendonor = '';
		$rhesus_darah = '';
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
Ubah
<small>Unit Darah</small>
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li>Unit Darah</li>
<li class="active">Ubah</li>
</ol>
</section>
<section class="content">
<div id="statusOK" class="callout callout-info">
	<h4>Berhasil!</h4>
	Tunggu Sebentar Akan Dikembalikan Ke Dashboard....
</div>
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Ubah Unit Darah</h3>
	</div>
<form method="post" enctype="multipart/form-data">
	<div class="box-body">
		  <div class="form-group">
			<label for="nomor_kantong_darah" class="control-label">Nomor Kantong Darah</label>
			<div>
			  <input type="text" class="form-control" disabled="disabled" value="<?php echo $nomor_kantong_darah; ?>" id="nomor_kantong_darah">
			  <input type="hidden" name="nomor_kantong_darah" value="<?php echo $nomor_kantong_darah;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="id_pendonor" class="control-label">ID Pendonor</label>
			<div>
			<select class="form-control" name="id_pendonor" required>
			<option value="">Pilih Pendonor</option>
			<?php 
			$q	= dapatkandata('pendonor');
			$n	= mysqli_num_rows($q);
					if ($n!=0)
						{	
							while ($r = mysqli_fetch_array($q)){
							$pil_id_pendonor = $r['id_pendonor'];
							$pil_nama_lengkap_pendonor = $r['nama_lengkap_pendonor'];
							if($id_pendonor == $pil_id_pendonor){
							echo '<option selected="selected"  value="'.$pil_id_pendonor.'">['.$pil_id_pendonor.']&nbsp;'.$pil_nama_lengkap_pendonor.'</option>';
								}else{
							echo '<option  value="'.$pil_id_pendonor.'">['.$pil_id_pendonor.']&nbsp;'.$pil_nama_lengkap_pendonor.'</option>';
								}
							}
						}
			?>
			</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="rhesus" class="control-label">Rhesus</label>
			<div>
			   <select class="form-control" id="rhesus" name="rhesus" required>
					<?php
					foreach($rhesusOptions as $option){
    			    if($rhesus_darah == $option){
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
			 <a href="<?php echo base_url(); ?>admin/unitdarah/"><button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i>  Kembali</button></a>
			   <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-save"></i> Ubah</button>
			</div>
		  </div>
	</div>
</form>
</div>
</section>

<?php
if (isset($_POST['submit'])){  
	$t_nomor_kantong_darah		= $_POST['nomor_kantong_darah'];
	$t_id_pendonor				= $_POST['id_pendonor'];
	$t_rhesus					= $_POST['rhesus'];

	$query = dapatkandatapilihan('pendonor','id_pendonor',$t_id_pendonor);
	if(mysqli_num_rows($query) != 0){
	while($n = mysqli_fetch_array($query)){
		$t_golongandarah = $n['golongan_darah_pendonor'];
		
	$q_edit	= 'UPDATE unit_darah SET id_pendonor="'.$t_id_pendonor.'",rhesus_darah="'.$t_rhesus.'",golongan_darah="'.$t_golongandarah.'" WHERE nomor_kantong_darah="'.$t_nomor_kantong_darah.'"';
	$q_edit	= mysqli_query(koneksi_global(),$q_edit) or die(mysql_error());
	if ($q_edit){
		echo '<script>
				$(document).ready(function(){
					$("#statusOK").show();
					});
					setTimeout(function(){window.location="'.base_url().'admin/unitdarah/";}, 1000);
			 </script>';
			}
		}
	}
}
?>