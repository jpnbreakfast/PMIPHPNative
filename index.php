<?php include('fungsi.php'); ?>
<?php include('head.php'); ?>

<div class="jumbotron bg1 text-center">
<div id="typed-strings">
  <h1>Ayo Donor</h1>
</div>
<h1><span id="typed"></span></h1>
  <p id="jumbotron-desc">Setetes darah Anda, nyawa bagi sesama.</p> 
</div>

<div class="container-fluid cont2">
	<div class="row">
    	<div class="col-md-4">
        	<h1 class="counter"><?php echo dapatkantotal('pendonor'); ?></h1>
            <h2 class="deskriptitle">PENDONOR</h2>
             <p class="textdecrip">Pendonor yang sudah mendonorkan darahnya kepada kami.</p>
        </div>
        <div class="col-md-4">
         	<h1 class="counter"><?php echo dapatkantotal('unit_darah'); ?></h1>
            <h2 class="deskriptitle">UNIT DARAH</h2>
 			<p class="textdecrip">Unit Darah yang sudah kami tampung.</p>
        </div>
        <div class="col-md-4">
         	<h1 class="counter"><?php echo dapatkantotal('jadwaldanlokasi'); ?></h1>
            <h2 class="deskriptitle">JADWAL DONOR</h2>
            <p class="textdecrip">Kami Sudah Mengadakan Acara Donor Di Beberapa Wilayah.</p>
        </div>
    </div>
	</div>


  <div class="row starter-template">
    <div class="col-md-7">
      <h1 class="deskrippmi">Tentang PMI</h1>
        <p class="lead">Palang Merah Indonesia (PMI) adalah sebuah organisasi perhimpunan nasional di Indonesia yang bergerak dalam bidang sosial kemanusiaan.
PMI selalu mempunyai tujuh prinsip dasar Gerakan Internasional Palang Merah dan Bulan sabit merah yaitu kemanusiaan, kesamaan, kesukarelaan, kemandirian, kesatuan, kenetralan, dan kesemestaan. Sampai saat ini PMI telah berada di 33 PMI Daerah (tingkat provinsi) dan sekitar 408 PMI Cabang (tingkat kota/kabupaten) di seluruh Indonesia</p>
    </div>
    <div class="col-md-4">
     
    </div>
  </div>
	  <div class="container">
	        <div class="starter-template2">
        <h1 class="deskrippmi deskrippmi2">FAQ</h1>
        <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">Mengapa Harus Bayar Saat Kita Butuh Darah dari PMI ?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
                                            Biaya yang kita keluarkan perkantong darah sebenarnya adalah biaya penggantian pemeliharaan darah, supaya kondisinya tetap sama seperti saat berada dalam tubuh kita.&nbsp;Biaya ini yang kita kenal dgn nama <b>"BPPD"</b> atau Biaya Penggantian Pengelolaan Darah.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">Mengapa Kita Perlu Donor Darah ?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
                                            <b>Kebutuhan yang besar :</b> Setiap delapan detik, ada satu orang yang membutuhkan transfusi darah di Indonesia. <br><b>Pemeriksaan kesehatan gratis :</b> Sebelum mendonorkan darah, petugas akan memeriksa suhu tubuh, denyut nadi, tekanan darah dan kadar hemoglobin Anda. <br><b>Tidak menyakitkan :</b> Ya Anda memang akan merasa sakit. Namun, rasa sakit itu tidak seberapa dan akan hilang dengan cepat.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">Kenapa Ketika Membutuhkan Darah Prosesnya Lama ?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
                                            Proses permintaan darah transfusi di Palang Merah Indonesia (PMI) memerlukan proses <b>"Crossmatch"</b> yaitu uji serasi silang antara darah pasien dengan darah donor yang diberikan. Crossmatch ini bertujuan untuk melihat apakah darah pasien sesuai dengan darah donor sehingga tidak ada efek yang merugikan pasien transfusi darah tersebut.Secara keseluruhan darah pendonor baru siap diberikan kepada seseorang itu butuh waktu paling lama sekitar 3  jam
                                        </div>
                                    </div>
                                </div>
								<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="">Apa Yang Harus Kita Persiapkan Sebelum Donor ?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" style="">
                                        <div class="panel-body">
                                            Kita memerlukan tidur yang nyenyak di malam sebelum mendonor, sarapan pagi atau makan siang sebelum mendonor. Banyak minum seperti jus, susu sebelum mendonor. Rileks saat mendonor, dan banyak minum setelah mendonor. Kita bisa melanjutkan kegiatan setelah mendonor, asal hindari aktivitas fisik yang berat. 
                                        </div>
                                    </div>
                                </div>
                            </div>
      </div>

    </div><!-- /.container -->

<?php include('footer.php'); ?>