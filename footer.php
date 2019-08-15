<section class="footer-section navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                     <div class="footer-center">&copy; 2018 | localhost/pmiadminphp
				   <br><b><a href="index.php">Palang Merah Indonesia Denpasar</a></b> | Jl. Imam Bonjol No.182, Pemecutan Klod, Denpasar Barat, Kota Denpasar - Bali 80113
					<br>Tel. (0361) 483465</div>
                </div>
				<div class="col-md-3 col-xs-12 col-footer">
                    <div class="navbar-brand footer-center" href="#">PMI DENPASAR
					<img style="max-width:30px; margin-top: -25px; margin-left: -35px;" src="img/logo.png"></div>
                </div>

            </div>
        </div>
    </section>
	<script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
		<script src="dist/js/typed.js"></script>
	<script>
	document.getElement
    $(function(){
        $("#typed").typed({
            // strings: ["Typed.js is a <strong>jQuery</strong> plugin.", "It <em>types</em> out sentences.", "And then deletes them.", "Try it out!"],
            stringsElement: $('#typed-strings'),
            typeSpeed: 60,
            backDelay: 5000,
            loop: true,
            contentType: 'html', // or text
            // defaults to false for infinite loop
            loopCount: false,
            callback: function(){ foo(); },
            resetCallback: function() { newTyped(); }
        });
        $(".reset").click(function(){
            $("#typed").typed('reset');
        });
    });
    function newTyped(){ /* A new typed object */ }
    function foo(){ console.log("Callback"); }
    </script>
  </body>
</html>