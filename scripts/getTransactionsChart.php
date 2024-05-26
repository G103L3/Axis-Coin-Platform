<?php
include "..\client_conn_server_protocols\config_protocols\start.php";
include "getTransactionsChartWorker.php";


if(isset($_SESSION['id'])) {
    $arr = array();
    $arr = get_transactions_chart($conn);
    echo json_encode($arr);
}else{
    $arr = array();
    echo json_encode($arr);
}


?>