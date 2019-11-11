<?php include('../fungsi.php'); ?>
<table class="table table-bordered table-striped" onLoad="setupFunc();">
<tr>
<th style="width: 10px">#</th>
<th>Instasi</th>
<th>Target</th>
<th>Tanggal</th>
<th>Waktu</th>
<th>Alamat</th>
<th>Link</th>
</tr>
<?php
$penomoran = 0;
$query = dapatkanlokasi($_POST['tempat']);
if(mysqli_num_rows($query) != 0){
	while($n = mysqli_fetch_array($query)){
		$instasi_jadwal 		= htmlspecialchars($n['instasi_jadwal'], ENT_QUOTES, 'UTF-8');
		$target_jumlah_jadwal 	= htmlspecialchars($n['target_jumlah_jadwal'], ENT_QUOTES, 'UTF-8');
		$tanggal_jadwal 		= htmlspecialchars($n['tanggal_jadwal'], ENT_QUOTES, 'UTF-8');
		$alamat_jadwal 			= htmlspecialchars($n['alamat_jadwal'], ENT_QUOTES, 'UTF-8');
		$kecamatan_jadwal 		= htmlspecialchars($n['kecamatan_jadwal'], ENT_QUOTES, 'UTF-8');
		$jam_jadwal 			= htmlspecialchars($n['jam_jadwal'], ENT_QUOTES, 'UTF-8');
		$penomoran++;
?>
		<tr>
		<td><?php echo $penomoran.'.'?></td>
		<td><?php echo $instasi_jadwal?></td>
		<td><?php echo $target_jumlah_jadwal?></td>
		<td><?php echo date('j-F-Y',strtotime($tanggal_jadwal))?></td>
		<td><?php echo $jam_jadwal?></td>
		<td><?php echo $alamat_jadwal.', '.$kecamatan_jadwal?></td>
		<td><a  target="_blank" href="<?php echo $link_jadwal;?>"><button data-toggle="tooltip" title="<?php echo $link_jadwal;?>" type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i> Lihat</button></a></td>
		</tr>
		<?php
	}
}else{
	echo'<tr>
						<td colspan="12" align="center">Tidak Ada Data "'.$_POST['tempat'].'" Dalam Jadwal</td>
						</tr>';
}
?>
</table>