<?php 
include('../fungsi.php');
if($_POST['halaman'] == 'login'){
			echo '
			<script>
				window.history.back();
			</script>';		
}else{
$arraykolom = array();
$sql=mysqli_query(koneksi_global(),'SHOW COLUMNS FROM '.$_POST['halaman'].'');
while ($arraykolom = mysqli_fetch_assoc($sql)){
$kolom[] = $arraykolom['Field'];
}
?>
<table style="text-align:left; width:100%;">
<?php	
$query = dapatkandatapilihan($_POST['halaman'],$_POST['col'],$_POST['id']);
$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
foreach ($kolom as $f) { 

?>
		<tr>
			<th style="text-align:left; width:50px;"><?php echo str_replace(array("_",),array(" "), strtoupper($f)) ?></th>
			<td style="text-align:left; width:5px;"> : </td>
			<td style="text-align:left; width:90px;"><?php echo $row[$f];?></td>
		</tr>
<?php


}
	
	 
?>


</table>
<?php
}
?>