<?php
include "..\client_conn_server_protocols\config_protocols\start.php";
include 'getOffersWorker.php';

if(isset($_SESSION['id'])) {
    $arr = array();
    $arr = get_offers($conn);
    echo json_encode($arr);
}else{
    $arr = array();
    echo json_encode($arr);
}

?>