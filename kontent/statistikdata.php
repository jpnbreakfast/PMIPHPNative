
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
            <canvas id="areaChartDarah" style="height:250px"></canvas>
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
            <canvas id="areaChartPendonor" style="height:250px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>

<script>
  $(function () {
    var areaChartDCanvas = $('#areaChartDarah').get(0).getContext('2d')
    var areaChartD       = new Chart(areaChartDCanvas)
    var areaChartDarah = {
      labels  : ['A', 'B', 'O', 'AB'],
      datasets: [
        {
          label               : 'Darah',
          fillColor           : 'rgba(221, 75, 57, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo dapatkantotaldarah('A','');?>, <?php echo dapatkantotaldarah('B','');?>, <?php echo dapatkantotaldarah('O','');?>, <?php echo dapatkantotaldarah('AB','');?>]
        }
      ]
    }
	
	var areaChartPCanvas = $('#areaChartPendonor').get(0).getContext('2d')
    var areaChartP       = new Chart(areaChartPCanvas)
    var areaChartPendonor = {
      labels  : [
      <?php
        $date = null;
        foreach (range(1, 12) as $number) {   
            $date .= "'".date("F", mktime(0, 0, 0, $number, 10))."'".','; 
               
        }
        echo rtrim($date, ",");   
      ?>
      ],
      datasets: [
        {
          label               : 'Pendonor',
          fillColor           : 'rgba(221, 75, 57, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php
                                    $data = null;
                                    foreach (range(1, 12) as $number) {   
                                        $data .= transaksi_chart($number).','; 
                                    }
                                    echo rtrim($data, ",");   
                                  ?>]
        }
      ]
    }
    var areaChartOptions = {
      showScale               : true,
      scaleShowGridLines      : false,
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      scaleGridLineWidth      : 1,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines  : true,
      bezierCurve             : true,
      bezierCurveTension      : 0.3,
      pointDot                : false,
      pointDotRadius          : 4,
      pointDotStrokeWidth     : 1,
      pointHitDetectionRadius : 20,
      datasetStroke           : true,
      datasetStrokeWidth      : 2,
      datasetFill             : true,
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      maintainAspectRatio     : true,
      responsive              : true,
	  
    }
    areaChartD.Line(areaChartDarah, areaChartOptions)
	areaChartP.Line(areaChartPendonor, areaChartOptions)
  })
</script>
