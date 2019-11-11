	  <?php
		include('../fungsi.php');
	  ?>
	   <script src="<?php echo $url; ?>dist/js/form.js"></script>

<table id="datatble" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
		<thead>
		<tr>
		  <th>No.</th>
		  <th>ID Petugas</th>
		  <th>Nama</th>
		  <th>Posisi</th>
		  <th>Foto</th>
		  <th data-priority="1">Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$penomoran = 0;
		$query = dapatkandataperjabatan('petugas','id_petugas','nama_petugas',$_POST['jabatan']);
		if(mysqli_num_rows($query) != 0){
		while($r = mysqli_fetch_array($query)){
			$id_petugas 		= htmlspecialchars($r['id_petugas'], ENT_QUOTES, 'UTF-8');
			$username_petugas 	= htmlspecialchars($r['username'], ENT_QUOTES, 'UTF-8');
			$nama_petugas 		= htmlspecialchars($r['nama_petugas'], ENT_QUOTES, 'UTF-8');
			$posisi_petugas 	= htmlspecialchars($r['posisi_petugas'], ENT_QUOTES, 'UTF-8');
			$foto_petugas 		= htmlspecialchars($r['foto_petugas'], ENT_QUOTES, 'UTF-8');
			$penomoran++;
			?>
			<tr>
				  <td><?php echo $penomoran.'.'?></td>
				  <td><?php echo $id_petugas;?></td>
				  <td><?php echo $nama_petugas;?></td>
				  <td><?php echo $posisi_petugas;?></td>
				  <td><img class="img-thumbnail" src="<?php echo $url;?>img/<?php echo $foto_petugas;?>" width="80px" height="90px"></img></td>
				  <td><a href="<?php echo base_url(); ?>admin/petugas/ubah/<?php echo $id_petugas;?>"><button type="button" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i> Ubah</button></a> <button type="button" class="btn btn-xs btn-danger btn-flat" data-toggle="modal" data-target="#modalHapus" onclick="formHapus('Apakah Anda Ingin Menghapus <?php echo $id_petugas;?> .?','<?php echo $id_petugas;?>')"><i class="fa fa-trash"></i> Hapus</button></td>
				</tr>
		<?php
		}
		}else{
			echo'<tr>
				<td colspan="6" align="center">Belum Ada Data Petugas</td>
				</tr>';
		}
		?>
			</table>



