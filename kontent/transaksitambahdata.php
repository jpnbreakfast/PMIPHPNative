<?php 
include('../fungsi.php');
$q	= dapatkandatapilihanbanyaktransaksi($_POST["data"]);
$n	= mysqli_num_rows($q);
echo '<option goldar="" value="">Pilih Kantong Darah</option>';
		if ($n!=0)
			{	
				while ($r = mysqli_fetch_array($q)){
				$pil_nomor_kantong_darah = $r['nomor_kantong_darah'];
				$pil_golongan_darah = $r['golongan_darah'];
					if($pil_nomor_kantong_darah == $_POST["datakantong"]){
						echo '<option selected="selected" goldar="'.$pil_golongan_darah.'"  value="'.$pil_nomor_kantong_darah.'">['.$pil_nomor_kantong_darah.']&nbsp;Golongan Darah '.$pil_golongan_darah.'</option>';
					}else{
						echo '<option goldar="'.$pil_golongan_darah.'"  value="'.$pil_nomor_kantong_darah.'">['.$pil_nomor_kantong_darah.']&nbsp;Golongan Darah '.$pil_golongan_darah.'</option>';
					}
				}
			}else{
				echo '<option goldar="" value="">Data Kosong</option>';
			}
echo "</select>";
?>