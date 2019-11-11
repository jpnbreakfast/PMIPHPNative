<?php 
include('../fungsi.php');
?>
<table id="datatble" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
		<thead>
		<tr>
		  <th>No.</th>
		  <th>ID Transaksi</th>
		  <th>ID Pendonor</th>
		  <th>Nama Pendonor</th>
		  <th>Nomor Kantong Darah</th>
		  <th>Golongan Darah</th>
		  <th>ID Jadwal</th>
		  <th>Tanggal</th>
		  <th>Pengambilan</th>
		</tr>
		</thead>
		<tbody>
        <?php
        
		$penomoran = 0;
		$query = transaksi_report($_POST['bulandari'],$_POST['bulanke']);
		if(mysqli_num_rows($query) != 0){
		while($r = mysqli_fetch_array($query)){
			$id_transaksi			= htmlspecialchars($r['id_transaksi'], ENT_QUOTES, 'UTF-8');
			$id_pendonor			= htmlspecialchars($r['id_pendonor'], ENT_QUOTES, 'UTF-8');
			$nama_pendonor			= htmlspecialchars($r['nama_pendonor'], ENT_QUOTES, 'UTF-8');
			$nomor_kantong_darah 	= htmlspecialchars($r['nomor_kantong_darah'], ENT_QUOTES, 'UTF-8');
			$golongan_darah 		= htmlspecialchars($r['golongan_darah'], ENT_QUOTES, 'UTF-8');
			$id_jadwal 				= htmlspecialchars($r['id_jadwal'], ENT_QUOTES, 'UTF-8');
			$tanggal				= htmlspecialchars($r['tanggal'], ENT_QUOTES, 'UTF-8');
			$pengambilan			= htmlspecialchars($r['pengambilan'], ENT_QUOTES, 'UTF-8');
			
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $id_transaksi;?></td>
				  <td><?php echo $id_pendonor;?></td>
				  <td><?php echo $nama_pendonor;?></td>
				  <td><?php echo $nomor_kantong_darah;?></td>
				  <td><?php echo $golongan_darah;?></td>
				  <td><?php echo $id_jadwal;?></td>
				  <td><?php echo date('j-F-Y',strtotime($tanggal));?></td>
				  <td><?php echo $pengambilan;?></td>
				</tr>
		<?php
		}
		}else{
			echo'<tr>
				<td colspan="12" align="center">Belum Ada Data Transaksi</td>
				</tr>';
		}
		?>
			</table>