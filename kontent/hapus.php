<?php
include('../fungsi.php');

if(hapusdata(htmlspecialchars($_GET['tabel'], ENT_QUOTES, 'UTF-8'),htmlspecialchars($_GET['col'], ENT_QUOTES, 'UTF-8'),htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'))){
	echo 'success';
}else{
	echo 'fail';
}
include('hapus_login.php');
?>