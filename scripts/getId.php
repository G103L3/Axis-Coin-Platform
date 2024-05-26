<?php
include "../client_conn_server_protocols/config_protocols/session_start.php";
if(isset($_SESSION['id'])){
    $arr = array();
    $arr = array(
        'id' => $_SESSION['id']
    );
    echo json_encode($arr);
}
?>