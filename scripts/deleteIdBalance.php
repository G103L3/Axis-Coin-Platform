<?php
include "../client_conn_server_protocols/config_protocols/session_start.php";
if(isset($_SESSION['id'])){
    /*$id = $_SESSION['id'];
    $file = '../real_time/balance.txt';
    $file_content = file_get_contents($file);
    $regex = "/" . $id . "\n/";
    $new_file_content = preg_replace($regex, '', $file_content);
    file_put_contents($file, $new_file_content);
    VECCHIO METODO CHE SI BASAVA SULLA MODIFICA DI UN FILE balance.txt con su scritti tutti i bilanci di tutti gli utenti*/
    $file = '../real_time/' . $_SESSION['id'] . '_balance';
    unlink($file);
}

?>