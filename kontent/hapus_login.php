<?php
	$query = dapatkandatapilihan('petugas','id_petugas',$_GET['id']);
	$r = mysqli_fetch_array($query);
	$username_petugas = $r['username'];
	$q_hapus	= 'DELETE FROM login WHERE username_login = "'.$username_petugas.'"';
	$p_hapus	= mysqli_query(koneksi_global(),$q_hapus);
?>