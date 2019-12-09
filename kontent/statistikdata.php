
<section class="content-header">
  <h1>
    Statistik Data
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Statistik Data</li>
  </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
  <div class="jumbotron">
    <div class="container">
      <h1>Statistik Data</h1>
      <p>Berikut Merupakan Jumlah Statistik Data Yang Dihasilkan.</p>
    </div>
  </div>
  <div class="row">

    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Jumlah Unit Darah</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body padding">
          <div class="chart">
            <canvas id="areaChartDarah"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Jumlah Kantong Darah</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body padding">
          <div class="chart">
            <canvas id="areaChartDarahTotal"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Jumlah Pendonor</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body padding">
          <div class="chart">
            <canvas id="areaChartPendonor"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>

<script>
    function chartDarahRhesus() {
        $.ajax({
                url: '../kontent/ajax/chartSemua.php?jenis=darah',
                success: function (result) {
                    var datachart = JSON.parse(result);
                    var labelchart = [];
                    var valuechartrhesusplus = [];
                    var valuechartrhesusminus = [];
                    for (var i in datachart) {

                        labelchart.push(datachart[i].label);
                        valuechartrhesusplus.push(datachart[i].darahrhesusuplus);
                        valuechartrhesusminus.push(datachart[i].darahresusminus);

                    }
                    var ctx = document.getElementById("areaChartDarah");
                    if (ctx) {
                        ctx.height = 250;
                        var ChartCountry = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                datasets: [{
                                    label: "Rhesus +",
                                    data: valuechartrhesusplus,
                                    backgroundColor: [
                                        "rgba(0, 123, 255,0.9)",
                                        "rgba(0, 123, 255,0.7)",
                                        "rgba(0, 123, 255,0.5)",
                                        "rgba(0,0,0,0.07)"
                                    ],
                                    hoverBackgroundColor: [
                                        "rgba(0, 123, 255,0.9)",
                                        "rgba(0, 123, 255,0.7)",
                                        "rgba(0, 123, 255,0.5)",
                                        "rgba(0,0,0,0.07)"
                                    ]

                                },
                                {
                                      label: "Rhesus -",
                                      data: valuechartrhesusminus,
                                      backgroundColor: [
                                          "rgba(0, 123, 255,0.9)",
                                          "rgba(0, 123, 255,0.7)",
                                          "rgba(0, 123, 255,0.5)",
                                          "rgba(0,0,0,0.07)"
                                      ],
                                      hoverBackgroundColor: [
                                          "rgba(0, 123, 255,0.9)",
                                          "rgba(0, 123, 255,0.7)",
                                          "rgba(0, 123, 255,0.5)",
                                          "rgba(0,0,0,0.07)"
                                      ]

                                  }],
                                labels: labelchart
                            },
                            options: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        fontFamily: 'Poppins'
                                    }

                                },
                                responsive: true
                            }
                        });
                    }
                }
                });
        }
    
        function chartDarahTotal() {
        $.ajax({
                url: '../kontent/ajax/chartSemua.php?jenis=darahtotal',
                success: function (result) {
                    var datachart = JSON.parse(result);
                    var labelchart = [];
                    var valuechart = [];
                    for (var i in datachart) {

                        labelchart.push(datachart[i].label);
                        valuechart.push(datachart[i].total);

                    }
                    var ctx = document.getElementById("areaChartDarahTotal");
                    if (ctx) {
                        ctx.height = 250;
                        var ChartCountry = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: valuechart,
                                    backgroundColor: [
                                        "rgba(0, 123, 255,0.9)",
                                        "rgba(0, 123, 255,0.7)",
                                        "rgba(0, 123, 255,0.5)",
                                        "rgba(0,0,0,0.07)"
                                    ],
                                    hoverBackgroundColor: [
                                        "rgba(0, 123, 255,0.9)",
                                        "rgba(0, 123, 255,0.7)",
                                        "rgba(0, 123, 255,0.5)",
                                        "rgba(0,0,0,0.07)"
                                    ]

                                }],
                                labels: labelchart
                            },
                            options: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        fontFamily: 'Poppins'
                                    }

                                },
                                responsive: true
                            }
                        });
                    }
                }
                });
        }

        function chartJumlahPendonor() {
            $.ajax({
                url: '../kontent/ajax/chartSemua.php?jenis=pendonor',
                success: function (result) {
                    var datachart = JSON.parse(result);
                    var labelchart = [];
                    var valuechart = [];
                    for (var i in datachart) {

                        labelchart.push(datachart[i].label);
                        valuechart.push(datachart[i].data);

                    }
                var ctx = document.getElementById("areaChartPendonor");
                    var ctx = document.getElementById("areaChartPendonor");
                    if (ctx) {
                        ctx.height = 250;
                        var ChartRevenue = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labelchart,
                                datasets: [{
                                    label: "Revenue",
                                    data: valuechart,
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                                }]
                            },
                            options: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        fontFamily: 'Poppins'
                                    }

                                },
                                scales: {
                                    xAxes: [{
                                        ticks: {
                                            fontFamily: "Poppins"

                                        }
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            fontFamily: "Poppins"
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            });
        }
        $(document).on("ready", (function (e) {
          e.preventDefault();
          $.when(chartDarahTotal(), chartJumlahPendonor(), chartDarahRhesus()).done(function () {

          });
        }));
</script>
