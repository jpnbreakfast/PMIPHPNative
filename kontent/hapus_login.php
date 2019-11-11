<?php
	$query = dapatkandatapilihan('petugas','id_petugas',htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'));
	$r = mysqli_fetch_array($query);
	$username_petugas = htmlspecialchars($r['username'], ENT_QUOTES, 'UTF-8');
	$q_hapus	= 'DELETE FROM login WHERE username_login = "'.$username_petugas.'"';
	$p_hapus	= mysqli_query(koneksi_global(),$q_hapus);
?>