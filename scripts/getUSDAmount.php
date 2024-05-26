<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['t_id']) && isset($_POST['amount']) && isset($_POST['quantity']) && isset($_POST['revox_value']))
{
    $t_id = pg_escape_string($conn, $_POST['t_id']);
    $amount = pg_escape_string($conn, $_POST['amount']);
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
                's_amount' => $id_row['s_amount'],
                'quantity' => $id_row['quantity'],
                'seller_id' => $id_row['seller_id'],
                'buyer_id' => $id_row['buyer_id'],
                'status' => $id_row['status'],
                'type' => 'id',
            );
        }


    }
    if(($arr[0]['s_amount'] * $quantity) == $amount){
        echo "true";
    }else{
        echo "false";
    }
}
else{
    echo "false";
}

?>