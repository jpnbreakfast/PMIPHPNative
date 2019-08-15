<?php
	if(isset($_GET['form'])&& $_GET['form']=="tambah"){
		include("../kontent/".$_GET['halaman']."_tambah.php");
	}else if(isset($_GET['form'])&& $_GET['form']=="ubah"){
		include("../kontent/".$_GET['halaman']."_edit.php");
	}
?>
<div class="modal fade" id="modalInfo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="infoJudul"></h4>
      </div>
      <div class="modal-body">
        <p id="infoSalah"></p>
      </div>
      <div id="statusHapus" class="modal-footer">
		<button id="statusHapus" type="button" tabel="jadwal" col="id_jadwal" class="btn btn-danger delete_class"><i class="fa fa-trash"></i> Hapus</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
      </div>
	  <div id="statusOK" class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="form_tabel">
<section class="content-header">
<h1>
Jadwal
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Jadwal</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Data Jadwal</h3>
	<div class="box-tools">
			<div class="input-group input-group-sm">
			<div class="input-group-btn">
				<a style="margin-right: 1%;" href="<?php echo $eksporexcel; ?>jadwal"><button type="submit" class="btn btn-success" style="margin-right: 0.1%;"><i class="fa fa-file-excel-o"></i> Ekspor Excel</button></a>
				<a href="<?php echo base_url();?>admin/jadwal/tambah"><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>
			  </div>
			</div>
	</div>
	</div>
	<div class="box-body table-responsive">
	  <table id="datatble" class="table table-bordered table-striped">
		<thead>
		<tr>
		  <th>No.</th>
		  <th>Instasi</th>
		  <th>Target Jumlah</th>
		  <th>Tanggal</th>
		  <th>Jam</th>
		  <th>Hari</th>
		  <th>Alamat</th>
		  <th>Kecamatan</th>
		  <th>Link Alamat</th>
		  <th>Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$penomoran = 0;
		$query = dapatkandata('jadwal');
		if(mysqli_num_rows($query) != 0){
		while($n = mysqli_fetch_array($query)){
			$id_jadwal = $n['id_jadwal'];
			$instasi_jadwal = $n['instasi_jadwal'];
			$target_jadwal = $n['target_jumlah_jadwal'];
			$tanggal_jadwal = $n['tanggal_jadwal'];
			$jam_jadwal = $n['jam_jadwal'];
			$hari_jadwal = $n['hari_jadwal'];
			$alamat_jadwal = $n['alamat_jadwal'];
			$kecamatan_jadwal = $n['kecamatan_jadwal'];
			$lat_jadwal = $n['lat_jadwal'];
			$lng_jadwal = $n['lng_jadwal'];
			$link_jadwal = $n['link_jadwal'];
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $instasi_jadwal;?></td>
				  <td><?php echo $target_jadwal;?></td>
				  <td><?php echo date('j-F-Y',strtotime($tanggal_jadwal));?></td>
				  <td><?php echo $jam_jadwal;?></td>
				  <td><?php echo $hari_jadwal;?></td>
				  <td><?php echo $alamat_jadwal;?></td>
				  <td><?php echo $kecamatan_jadwal;?></td>
				  <td><a  target="_blank" href="<?php echo $link_jadwal;?>"><button data-toggle="tooltip" title="<?php echo $link_jadwal;?>" type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i> Lihat</button></a></td>
				  <td><a href="<?php echo base_url();?>admin/jadwal/ubah/<?php echo $id_jadwal;?>"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i> Ubah</button></a> <button type="button" class="btn btn-xs btn-danger btn-flat" data-toggle="modal" data-target="#modalHapus" onclick="formHapus('Apakah Anda Ingin Menghapus <?php echo $id_jadwal;?> .?','<?php echo $id_jadwal;?>')"><i class="fa fa-trash"></i> Hapus</button></td>
				</tr>
		<?php
		}
		}else{
			echo'<tr>
				<td colspan="10" align="center">Belum Ada Data Jadwal</td>
				</tr>';
		}
		?>
			</table>
		</div>
	</div>
</section>
</div>



