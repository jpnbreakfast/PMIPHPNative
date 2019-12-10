<?php
$GLOBALS['conn'] = mysqli_connect('localhost', 'root', '1911');

function koneksi_global()
{
    return $GLOBALS['conn'];
}
//Database
function koneksi_db()
{

    if ($GLOBALS['conn']) {
        mysqli_select_db($GLOBALS['conn'], 'pmifix2') or die(mysqli_error($GLOBALS['conn']));
    } else {
        echo 'Kesalahan Dalam Koneksi Database';
    }
}
//Call Database
koneksi_db();

function cek_user($db, $kode)
{
    $q = "SELECT * FROM $db";
    $p = $GLOBALS['conn']->query($q) or die(mysqli_error);
    $out = 'tidak_sama';
    while ($r = mysqli_fetch_array($p)) {
        $kode_awal = strtolower($r['nama_petugas']);
        $kode = strtolower($kode);
        if ($kode == $kode_awal) {
            $out = "sama";
        }
    }
    return $out;
}

//Root Path
$url = 'http://127.0.0.1/pmi/';

function base_url()
{
    $url = 'http://127.0.0.1/pmi/';
    return $url;
}
$eksporexcel = 'http://127.0.0.1/pmi/kontent/exporexcel.php?x=';
function dapatkaninfo($username)
{
    $q = 'SELECT * FROM petugas WHERE username="' . $username . '" LIMIT 1'; //select berdasarkan LogUsername yang diinputkan saat login
    $p = mysqli_query($GLOBALS['conn'], $q) or die(mysqli_error);
    $n = mysqli_fetch_array($p);
    $id = $n['id_petugas'];
    $nama = $n['nama_petugas'];
    $posisi = $n['posisi_petugas'];
    $username = $n['username'];
    $foto = $n['foto_petugas'];
    $arrayinfo = array($nama, $posisi, $foto, $id, $username);
    return $arrayinfo;
}

function dapatkandata($nama_tabel)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM ' . $nama_tabel . '');
}

function dapatkandata2($kecamatan)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM jadwaldanlokasi WHERE kecamatan_jadwal = "' . $kecamatan . '";');
}

function dapatkandatadashboard($nama_tabel, $orderkolom)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM ' . $nama_tabel . ' ORDER BY ' . $orderkolom . ' DESC LIMIT 5');
}

function dapatkandataperjabatan($nama_kolom, $nama_kolom2, $nama_tabel, $jabatan = null)
{
    $query = 'SELECT * FROM petugas';
    if ($jabatan != null) {
        $query .= ' WHERE posisi_petugas = "' . $jabatan . '"';
    }
    return mysqli_query($GLOBALS['conn'], $query);
}

function dapatkandatadistinct($nama_kolom, $nama_kolom2, $nama_tabel)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT DISTINCT ' . $nama_kolom . ',' . $nama_kolom2 . ' FROM ' . $nama_tabel . '');
}

function dapatkandatapetugas($posisi)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM `petugas` WHERE posisi_petugas = "' . $posisi . '"');
}

function dapatkandatapilihan($nama_tabel, $nama_kolom, $id_data)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM ' . $nama_tabel . ' WHERE ' . $nama_kolom . ' = "' . $id_data . '" LIMIT 1');
}

function dapatkanlokasi($id_data)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM jadwaldanlokasi WHERE alamat_jadwal LIKE "%' . $id_data . '%" OR kecamatan_jadwal LIKE "%' . $id_data . '%" OR `instasi_jadwal` LIKE "%' . $id_data . '%"');
}

function dapatkandatapilihanbanyak($id_data, $tipepencarian)
{
    if ($tipepencarian == "perhari") {
        $q = 'SELECT * FROM `transaksi` WHERE `tanggal` LIKE "%' . $id_data . '%"';
    } else if ($tipepencarian == "perbulan") {
        $q = 'SELECT * FROM `transaksi` WHERE `tanggal` LIKE "%' . $id_data . '%"';
    } else {
        $q = 'SELECT * FROM `transaksi` WHERE `id_pendonor` = "' . $id_data . '"';
    }
    return mysqli_query($GLOBALS['conn'], $q);
}

function perpendonortotal($id_data)
{
    $query = mysqli_query($GLOBALS['conn'], 'SELECT COUNT(*) FROM `transaksi` WHERE `id_pendonor` = "' . $id_data . '"');
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function dapatkandatapilihanbanyakdarah($id_data, $tipepencarian, $golongandarah)
{
    if ($tipepencarian == "perhari") {
        $q = 'SELECT COUNT(*) FROM`transaksi` WHERE `tanggal` LIKE "%' . $id_data . '%" AND `golongan_darah`  = "' . $golongandarah . '"';
    } else if ($tipepencarian == "perbulan") {
        $q = 'SELECT COUNT(*) FROM `transaksi` WHERE `tanggal` LIKE "%' . $id_data . '%" AND `golongan_darah`  = "' . $golongandarah . '"';
    } else {
        $q = 'SELECT COUNT(*) FROM `transaksi` WHERE `nama_pendonor` LIKE "%' . $id_data . '%" AND `golongan_darah`  = "' . $golongandarah . '"';
    }
    $query = mysqli_query($GLOBALS['conn'], $q);
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function hitungpilihanbanyakdarah($id_data, $tipepencarian, $golongandarah)
{
    if ($tipepencarian == "pendonor") {
        $q = 'SELECT COUNT(*) FROM `transaksi` WHERE `nama_pendonor` LIKE "%' . $id_data . '%"';
    } else {
        $q = 'SELECT COUNT(*) FROM `transaksi` WHERE `tanggal` LIKE "%' . $id_data . '%"';
    }

    $query = mysqli_query($GLOBALS['conn'], $q);
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function dapatkandatapilihanbanyaktransaksi($id_data)
{
    $q = 'SELECT * FROM `unit_darah` WHERE `id_pendonor` = "' . $id_data . '"';
    return mysqli_query($GLOBALS['conn'], $q);
}

function dapatkandataterkecuali($nama_tabel, $nama_kolom1, $nama_kolom2, $id_data1, $id_data2)
{
    return $query = mysqli_query($GLOBALS['conn'], 'SELECT * FROM ' . $nama_tabel . ' WHERE NOT (' . $nama_kolom1 . ' = "' . $id_data1 . '" AND ' . $nama_kolom2 . ' = "' . $id_data2 . '")');
}

function dapatkantotal($nama_tabel)
{
    $query = mysqli_query($GLOBALS['conn'], "SELECT COUNT(*) FROM $nama_tabel;");
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function dapatkantotaldarah($golongandarah, $rhesus)
{
    if (strlen($rhesus) == 0) {
        $q = "SELECT COUNT(*) FROM unit_darah WHERE golongan_darah = '$golongandarah';";
    } else {
        $q = "SELECT COUNT(*) FROM unit_darah WHERE golongan_darah = '$golongandarah' AND rhesus_darah = '$rhesus';";
    }
    $query = mysqli_query($GLOBALS['conn'], $q);
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function hapusdata($nama_tabel, $nama_kolom, $id_data)
{
    $query = mysqli_query($GLOBALS['conn'], 'DELETE FROM ' . $nama_tabel . ' WHERE ' . $nama_kolom . ' = "' . $id_data . '"');
    if ($query) {
        return true;
    } else {
        return false;
    }
}

function transaksi_chart($bulan){
    $query = mysqli_query($GLOBALS['conn'],'SELECT COUNT(*) AS jumlah FROM `transaksi` WHERE YEAR(`tanggal`) = YEAR(CURDATE()) AND MONTH(`tanggal`) = '.$bulan.'');
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function transaksi_report($bulandari,$bulanke){
    return mysqli_query($GLOBALS['conn'],'SELECT * FROM `transaksi` WHERE `tanggal` BETWEEN "'.$bulandari.'" AND "'.$bulanke.'"');
}

function dapatkantotaldaerah($kec)
{
    $q = "SELECT COUNT(*) FROM jadwaldanlokasi WHERE kecamatan_jadwal = '$kec';";
    $query = mysqli_query($GLOBALS['conn'], $q);
    $result = mysqli_fetch_array($query);
    return $result[0];
}

function simpanLog($id_petugas,$aksi,$nama_tabel,$id_data_table,$deskripsi){
    $id_petugas = htmlspecialchars($id_petugas, ENT_QUOTES, 'UTF-8');
    $aksi = htmlspecialchars($aksi, ENT_QUOTES, 'UTF-8');
    $nama_tabel = htmlspecialchars($nama_tabel, ENT_QUOTES, 'UTF-8');
    $id_data_table = htmlspecialchars($id_data_table, ENT_QUOTES, 'UTF-8');
    $deskripsi = htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8');
    $waktu = date("Y-m-d H:i:s");

    $q_kode = mysqli_query($GLOBALS['conn'], 'SELECT * FROM `log`');

    $kodt_baru = '';
    $angka_baru = 0;
    $kata = 'log';

    if (mysqli_num_rows($q_kode) != 0) {
        while ($r_kode = mysqli_fetch_array($q_kode)) {
            $kode = $r_kode['id_log'];
            $angka_kode = str_replace($kata, '', $kode);

            if ($angka_baru < $angka_kode) {
                $angka_baru = $angka_kode;
                $angka = $angka_baru + 1;
                $kodt_baru = $kata . '' . $angka;
            }
        }
    } else {
        $kodt_baru = $kata . '1';
    }

    $q_tambah = 'INSERT INTO `log` VALUES("' . $kodt_baru . '","' . $id_petugas . '","' . $waktu . '","' . $aksi . '","' . $id_data_table . '","' . $nama_tabel . '","' . $deskripsi . '")';
    $q_tambah = mysqli_query(koneksi_global(), $q_tambah) or die(mysqli_error());
}

function dapatkandatalogperuser($idpetugas)
{
    return mysqli_query($GLOBALS['conn'], 'SELECT * FROM `log` WHERE id_petugas = "' . $idpetugas . '"');
}

function dapatkandatalogsemua($type,$bulandari,$bulanke)
{
    if($type == "semua"){
        $query = "SELECT `log`.*,petugas.nama_petugas FROM `log` JOIN petugas ON `log`.id_petugas = petugas.id_petugas";
    }else{
        $query = "SELECT `log`.*,petugas.nama_petugas FROM `log` JOIN petugas ON `log`.id_petugas = petugas.id_petugas WHERE CONVERT(`waktu`,DATE) BETWEEN '$bulandari' AND '$bulanke'";
    }
    
    return mysqli_query($GLOBALS['conn'], $query);
}

