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
		<button id="statusHapus" type="button" tabel="transaksi" col="id_transaksi" class="btn btn-danger delete_class"><i class="fa fa-trash"></i> Hapus</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
      </div>
	  <div id="statusOK" class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalInfo2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informasi</h4>
      </div>
      <div class="modal-body">
        <p id="infoSalah2"></p>
      </div>
	   <div id="statusHapus" class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
		</div>
    </div>
  </div>
</div>
<div id="form_tabel">
<section class="content-header">
<h1>
Transaksi
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Transaksi</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Data Transaksi</h3>
	<div class="box-tools">
			<div class="input-group input-group-sm">
			<div class="input-group-btn">
				<a href="<?php echo base_url();?>admin/transaksi/tambah"><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>
			  </div>
			</div>
	</div>
	</div>
	<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#semua" data-toggle="tab">Semua</a></li>
	  <li><a href="#perhari" data-toggle="tab">Per Hari</a></li>
	  <li><a href="#perbulan" data-toggle="tab">Per Bulan</a></li>
	  <li><a href="#perpendonor" data-toggle="tab">Per Pendonor</a></li>
	</ul>
	<div class="tab-content">
	  <div class="tab-pane" id="perhari">
	  <div class="tab-pane" id="perhari">
	<div class="box-body table-responsive">
	<div class="input-group input-group-sm" style="padding-bottom: 10px; margin-left: 80%;">
                  <input name="table_search" id="transaksiperhari" class="form-control pull-right" placeholder="Cari Perhari">

                  <div class="input-group-btn">
                    <button type="submit" tipe="perhari" class="btn btn-default tampilkanTabelPerhari"><i class="fa fa-search"></i></button>
                  </div>
                </div>
						  <div id="tabelperhari"></div>  
		</div>
	  </div>
	</div>
	
	
	  <div class="tab-pane" id="perbulan">
		<div class="box-body table-responsive">
			<div class="input-group input-group-sm" style="padding-bottom: 10px; margin-left: 80%;">
                  <input id="transaksiperbulan" class="form-control pull-right" placeholder="Cari Perbulan">

                  <div class="input-group-btn">
                    <button type="submit" tipe="perbulan" class="btn btn-default tampilkanTabelPerbulan"><i class="fa fa-search"></i></button>
                  </div>
                </div>
					  <div id="tableperbulan"></div>
		</div>
	  </div>
	  
	  <div class="tab-pane" id="perpendonor">
		<div class="box-body table-responsive">
			<div class="input-group input-group-sm" style="padding-bottom: 10px; margin-left: 65%;">
                  <input id="tarnsasksiperpendonor" class="form-control pull-right" placeholder="Cari Pendonor">
                  <div class="input-group-btn">
                    <button type="submit" tipe="pendonor" class="btn btn-default tampilkanTabelPerpendonor"><i class="fa fa-search"></i></button>
					<button class="btn btn-default pilihPendonor" onclick="infoPendonor()"><i class="fa fa-users"></i> Daftar Pendonor</button>
                  </div>
                </div>
				<div id="tabelperpendonor"></div>
		</div>
	  </div>

	  <div class="active tab-pane" id="semua">
		<div class="box-body table-responsive">
	<table id="datatble" class="table table-bordered table-striped">
		<thead>
		<tr>
		  <th>No.</th>
		  <th>ID Transaksi</th>
		  <th>ID Pendonor</th>
		  <th>Nama Pendonor</th>
		  <th>Nomor Kantong Darah</th>
		  <th>Golongan Darah</th>
		  <th>ID Jadwal</th>
		  <th>Tanggal</th>
		  <th>Pengambilan</th>
		  <th>Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$penomoran = 0;
		$query = dapatkandata('transaksi');
		if(mysqli_num_rows($query) != 0){
		while($n = mysqli_fetch_array($query)){
			$id_transaksi = $n['id_transaksi'];
			$id_pendonor = $n['id_pendonor'];
			$nama_pendonor = $n['nama_pendonor'];
			$nomor_kantong_darah = $n['nomor_kantong_darah'];
			$golongan_darah = $n['golongan_darah'];
			$id_jadwal = $n['id_jadwal'];
			$tanggal = $n['tanggal'];
			$pengambilan = $n['pengambilan'];
			
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $id_transaksi;?></td>
				  <td><a id="<?php echo $id_pendonor;?>" hal="pendonor" jud="Pendonor" col="id_pendonor" href="#" class="modals" onclick="infoPendonor();" ><?php echo $id_pendonor;?></a></td>
				  <td><?php echo $nama_pendonor;?></td>
				  <td><a id="<?php echo $nomor_kantong_darah;?>" hal="unit_darah" jud="Unit Darah" col="nomor_kantong_darah" href="#" class="modals" onclick="infoPendonor();" ><?php echo $nomor_kantong_darah;?></a></td>
				  <td><?php echo $golongan_darah;?></td>
				  <td><a id="<?php echo $id_jadwal;?>" hal="jadwal" jud="Unit Darah" col="id_jadwal" href="#" class="modals" onclick="infoPendonor();" ><?php echo $id_jadwal;?></a></td>
				  <td><?php echo date('j-F-Y',strtotime($tanggal));?></td>
				  <td><?php echo $pengambilan;?></td>
				  <td><a href="<?php echo base_url();?>admin/transaksi/ubah/<?php echo $id_transaksi;?>"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i> Ubah</button></a> <button type="button" class="btn btn-xs btn-danger btn-flat" onclick="formHapus('Apakah Anda Ingin Menghapus <?php echo $id_transaksi;?> .?','<?php echo $id_transaksi;?>')"><i class="fa fa-trash"></i> Hapus</button></td>
				</tr>
		<?php
		}
		}else{
			echo'<tr>
				<td colspan="12" align="center">Belum Ada Data Transaksi</td>
				</tr>';
		}
		?>
			</table>
		</div>
	  </div>
  </div>
</div>
	</div>
</section>
</div>



