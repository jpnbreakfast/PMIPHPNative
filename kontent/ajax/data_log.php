<?php 
include('../../fungsi.php');
?>
<table id="datatble" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No.</th>
			<th>Nama Petugas</th>
            <th>Waktu</th>
            <th>Aksi</th>
            <th>Bagian</th>
            <th>ID Data</th>
        </tr>
    </thead>
    <tbody>
        <?php
			$penomoran = 0;
			$query = dapatkandatalogsemua($_POST['type_pencarian'],$_POST['bulandari'],$_POST['bulanke']);
			if (mysqli_num_rows($query) != 0) {
				while ($r = mysqli_fetch_array($query)) {
					$nama_petugas = htmlspecialchars($r['nama_petugas'], ENT_QUOTES, 'UTF-8');
					$waktu = htmlspecialchars($r['waktu'], ENT_QUOTES, 'UTF-8');
					$aksi = htmlspecialchars($r['aksi'], ENT_QUOTES, 'UTF-8');
					$id_data_table = htmlspecialchars($r['id_data_table'], ENT_QUOTES, 'UTF-8');
					$nama_table = htmlspecialchars($r['nama_table'], ENT_QUOTES, 'UTF-8');

					if ($nama_table == "unit_darah") {
						$kolom_id_table = "nomor_kantong_darah";
					} elseif ($nama_table == "pendonor") {
						$kolom_id_table = "id_pendonor";
					} elseif ($nama_table == "petugas") {
						$kolom_id_table = "	id_petugas";
					} elseif ($nama_table == "transaksi") {
						$kolom_id_table = "	id_transaksi";
					} elseif ($nama_table == "jadwallokasi") {
						$kolom_id_table = "	id_jadwallokasi";
					} elseif ($nama_table == "jadwal") {
						$kolom_id_table = "	id_jadwal";
					}

					$penomoran++;
					?>
					<tr>
						<td><?php echo $penomoran . '.' ?></td>
						<td><?php echo $nama_petugas ?></td>
						<td><?php echo date('j-F-Y',strtotime($waktu)); ?></td>
						<td><?php echo $aksi; ?></td>
						<td><?php echo $nama_table; ?></td>
						<td><a id="<?php echo $id_data_table; ?>" hal="<?php echo $nama_table; ?>" jud="Log Aktivitas"
								col="<?php echo $kolom_id_table; ?>" href="#" class="modals"
								onclick="infoPendonor()"><?php echo $id_data_table; ?></a></td>
					</tr>
					<?php
			}
			} else {
				echo '<tr>
											<td colspan="6" align="center">Belum Ada Aktivitas</td>
											</tr>';
			}
		?>
</table>