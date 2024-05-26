<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $packets_result = pg_query($conn, "SELECT value, COUNT(*) AS packets_quantity FROM revox_packets WHERE user_id = " . hash_crypt($id) . " AND status = 'active' GROUP BY value");
    $arr = array();
    if($packets_result){
        while($packets_row=pg_fetch_array($packets_result))
        {
            $arr[] = array(
                'packets_quantity' => $packets_row['packets_quantity'],
                'revox_coins_quantity' => $packets_row['value'],
            );
        }
    }
    echo json_encode($arr);
}else{
    $arr = array();
    echo json_encode($arr);
}
?>