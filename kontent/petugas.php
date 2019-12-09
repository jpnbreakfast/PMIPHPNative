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
		<button id="statusHapus" type="button" tabel="petugas" col="id_petugas" class="btn btn-danger delete_class"><i class="fa fa-trash"></i> Hapus</button>
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
Petugas
</h1>
<ol class="breadcrumb">
<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Petugas</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="box">
	<div class="box-header">
	<h3 class="box-title">Data Petugas</h3>
	<div class="box-tools">
			<div class="input-group input-group-sm">
			<div class="input-group-btn">
				<a style="margin-right: 1%;" href="<?php echo $eksporexcel; ?>petugas_view"><button type="submit" class="btn btn-success" style="margin-right: 0.1%;"><i class="fa fa-file-excel-o"></i> Ekspor Excel</button></a>
				<a href="<?php echo base_url(); ?>admin/petugas/tambah"><button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Data</button></a>
			  </div>
			</div>
	</div>
	</div>

	<div class="nav-tabs-custom">
	<ul id="tabpetugas" class="nav nav-tabs">
	  <li><a href="#semua" id="smdata" data-toggle="tab">Semua</a></li>
	  <li><a href="#dokter" data-toggle="tab">Dokter</a></li>
	  <li><a href="#supir" data-toggle="tab">Supir</a></li>
	  <li><a href="#aftaper" data-toggle="tab">Aftaper</a></li>
	  <li><a href="#tensi" data-toggle="tab">Tensi</a></li>
	  <li><a href="#administrator" data-toggle="tab">Administrator</a></li>
	  <li><a href="#administratorweb" data-toggle="tab">Administrator Web</a></li>
	</ul>

	<div class="tab-content">
	<div class="tab-pane" id="semua">
		<div class="box-body table-responsive">
	  		<div id="semua"></div>
		</div>
	</div>
	</div>
</section>
</div>



