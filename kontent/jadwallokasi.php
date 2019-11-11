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
		<button id="statusHapus" type="button" tabel="jadwallokasi" col="id_jadwallokasi" class="btn btn-danger delete_class"><i class="fa fa-trash"></i> Hapus</button>
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
Jadwal Dan Lokasi
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Jadwal Dan Lokasi</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Data Jadwal Dan Lokasi</h3>
	<div class="box-tools">
			<div class="input-group input-group-sm" style="width: 150px;">
			  <div class="input-group-btn">
				<a href="<?php echo base_url();?>admin/jadwallokasi/tambah"><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>
			  </div>
			</div>
	</div>
	</div>
	<div class="box-body table-responsive">
	  <table id="datatble" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
		<thead>
		<tr>
		  <th>No.</th>
		  <th>Instasi</th>
		  <th>Target Jumlah</th>
		  <th>Dokter</th>
		  <th>Tensi</th>
		  <th>HB</th>
		  <th>Aftoper</th>
		  <th>Admin</th>
		  <th>Supir</th>
		  <th>Tanggal</th>
		  <th>Waktu</th>
		  <th>Lokasi</th>
		  <th>Link</th>
		  <th data-priority="1">Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$penomoran = 0;
		$query = dapatkandata('jadwaldanlokasi');
		if(mysqli_num_rows($query) != 0){
		while($n = mysqli_fetch_array($query)){
			$instasi_jadwal 		= htmlspecialchars($n['instasi_jadwal'], ENT_QUOTES, 'UTF-8');
			$target_jumlah_jadwal 	= htmlspecialchars($n['target_jumlah_jadwal'], ENT_QUOTES, 'UTF-8');
			$doketer_jadwallokasi 	= htmlspecialchars($n['doketer_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$tensi_jadwallokasi 	= htmlspecialchars($n['tensi_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$hb_jadwallokasi 		= htmlspecialchars($n['hb_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$aftaper_jadwallokasi 	= htmlspecialchars($n['aftaper_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$admin_jadwallokasi 	= htmlspecialchars($n['admin_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$supir_jadwallokasi	 	= htmlspecialchars($n['supir_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$tanggal_jadwal 		= htmlspecialchars($n['tanggal_jadwal'], ENT_QUOTES, 'UTF-8');
			$jam_jadwal 			= htmlspecialchars($n['jam_jadwal'], ENT_QUOTES, 'UTF-8');
			$alamat_jadwal 			= htmlspecialchars($n['alamat_jadwal'], ENT_QUOTES, 'UTF-8');
			$kecamatan_jadwal 		= htmlspecialchars($n['kecamatan_jadwal'], ENT_QUOTES, 'UTF-8');
			$link_jadwal 			= htmlspecialchars($n['link_jadwal'], ENT_QUOTES, 'UTF-8');
			$id_jadwallokasi 		= htmlspecialchars($n['id_jadwallokasi'], ENT_QUOTES, 'UTF-8');
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $instasi_jadwal;?></td>
				  <td><?php echo $target_jumlah_jadwal;?></td>
				  <td>Dr. <?php echo $doketer_jadwallokasi;?></td>
				  <td><?php echo $tensi_jadwallokasi;?></td>
				  <td><?php echo $hb_jadwallokasi;?></td>
				  <td><?php echo $aftaper_jadwallokasi;?></td>
				  <td><?php echo $admin_jadwallokasi;?></td>
				  <td><?php echo $supir_jadwallokasi;?></td>
				  <td><?php echo date('j-F-Y',strtotime($tanggal_jadwal));?></td>
				  <td><?php echo $jam_jadwal;?></td>
				  <td><?php echo $alamat_jadwal.'. '.$kecamatan_jadwal;?></td>
				  <td><a  target="_blank" href="<?php echo $link_jadwal;?>"><button data-toggle="tooltip" title="<?php echo $link_jadwal;?>" type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i> Lihat</button></a></td>
				  <td><a href="<?php echo base_url();?>admin/jadwallokasi/ubah/<?php echo $id_jadwallokasi;?>"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i> Ubah</button></a> <button type="button" class="btn btn-xs btn-danger btn-flat" data-toggle="modal" data-target="#modalHapus" onclick="formHapus('Apakah Anda Ingin Menghapus Jadwal Dan Lokasi Yang Berada Di Instasi  <?php echo $instasi_jadwal;?> .?','<?php echo $id_jadwallokasi;?>')"><i class="fa fa-trash"></i> Hapus</button></td>
				</tr>
		<?php
		}
		}else{
			echo'<tr>
				<td colspan="14" align="center">Belum Ada Data Unit Darah</td>
				</tr>';
		}
		?>
			</table>
		</div>
	</div>
</section>
</div>



