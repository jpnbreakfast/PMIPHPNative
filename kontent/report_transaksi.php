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
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Laporan Transaksi</h3>
						<div class="box-tools">
							<div class="input-group input-group-sm">

							</div>
						</div>
					</div>
					<div class="box-body">
						<form id="formlaporantransaksi" class="form-inline" method="POST">
							<div class="form-group">
								<label for="exampleInputEmail1">Ambil Dari Tanggal : </label>
								<input type="date" id="bulandari" name="bulandari" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Ke Tanggal : </label>
								<input type="date" id="bulanke" name="bulanke" class="form-control" required>
							</div>
							<button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> Lihat</button>
							<div class="btn-group">
								<button class="btn btn-success" data-toggle="dropdown">
									 	<i class="fa fa-save"></i> Ekspor Data</button>
								<button type="button" class="btn btn-success dropdown-toggle">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="<?php echo $eksporexcel; ?>transaksi"><i class="fa fa-file-excel-o"></i> Excel</a></li>
									<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
								</ul>
							</div>
							<a id="print" href="#" class="btn btn-success"><i
										class="fa fa-print"></i> Print</a>
						</form>
						<br/>
						<div id="laporan_transaksi"></div>
					</div>
				</div>
			</div>
	</section>
</div>