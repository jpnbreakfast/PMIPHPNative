<section class="content-header">
	<h1>
		Dashboard
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	</ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
	<div class="jumbotron">
		<div class="container">
			<h1>Selamat Datang, <?php echo dapatkaninfo(username)[0];?> </h1>
			<p>Selamat Datang Di Sistem Informasi Unit Transfusi Darah PMI Kota Denpasar, Halaman Yang Anda Lihat Ini
				Merupakan Dashboard Statistik Data Di Sistem Ini</p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?php echo dapatkantotal('pendonor'); ?></h3>
					<p>Pendonor</p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
				<a href="<?php echo base_url();?>admin/pendonor/" class="small-box-footer">Info Selengkapnya <i
						class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo dapatkantotal('unit_darah'); ?></h3>
					<p>Unit Darah</p>
				</div>
				<div class="icon">
					<i class="fa fa-tint"></i>
				</div>
				<a href="<?php echo base_url();?>admin/unitdarah/" class="small-box-footer">Info Selengkapnya <i
						class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo dapatkantotal('jadwal'); ?></h3>
					<p>Jadwal</p>
				</div>
				<div class="icon">
					<i class="fa fa-clock-o"></i>
				</div>
				<a href="<?php echo base_url();?>admin/jadwal/" class="small-box-footer">Info Selengkapnya <i
						class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3><?php echo dapatkantotal('transaksi'); ?></h3>
					<p>Transaksi</p>
				</div>
				<div class="icon">
					<i class="fa fa-send"></i>
				</div>
				<a href="<?php echo base_url();?>admin/transaksi/" class="small-box-footer">Info Selengkapnya <i
						class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
	</div>
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Daftar Pendonor Terbaru</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body padding">
					<table class="table table-condensed">
						<tr>
							<th style="width: 10px">#</th>
							<th>ID Pendonor</th>
							<th>Nama</th>
							<th style="width: 40px">No Telepon</th>
						</tr>
						<?php
				$penomoran = 0;
				$query = dapatkandatadashboard('pendonor','id_pendonor');
				if(mysqli_num_rows($query) != 0){
				while($n = mysqli_fetch_array($query)){
					$id_pendonor = $n['id_pendonor'];
					$nama_lengkap_pendonor = $n['nama_lengkap_pendonor'];
					$no_telp_pendonor = $n['no_telp_pendonor'];
					$penomoran++;
					?>
						<tr>
							<td><?php echo $penomoran.'.'?></td>
							<td><?php echo $id_pendonor?></td>
							<td><?php echo $nama_lengkap_pendonor?></td>
							<td><?php echo $no_telp_pendonor?></td>
						</tr>
						<?php
				}
				}else{
					echo'<tr>
						<td colspan="4" align="center">Belum Ada Data Pendonor</td>
						</tr>';
				}
		?>

					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>

		<div class="col-lg-4 col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Daftar Transaksi Terbaru</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body padding">
					<table class="table table-condensed">
						<tr>
							<th style="width: 10px">#</th>
							<th>ID Transaksi</th>
							<th>Nama</th>
							<th style="width: 40px">Pengambilan</th>
						</tr>
						<?php
				$penomoran = 0;
				$query = dapatkandatadashboard('transaksi','id_transaksi');
				if(mysqli_num_rows($query) != 0){
				while($n = mysqli_fetch_array($query)){
					$id_transaksi = $n['id_transaksi'];
					$nama_pendonor = $n['nama_pendonor'];
					$pengambilan = $n['pengambilan'];
					$penomoran++;
					?>
						<tr>
							<td><?php echo $penomoran.'.'?></td>
							<td><?php echo $id_transaksi?></td>
							<td><?php echo $nama_pendonor?></td>
							<td><?php echo $pengambilan?></td>
						</tr>
						<?php
				}
				}else{
					echo'<tr>
						<td colspan="4" align="center">Belum Ada Data Transaksi</td>
						</tr>';
				}
		?>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>

		<div class="col-lg-4 col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Daftar Jadwal Dan Lokasi</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body padding">
					<table class="table table-condensed">
						<tr>
							<th style="width: 10px">#</th>
							<th>Instasi</th>
							<th>Tanggal</th>
							<th>Alamat</th>
						</tr>
						<?php
				$penomoran = 0;
				$query = dapatkandatadashboard('jadwaldanlokasi','id_jadwallokasi');
				if(mysqli_num_rows($query) != 0){
				while($n = mysqli_fetch_array($query)){
					$instasi_jadwal = $n['instasi_jadwal'];
					$tanggal_jadwal = $n['tanggal_jadwal'];
					$alamat_jadwal = $n['alamat_jadwal'];
					$penomoran++;
					?>
						<tr>
							<td><?php echo $penomoran.'.'?></td>
							<td><?php echo $instasi_jadwal?></td>
							<td><?php echo date('j-F-Y',strtotime($tanggal_jadwal))?></td>
							<td><?php echo $alamat_jadwal?></td>
						</tr>
						<?php
				}
				}else{
					echo'<tr>
						<td colspan="4" align="center">Belum Ada Data Unit Darah</td>
						</tr>';
				}
		?>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>