<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMI Denpasar</title>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/font-awesome.min.css" rel="stylesheet">
    <link href="dist/css/index.css" rel="stylesheet">
	<script src="dist/js/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKt5CjDT9N4RTIzDQQn6GpfLUaEX4e92w"></script>
	<script src="dist/js/form-index.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">PMI DENPASAR
		  <img style="max-width:30px; margin-top: -25px; margin-left: -35px;"
             src="img/logo.png"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo $url; ?>">Home</a></li>
			<li><a href="stokdarah">Stok Darah</a></li>
            <li><a href="jadwaldonor">Jadwal Donor</a></li>
			<li><a href="kontak">Kontak</a></li>
          </ul>
        </div>
      </div>
    </nav>