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
			Laporan Transaksi
		</h1>
		<ol class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Laporan Transaksi</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Opsi Laporan</h3>
					</div>
					<div class="box-body">
						<form id="formlaporantransaksi" method="POST">
							<div class="form-group">
								<label for="exampleInputEmail1">Ambil Dari Tanggal</label>
								<input type="date" id="bulandari" name="bulandari" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Ke Tanggal</label>
								<input type="date" id="bulanke" name="bulanke" class="form-control" required>
							</div>
							<button type="submit" class="btn btn-default">Lihat</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Laporan Transaksi</h3>
						<div class="box-tools">
							<div class="input-group input-group-sm">
								<div class="input-group-btn">
									<a style="margin-right: 1%;" href="<?php echo $eksporexcel; ?>transaksi"><button
											type="submit" class="btn btn-success" style="margin-right: 0.1%;"><i
												class="fa fa-file-excel-o"></i> Ekspor Excel</button></a>
									<a id="print" href="#"><button
											type="submit" class="btn btn-success"><i
												class="fa fa-print"></i> Print</button></a>
								</div>
							</div>
						</div>
					</div>
					<div id="laporan_transaksi" class="box-body">

					</div>
				</div>
			</div>
	</section>
</div>