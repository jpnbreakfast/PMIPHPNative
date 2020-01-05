<?php
include("../../fungsi.php");
$jenis = htmlspecialchars($_GET['jenis'], ENT_QUOTES, 'UTF-8');

if($jenis == "darah"){
    $optionsdarah  = array('A','B','O','AB');
    $datachart = array();
    foreach($optionsdarah as $option){
        $datachart[] = array('label' => $option,'darahrhesusuplus' => dapatkantotaldarah($option,'+'),'darahresusminus' => dapatkantotaldarah($option,'-'));
    }
    echo json_encode($datachart);
}elseif($jenis == "pendonor"){
    $datachart = array();
    foreach (range(1, 12) as $bulan) {   
        $datachart[] = array('label' => date("F", mktime(0, 0, 0, $bulan, 10)),'data' => transaksi_chart($bulan));
    }
    echo json_encode($datachart);
}elseif ($jenis == "darahtotal") {
    $optionsdarah = array('A', 'B', 'O', 'AB');
    $datachart = array();
    foreach ($optionsdarah as $option) {
        $datachart[] = array('label' => $option, 'total' => dapatkantotaldarah($option, ''));
    }
    echo json_encode($datachart);
}elseif ($jenis == "daerah") {
    $optionsdaerah = array('Denpasar Barat', 'Denpasar Timur', 'Denpasar Selatan', 'Denpasar Utara');
    $datachart = array();
    foreach ($optionsdaerah as $option) {
        $datachart[] = array('label' => $option, 'total' => dapatkantotaldaerah($option));
    }
    echo json_encode($datachart);
}


?>