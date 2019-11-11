<?php 
include('../fungsi.php');
if($_GET["x"] == 'login' || dapatkantotal($_GET["x"]) == FALSE){
			echo '
			<script>
				alert("Data Kosong!");
				window.history.back();
			</script>';		
}else{
$judul = date("Ymd"). "-" .str_replace("_"," ",$_GET["x"]);
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$judul.xls\"");
$arraykolom = array();
$sql=mysqli_query($GLOBALS['conn'],"SHOW COLUMNS FROM ".$_GET["x"]);
while ($arraykolom = mysqli_fetch_assoc($sql)){
  $kolom[] = $arraykolom['Field'];
  $penomoran = 0;
}
?>
<?php echo '<h2>PMI Denpasar</h2>';
	  echo '<h3 style="margin:0px 0px;">LAPORAN '.str_replace(array("_","VIEW"),array(" ", " "), strtoupper($_GET["x"])).'</h3>';
	  echo '<p style="margin:0px 0px;">Di Ambil Pada : '.date("d/m/Y").'</p><hr/>';?>
<table border="1" style="margin:10px 0px;">
<tr>
<th>No.</th>
<?php	
foreach ($kolom as $f) { 
?>
		<th><?php echo str_replace(array("_","PENDONOR"),array(" ", " "), strtoupper($f)) ?></th>
<?php
}
$query = dapatkandata($_GET["x"]);
if(mysqli_num_rows($query) != 0){
	while($n = mysqli_fetch_array($query)){
		  $penomoran++;
		 
?>
<tr>
<td><?php echo $penomoran;?>.</td>
<?php
	foreach ($kolom as $f) {
?>
	<td><?php echo $n[$f]?></td>
<?php
}
?>
</tr>
<?php
	}
}
?>
</tr>
</table>

<b>Jumlah Data : <?php echo mysqli_num_rows($query);?></b>
<?php
}

?>