	<?php
	$query =  dapatkanlokasi($_POST['tempat']);
	while ($data = mysql_fetch_array($query)) {
		$lat = $data['lat_jadwal'];
		$lon = $data['lng_jadwal'];
		$nama = $data['instasi_jadwal'];
		$alamat = $data['alamat_jadwal'];
		$hari_jadwal = $data['hari_jadwal'];
		$tanggal_jadwal = $data['tanggal_jadwal'];
		$link_jadwal = $data['link_jadwal'];
		
		echo ("addMarker($lat, $lon, '<b>$nama</b><p>Alamat : $alamat</p><p>Pelaksanaan : $hari_jadwal, ".date('j-F-Y',strtotime($tanggal_jadwal))."</p><a href=".$link_jadwal.">Lihat Di Google Maps</a>');\n");                        
	}
	?>