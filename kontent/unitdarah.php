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
		<button id="statusHapus" type="button" tabel="unit_darah" col="nomor_kantong_darah" class="btn btn-danger delete_class"><i class="fa fa-trash"></i> Hapus</button>
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
Unit Darah
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Unit Darah</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-5">
	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Statistik</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tr>
                  <th style="width: 15%">Golongan Darah</th>
                  <th>Rhesus +</th>
                  <th>Rhesus -</th>
                  <th>Total</th>
                </tr>
				<?php
				$goldar  = array('A','B','O','AB');
				foreach($goldar as $pecah){
				?>
					<tr>
					  <td><b><?php echo $pecah; ?></b></td>
					  <td><?php echo dapatkantotaldarah($pecah,'+'); ?></td>
					  <td><?php echo dapatkantotaldarah($pecah,'-'); ?></td>
					  <td><?php echo dapatkantotaldarah($pecah,''); ?></td>
					</tr>
				<?php
				}
				?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		  </div>

<div class="col-md-7">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Data Unit Darah</h3>
	<div class="box-tools">
			<div class="input-group input-group-sm" style="width: 150px;">
			  <div class="input-group-btn">
				<a style="margin-right: 1%;" href="<?php echo $eksporexcel; ?>unit_darah"><button type="submit" class="btn btn-success" style="margin-right: 0.1%;"><i class="fa fa-file-excel-o"></i> Ekspor Excel</button></a>
				<a href="<?php echo base_url(); ?>admin/unitdarah/tambah"><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>
			  </div>
			</div>
	</div>
	</div>
	<div class="box-body table-responsive">
	  <table id="datatble" class="table table-bordered table-striped">
		<thead>
		<tr>
		  <th>No.</th>
		  <th>Nomor Kantong Darah</th>
		  <th>ID Pendonor</th>
		  <th>Rhesus</th>
		  <th>Tipe Darah</th>
		  <th>Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$penomoran = 0;
		$query = dapatkandata('unit_darah');
		if(mysqli_num_rows($query) != 0){
		while($n = mysqli_fetch_array($query)){
			$nomor_kantong_darah = $n['nomor_kantong_darah'];
			$id_pendonor = $n['id_pendonor'];
			$rhesus_darah = $n['rhesus_darah'];
			$golongan_darah = $n['golongan_darah'];
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $nomor_kantong_darah;?></td>
				  <td><a id="<?php echo $id_pendonor;?>" hal="pendonor" jud="Pendonor" col="id_pendonor" href="#" class="modals" onclick="infoPendonor()" ><?php echo $id_pendonor;?></a></td>
				  <td><?php echo $rhesus_darah;?></td>
				  <td><?php echo $golongan_darah;?></td>
				  <td><a href="<?php echo base_url(); ?>admin/unitdarah/ubah/<?php echo $nomor_kantong_darah;?>"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i> Ubah</button></a> <button type="button" class="btn btn-xs btn-danger btn-flat" data-toggle="modal" data-target="#modalHapus" onclick="formHapus('Apakah Anda Ingin Menghapus <?php echo $nomor_kantong_darah;?> .?','<?php echo $nomor_kantong_darah;?>')"><i class="fa fa-trash"></i> Hapus</button></td>
				</tr>
		<?php
		}
		}else{
			echo'<tr>
				<td colspan="6" align="center">Belum Ada Data Unit Darah</td>
				</tr>';
		}
		?>
			</table>
		</div>
	</div>
</div>
	
	
</div>	       


</section>
</div>



