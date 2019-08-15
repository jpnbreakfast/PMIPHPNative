<?php include('fungsi.php'); ?>
<?php include('head.php'); ?>
<div class="banner">
<h1 class="deskrippmi" style="width: 262px;">Stok Darah</h1>
</div>

<div class="container table-stok">
			<h1 class="judul">Informasi Unit Darah Kota Denpasar</h1>
			<p class="des">Berikut adalah Tabel Unit Darah yang tersedia pada PMI Denpasar</p>
              <table class="table table-bordered table-striped table2">
                <tr>
                  <th style="width: 25%">Golongan Darah</th>
                  <th>Rhesus +</th>
                  <th>Rhesus -</th>
                  <th>Total</th>
                </tr>
				<?php
				$goldar  = array('A','B','O','AB');
				foreach($goldar as $pecah){
				?>
					<tr>
					  <td><b><?php echo $pecah; ?></b></td>
					  <td><?php echo dapatkantotaldarah($pecah,'+'); ?></td>
					  <td><?php echo dapatkantotaldarah($pecah,'-'); ?></td>
					  <td><?php echo dapatkantotaldarah($pecah,''); ?></td>
					</tr>
				<?php
				}
				?>
              </table>
		  </div>
<?php include('footer.php'); ?>