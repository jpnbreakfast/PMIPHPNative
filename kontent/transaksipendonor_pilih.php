<?php 
include('../fungsi.php');
?>
<p>Klik Pada ID Pendonor Untuk Memilih Pencarian Data</p>
<table class="table table-bordered table-striped">
		<thead>
		<tr>
		  <th>ID Pendonor.</th>
		  <th>Nama</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$query = dapatkandatadistinct('id_pendonor','nama_lengkap_pendonor','daftarpendonorunitdarah');
		if(mysqli_num_rows($query) != 0){
		while($n = mysqli_fetch_array($query)){
			$id_pendonor = $n['id_pendonor'];
			$nama_pendonor = $n['nama_lengkap_pendonor'];
			?>
			<tr>
				  <td><a id="<?php echo $id_pendonor;?>" href="#" onclick="pilihanpendonorModals(this)" ><?php echo $id_pendonor;?></a></td>
				  <td><?php echo $nama_pendonor;?></td>
				</tr>
		<?php
		}
		}
		?>
		</table>
		<p id="pilihandata"></p>
