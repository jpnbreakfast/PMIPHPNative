<?php 
include('../fungsi.php');
if($_POST['halaman'] == 'login'){
			echo '
			<script>
				window.history.back();
			</script>';		
}else{
$arraykolom = array();
$sql=mysqli_query(koneksi_global(),'SHOW COLUMNS FROM '.htmlspecialchars($_POST['halaman'], ENT_QUOTES, 'UTF-8').'');
	while ($arraykolom = mysqli_fetch_assoc($sql)){
		$kolom[] = $arraykolom['Field'];
	}
?>
<table style="text-align:left; width:100%;">
<?php	
$query 	= dapatkandatapilihan(htmlspecialchars($_POST['halaman'], ENT_QUOTES, 'UTF-8'),htmlspecialchars($_POST['col'], ENT_QUOTES, 'UTF-8'),htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
$row	= mysqli_fetch_array($query,MYSQLI_ASSOC);
foreach ($kolom as $f) { 

?>
		<tr>
			<th style="text-align:left; width:50px;"><?php echo str_replace(array("_",),array(" "), strtoupper(htmlspecialchars($f, ENT_QUOTES, 'UTF-8'))) ?></th>
			<td style="text-align:left; width:5px;"> : </td>
			<td style="text-align:left; width:90px;"><?php echo htmlspecialchars($row[$f], ENT_QUOTES, 'UTF-8');?></td>
		</tr>
<?php
}	 
?>

</table>
<?php
}
?>