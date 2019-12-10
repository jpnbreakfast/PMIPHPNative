<?php
if (isset($_GET['id'])) {
    $query = dapatkandatapilihan($_GET['halaman'], 'id_petugas', $_GET['id']);
    if (mysqli_num_rows($query) != 0) {
        $r = mysqli_fetch_array($query);
        $id_petugas = htmlspecialchars($r['id_petugas'], ENT_QUOTES, 'UTF-8');
        $username_petugas = htmlspecialchars($r['username'], ENT_QUOTES, 'UTF-8');
        $nama_petugas = htmlspecialchars($r['nama_petugas'], ENT_QUOTES, 'UTF-8');
        $posisi_petugas = htmlspecialchars($r['posisi_petugas'], ENT_QUOTES, 'UTF-8');
        $foto_petugas = htmlspecialchars($r['foto_petugas'], ENT_QUOTES, 'UTF-8');
        $posisi = array('Dokter', 'Supir', 'HB', 'Aftaper', 'Tensi', 'Administrator', 'Administrator Web');
        $query_login = dapatkandatapilihan('login', 'username_login', $username_petugas);
        $r_login = mysqli_fetch_array($query_login);
        $id_login = $r_login['id_login'];

    } else {
        $id_petugas = '';
        $nama_petugas = '';
        $posisi_petugas = '';
        $foto_petugas = '';
        echo"
		<script>
			$(document).ready(function () {
				Swal.fire({
					title: 'Kesalahan!',
					text: 'Data Yang Dipilih Salah!',
					type: 'warning',
					showCancelButton: false,
					showConfirmButton: true,
				}).then((result) => {
					if (result.value) {
						window.location='".base_url()."/admin/petugas/';
					} 
				  })
			});
		</script>";
    }
}
?>
<script>
	sembunyiform();
</script>
<div class="modal fade" id="modalInfo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Informasi</h4>
			</div>
			<div class="modal-body">
				<p id="infoSalah"></p>
			</div>
			<div id="buttonOK" class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">OK</button>
			</div>
			<div id="buttonKembali" class="modal-footer">
				<a href="<?php echo base_url(); ?>admin/petugas/"><button type="button"
						class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Kembali</button></a>
			</div>
		</div>
	</div>
</div>
<section class="content-header">
	<h1>
		Ubah
		<small>Petugas</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li>Petugas</li>
		<li class="active">Ubah</li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Ubah Petugas</h3>
		</div>
		<form method="post" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group">
					<label for="id_petugas" class="control-label">ID Petugas</label>
					<div>
						<input type="text" class="form-control" disabled="disabled" value="<?php echo $id_petugas; ?>"
							id="id_petugas">
						<input type="hidden" name="id_petugas" value="<?php echo $id_petugas; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="nama_lengkap" class="control-label">Nama</label>
					<div>
						<input type="text" class="form-control" value="<?php echo $nama_petugas; ?>" id="nama_lengkap"
							name="nama_lengkap" required>
					</div>
				</div>
				<div class="form-group">
					<label for="posisi_petugas" class="control-label">Posisi</label>
					<div>
						<select class="form-control" id="posisi_petugas" name="posisi_petugas"
							onchange="petugas_level()" required>
							<?php
								foreach ($posisi as $option) {
									if ($posisi_petugas == $option) {
										echo "<option selected='selected' value='$option'>$option</option>";
									} else {
										echo "<option value='$option'>$option</option>";
									}
								}
							?>
						</select>
					</div>
				</div>
				<div id="username_layout" class="form-group">
					<label for="username_petugas" class="control-label">Username</label>
					<div>
						<input type="username" class="form-control" value="<?php echo $username_petugas; ?>"
							id="username_petugas" name="username_petugas">
					</div>
				</div>
				<div id="password_layout" class="form-group">
					<label for="password_petugas" class="control-label">Password</label>
					<div>
						<input type="password" class="form-control" id="password_petugas" name="password_petugas">
					</div>
				</div>
				<div class="form-group">
					<label for="foto_petugas" class="control-label">Foto</label>
					<div>
						<span class="input-group-btn" style="text-align: left;">
							<img class="img-thumbnail" src="../../../img/<?php echo $foto_petugas; ?>" width="80px"
								height="90px"></img>
						</span>
						<input type="file" class="form-control" value="<?php echo $foto_petugas; ?>" id="foto_petugas"
							name="foto_petugas">
					</div>
				</div>
				<div class="form-group">
					<div>
						<a href="<?php echo base_url(); ?>admin/petugas/"><button type="button"
								class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button></a>
						<button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-save"></i>
							Ubah</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>

<?php
if (isset($_POST['submit'])) {
    $e_id_petugas 		= htmlspecialchars($_POST['id_petugas'], ENT_QUOTES, 'UTF-8');
    $e_posisi_petugas 	= htmlspecialchars($_POST['posisi_petugas'], ENT_QUOTES, 'UTF-8');
    $e_nama_petugas 	= htmlspecialchars($_POST['nama_lengkap'], ENT_QUOTES, 'UTF-8');
    $e_username_petugas = htmlspecialchars($_POST['username_petugas'], ENT_QUOTES, 'UTF-8');
    $e_password_petugas = htmlspecialchars($_POST['password_petugas'], ENT_QUOTES, 'UTF-8');
    $lokasi_file = $_FILES['foto_petugas']['tmp_name'];
    if (!empty($lokasi_file)) {
        unlink("../../../img/" . $foto_petugas);
        $e_foto = $e_id_petugas . '_' . $_FILES['foto_petugas']['name'];
        $lokasi_tujuan = '../img/' . $e_foto . '';
        move_uploaded_file($lokasi_file, $lokasi_tujuan);
    } else {
        $e_foto = $foto_petugas;
    }

    {
        if (strlen($e_username_petugas) == 0 && $e_posisi_petugas == "Administrator Web") {
            $q_edit_password = 'UPDATE login SET password_login="' . password_hash($e_password_petugas, PASSWORD_DEFAULT) . '" WHERE id_login = "' . $id_login . '"';
        } elseif (strlen($e_password_petugas) == 0 && $e_posisi_petugas == "Administrator Web") {
            $q_edit_password = 'UPDATE login SET username_login="' . $e_username_petugas . '" WHERE id_login = "' . $id_login . '"';
        } else {
            $q_edit_password = 'UPDATE login SET username_login="' . $e_username_petugas . '", password_login="' . password_hash($e_password_petugas, PASSWORD_DEFAULT) . '" WHERE id_login = "' . $id_login . '"';
        }
        $p_edit_password = mysqli_query(koneksi_global(), $q_edit_password) or die(mysqli_error());
        $q_edit = 'UPDATE petugas SET username="' . $e_username_petugas . '", nama_petugas="' . $e_nama_petugas . '", posisi_petugas="' . $e_posisi_petugas . '", foto_petugas="' . $e_foto . '" WHERE id_petugas="' . $e_id_petugas . '"';
        $p_edit = mysqli_query(koneksi_global(), $q_edit) or die(mysqli_error());
        if ($p_edit) {
			simpanLog(dapatkaninfo(username)[3], "Ubah", "petugas", "$e_id_petugas", "ID Petugas : $e_id_petugas <br/> Posisi : $e_posisi_petugas <br/> Nama : $e_nama_petugas");
            echo "<script>
					$(document).ready(function(){
						Swal.fire({
							title: 'Sukses!',
							text: 'Sukses Mengubah Data!,Harap Menungu Halaman Akan Di Refresh!',
							type: 'success',
							showCancelButton: false,
							showConfirmButton: false,
						})
					});
					setTimeout(function(){window.location='" . base_url() . "/admin/petugas/';}, 1000);
				</script>";
        } else {
            echo "
				<script>
				$(document).ready(function () {
						Swal.fire({
							title: 'Kesalahan!',
							text: 'Kesalahan Dalam Mengubah Data!',
							type: 'warning',
							showCancelButton: false,
							showConfirmButton: true,
						})
					});
				</script>";
        }
    }
}
?>