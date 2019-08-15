<?php include('fungsi.php'); ?>
<?php include('head.php'); ?>
<div class="modal fade" id="modalInfo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Kesalahan!</h4>
      </div>
      <div class="modal-body">
        <p id="infoSalah"></p>
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<div class="banner">
<h1 class="deskrippmi" style="width: 324px;">Jadwal Donor</h1>
</div>

<div class="container table-stok">
<h1 class="judul">Informasi Jadwal Donor</h1>
<p class="des">Berikut adalah Jadwal Pelaksanaan Donor</p>
<script>
function googlemaps(){
	var marker;
function initialize() {
	var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
mapTypeId: google.maps.MapTypeId.ROADMAP
	}     
	var map = new google.maps.Map(mapCanvas, mapOptions);
	var infoWindow = new google.maps.InfoWindow;      
	var bounds = new google.maps.LatLngBounds();


	function bindInfoWindow(marker, map, infoWindow, html) {
		google.maps.event.addListener(marker, 'click', function() {
			infoWindow.setContent(html);
			infoWindow.open(map, marker);
		});
	}

	function addMarker(lat, lng, info) {
		var pt = new google.maps.LatLng(lat, lng);
		bounds.extend(pt);
		var marker = new google.maps.Marker({
map: map,
position: pt
		});       
		map.fitBounds(bounds);
		bindInfoWindow(marker, map, infoWindow, info);
	}

	<?php
	if(isset($_POST['tempat'])){
		$query = dapatkanlokasi($_POST['tempat']);
	}else{
		$query = dapatkandatadashboard('jadwaldanlokasi','id_jadwallokasi');	
	}
	while ($data = mysqli_fetch_array($query)) {
		$lat = $data['lat_jadwal'];
		$lon = $data['lng_jadwal'];
		$nama = $data['instasi_jadwal'];
		$alamat = $data['alamat_jadwal'];
		$hari_jadwal = $data['hari_jadwal'];
		$tanggal_jadwal = $data['tanggal_jadwal'];
		$link_jadwal = $data['link_jadwal'];
		
		echo ("addMarker($lat, $lon, '<b>$nama</b><p>Alamat : $alamat<br/>Pelaksanaan : $hari_jadwal, ".date('j-F-Y',strtotime($tanggal_jadwal))."</p><a href=".$link_jadwal.">Lihat Di Google Maps</a>');\n");                        
	}
	?>
}
google.maps.event.addDomListener(window, 'load', initialize);
}
googlemaps();
</script>
<div id="map-canvas"></div>

<div class="table-responsive">    
<form action="jadwaldonor" id="formcari" method="POST">                 
    <div class="form-group form-inline pull-right" style="width: 410px;">                            
        <label for="exampleInputEmail1">Cari Lokasi :</label>
		<div class="input-group">
		<input type="text" style="width: 263px;" class="form-control" placeholder="Cari Lokasi..." id="tempat"  name="tempat">
		<span class="input-group-btn">
        <input class="btn btn-default" type="submit" value="Cari"/>
      </span>
    </div>
    </div>
<form>
<div id="form-sebelum">
<table class="table table-bordered table-striped">
<tr>
<th style="width: 10px">#</th>
<th>Instasi</th>
<th>Target</th>
<th>Tanggal</th>
<th>Waktu</th>
<th>Alamat</th>
<th>Link</th>
</tr>
<?php
$penomoran = 0;
if(isset($_POST['tempat'])){
$query = dapatkanlokasi($_POST['tempat']);
}else{
$query = dapatkandatadashboard('jadwaldanlokasi','id_jadwallokasi');	
}
if(mysqli_num_rows($query) != 0){
	while($n = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$instasi_jadwal = $n['instasi_jadwal'];
		$target_jumlah_jadwal = $n['target_jumlah_jadwal'];
		$tanggal_jadwal = $n['tanggal_jadwal'];
		$alamat_jadwal = $n['alamat_jadwal'];
		$kecamatan_jadwal = $n['kecamatan_jadwal'];
		$jam_jadwal = $n['jam_jadwal'];
		$penomoran++;
		?>
		<tr>
		<td><?php echo $penomoran.'.'?></td>
		<td><?php echo $instasi_jadwal?></td>
		<td><?php echo $target_jumlah_jadwal?></td>
		<td><?php echo date('j-F-Y',strtotime($tanggal_jadwal))?></td>
		<td><?php echo $jam_jadwal?></td>
		<td><?php echo $alamat_jadwal.', '.$kecamatan_jadwal?></td>
		<td><a  target="_blank" href="<?php echo $link_jadwal;?>"><button data-toggle="tooltip" title="<?php echo $link_jadwal;?>" type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i> Lihat</button></a></td>
		</tr>
		<?php
	}
}else{
	echo'<tr>
	<td colspan="12" align="center">Tidak Ada Jadwal</td>
	</tr>';
}
?>
</table>
</div>

</div>
</div>
<script type="text/javascript">
$('#formcari').submit(function(){
		var data = $("#tempat").val()
		if(data.length == 0){
			$("#infoSalah").html("Anda Belum Memasukan Lokasi!.");
			$("#modalInfo").modal();
			return false;
		}
})
</script>
<?php include('footer.php'); ?>