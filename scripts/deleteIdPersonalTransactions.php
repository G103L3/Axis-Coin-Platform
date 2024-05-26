<?php
include "../client_conn_server_protocols/config_protocols/session_start.php";
if(isset($_SESSION['id'])){

    $file = '../real_time/' . $_SESSION['id'] . '_personal_transactions';
    unlink($file);
}

?>