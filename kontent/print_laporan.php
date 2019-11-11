<?php
    include("../fungsi.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMI Denpasar | Print Laporan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $url; ?>dist/css/bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $url; ?>dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();" onafterprint="window.history.back();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          PMI Denpasar
          <small class="pull-right">Tanggal Laporan: <?php echo date('j-F-Y'); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>PMI Denpasar</strong><br>
          Br. Kelod Kauh Kangin<br>
          Denpasar, ID 57410<br>
          Phone: (666) 666-6666<br>
          Email: info@rameses.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Laporan Transaksi</b>
        <br>
        <b>Data Tanggal:</b> <?php echo  date('j-F-Y',strtotime($_GET['bulandari'])); ?> - <?php echo  date('j-F-Y',strtotime($_GET['bulanke'])); ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
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
          </tr>
          </thead>
          <tbody>
          <tbody>
        <?php
        
		$penomoran = 0;
		$query = transaksi_report($_GET['bulandari'],$_GET['bulanke']);
		if(mysqli_num_rows($query) != 0){
		while($r = mysqli_fetch_array($query)){
			$id_transaksi			= htmlspecialchars($r['id_transaksi'], ENT_QUOTES, 'UTF-8');
			$id_pendonor			= htmlspecialchars($r['id_pendonor'], ENT_QUOTES, 'UTF-8');
			$nama_pendonor			= htmlspecialchars($r['nama_pendonor'], ENT_QUOTES, 'UTF-8');
			$nomor_kantong_darah 	= htmlspecialchars($r['nomor_kantong_darah'], ENT_QUOTES, 'UTF-8');
			$golongan_darah 		= htmlspecialchars($r['golongan_darah'], ENT_QUOTES, 'UTF-8');
			$id_jadwal 				= htmlspecialchars($r['id_jadwal'], ENT_QUOTES, 'UTF-8');
			$tanggal				= htmlspecialchars($r['tanggal'], ENT_QUOTES, 'UTF-8');
			$pengambilan			= htmlspecialchars($r['pengambilan'], ENT_QUOTES, 'UTF-8');
			
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $id_transaksi;?></td>
				  <td><?php echo $id_pendonor;?></td>
				  <td><?php echo $nama_pendonor;?></td>
				  <td><?php echo $nomor_kantong_darah;?></td>
				  <td><?php echo $golongan_darah;?></td>
				  <td><?php echo $id_jadwal;?></td>
				  <td><?php echo date('j-F-Y',strtotime($tanggal));?></td>
				  <td><?php echo $pengambilan;?></td>
				</tr>
		<?php
		}
        }
        ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
	  <center>
        <p>Denpasar, <?php echo date('j-F-Y'); ?></p>
		<br>
        <br>
        <p>(Caca Handika)</p>
	  </center>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
