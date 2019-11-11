<?php include('header.php'); ?>
 <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Stok Darah</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="contact-page-wrap" style="
    padding-top: 50px;
">
        <div class="container">
        <div class="row">
                <div class="col-12">
                    
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                <div class="col-12">
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
                </div><!-- .col -->
                </div>
           
        </div><!-- .container -->
    </div>
<?php include('footer.html'); ?>