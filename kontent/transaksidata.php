	   
	  <?php
		include('../fungsi.php');
	  ?>
	   <script src="<?php echo $url; ?>dist/js/form.js"></script>
	  <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
		  <th>Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$status = "Ada";
		$penomoran = 0;
		$query = dapatkandatapilihanbanyak($_POST["data"],$_POST["tipe"]);
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
				  <td><a id="<?php echo $id_pendonor;?>" hal="pendonor" jud="Pendonor" col="id_pendonor" href="#" class="modals" onclick="infoPendonor()" ><?php echo $id_pendonor;?></a></td>
				  <td><?php echo $nama_pendonor;?></td>
				  <td><a id="<?php echo $nomor_kantong_darah;?>" hal="unit_darah" jud="Unit Darah" col="nomor_kantong_darah" href="#" class="modals" onclick="infoPendonor()" ><?php echo $nomor_kantong_darah;?></a></td>
				  <td><?php echo $golongan_darah;?></td>
				  <td><a id="<?php echo $id_jadwal;?>" hal="jadwal" jud="Unit Darah" col="id_jadwal" href="#" class="modals" onclick="infoPendonor()" ><?php echo $id_jadwal;?></a></td>
				  <td><?php echo date('j-F-Y',strtotime($tanggal));?></td>
				  <td><?php echo $pengambilan;?></td>
				  <td><a href="<?php echo base_url();?>admin/transaksi/ubah/<?php echo $id_transaksi;?>"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i> Ubah</button></a> <button type="button" class="btn btn-xs btn-danger btn-flat" onclick="formHapus('Apakah Anda Ingin Menghapus <?php echo $id_transaksi;?> .?','<?php echo $id_transaksi;?>')"><i class="fa fa-trash"></i> Hapus</button></td>
				</tr>
		<?php
		}
		}else{
			$status = "Tidak Ada";
			echo'<tr>
				<td colspan="10" align="center">Tidak Ada Transaksi Berdasarkan "'.$_POST["data"].'" </td>
				</tr>';
		}
		?>
			</table>
			
		<br/>
<?php if($_POST["tipe"] == "pendonor" && $status == "Ada"){
    echo'<h3>Statistik</h3>
		 <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <tr>
                  <th style="width: 25%">ID Pendonor</th>
					<th><b>Nama</b></th>
					<th><b>Golongan Darah</b></th>
				   <th>Jumlah Transaksi</th>
                </tr>
				<tr>
				<td>'.htmlspecialchars($_POST["data"], ENT_QUOTES, 'UTF-8').'</td>
				<td>'.$nama_pendonor.'</td>
				<td>'.$golongan_darah.'</td>';
				 echo'<td>'.perpendonortotal($_POST["data"]).'x</td>
				</tr>
				</table>';
}else if($penomoran == 0 || $status == "Tidak Ada"){
	
}else{
	$goldar  = array('A','B','O','AB');
	if(htmlspecialchars($_POST["tipe"], ENT_QUOTES, 'UTF-8') == "perbulan"){
		$tekstipepencarian = "Bulan";
		$tekskalender = date('F-Y',strtotime(htmlspecialchars($_POST["data"], ENT_QUOTES, 'UTF-8')));
	}else{
		$tekstipepencarian = "Tanggal";
		$tekskalender = date('j-F-Y',strtotime(htmlspecialchars($_POST["data"], ENT_QUOTES, 'UTF-8')));
	}
    echo'<h3>Statistik</h3>
		 <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <tr>
                  <th style="width: 25%">'.$tekstipepencarian.'</th>';
					foreach($goldar as $pecah){
                  echo'<th><b>'.$pecah.'</b></th>';
					}
				   echo'<th>Total</th>
                </tr>
				<tr>
				<td>'.$tekskalender.'</td>';
				foreach($goldar as $pecah){
					  echo'<td>'.dapatkandatapilihanbanyakdarah(htmlspecialchars($_POST["data"], ENT_QUOTES, 'UTF-8'),htmlspecialchars($_POST["tipe"], ENT_QUOTES, 'UTF-8'),$pecah).'</td>';
				}
				 echo'<td>'.hitungpilihanbanyakdarah(htmlspecialchars($_POST["data"], ENT_QUOTES, 'UTF-8'),htmlspecialchars($_POST["tipe"], ENT_QUOTES, 'UTF-8'),$pecah).'</td>
				</tr>
              </table>';
			  
	}
?>