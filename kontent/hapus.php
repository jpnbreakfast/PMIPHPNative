<?php
include('../fungsi.php');
if(hapusdata($_GET['tabel'],$_GET['col'],$_GET['id'])){
	echo 'success';
}else{
	echo 'fail';
}
include('hapus_login.php');
?>