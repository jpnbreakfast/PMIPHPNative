<?php
include "../fungsi.php";
?>

<?php
$i = -1;
$lokasi = "";
$query = dapatkandata2($_GET['posisi']);
$geojson = array( 'type' => 'FeatureCollection', 'features' => array());
if (mysqli_num_rows($query) != 0) {
    while ($n = mysqli_fetch_array($query)) {

        $i++;
        $instasi_jadwal = htmlspecialchars($n['instasi_jadwal'], ENT_QUOTES, 'UTF-8');
        $target_jumlah_jadwal = htmlspecialchars($n['target_jumlah_jadwal'], ENT_QUOTES, 'UTF-8');
        $doketer_jadwallokasi = htmlspecialchars($n['doketer_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $tensi_jadwallokasi = htmlspecialchars($n['tensi_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $hb_jadwallokasi = htmlspecialchars($n['hb_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $aftaper_jadwallokasi = htmlspecialchars($n['aftaper_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $admin_jadwallokasi = htmlspecialchars($n['admin_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $supir_jadwallokasi = htmlspecialchars($n['supir_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $tanggal_jadwal = htmlspecialchars($n['tanggal_jadwal'], ENT_QUOTES, 'UTF-8');
        $jam_jadwal = htmlspecialchars($n['jam_jadwal'], ENT_QUOTES, 'UTF-8');
        $alamat_jadwal = htmlspecialchars($n['alamat_jadwal'], ENT_QUOTES, 'UTF-8');
        $kecamatan_jadwal = htmlspecialchars($n['kecamatan_jadwal'], ENT_QUOTES, 'UTF-8');
        $link_jadwal = htmlspecialchars($n['link_jadwal'], ENT_QUOTES, 'UTF-8');
        $id_jadwallokasi = htmlspecialchars($n['id_jadwallokasi'], ENT_QUOTES, 'UTF-8');
        $lat_jadwal = htmlspecialchars($n['lat_jadwal'], ENT_QUOTES, 'UTF-8');
        $lng_jadwal = htmlspecialchars($n['lng_jadwal'], ENT_QUOTES, 'UTF-8');


  $marker = array(
    'type' => 'Feature',
    'id' => $i, 
    'properties' => array(
      'NAME' => $n['instasi_jadwal'],
      'TEL' => $n['id_jadwallokasi'],
      'DESCRIPTION' => $n['id_jadwallokasi'],
      'ADRESS1' => $n['id_jadwallokasi'],
      'ADDRESS2' => $n['id_jadwallokasi'],
      'CITY' => $n['id_jadwallokasi'],
      'ZIP' => $n['id_jadwallokasi']

    ),
    'geometry' => array(
      'type' => 'Point',
      'coordinates' => array( 
        $lng_jadwal,
        $lat_jadwal
      )
    )
  );
  array_push($geojson['features'], $marker);


    }

}else{
  $marker = array(
    'type' => 'Feature',
    'id' => $i, 
    'properties' => array(
      'NAME' => "",
      'TEL' => "",
      'DESCRIPTION' => "",
      'ADRESS1' => "",
      'ADDRESS2' => "",
      'CITY' => "",
      'ZIP' => ""

    ),
    'geometry' => array(
      'type' => 'Point',
      'coordinates' => array( 
        "0",
        "0"
      )
    )
  );
  array_push($geojson['features'], $marker);
}

echo json_encode($geojson,JSON_PRETTY_PRINT);
?>
