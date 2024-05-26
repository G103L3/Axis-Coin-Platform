<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['t_id']) && isset($_POST['quantity']))
{
    $t_id = pg_escape_string($conn, $_POST['t_id']);
    $quantity = pg_escape_string($conn, $_POST['quantity']);

    if($t_id == ""){
        $t_id = 0;
    }
    $trans_id_result = pg_query($conn, "SELECT * FROM transactions WHERE id = $t_id AND status = 'pending'");
    $arr = array();
    if($trans_id_result){
        while($id_row=pg_fetch_array($trans_id_result))
        {
            $arr[] = array(
                'id' => $id_row['id'],
                'datetime' => $id_row['datetime'],
                'quantity' => $id_row['packets_quantity'],
                'seller_id' => $id_row['seller_id'],
                'buyer_id' => $id_row['buyer_id'],
                'status' => $id_row['status'],
                'type' => 'id',
            );
        }


    }
    if($arr[0]['quantity'] >= $quantity){
        echo "true";
    }else{
        echo "false";
    }
}
else{
    echo "false";
}

?>