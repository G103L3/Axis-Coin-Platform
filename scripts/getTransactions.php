<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_SESSION['id']) && isset($_POST['mode'])) {
    if($_POST['mode'] == 'personal_history'){
        $id = $_SESSION['id'];
        $trans_sell_result = pg_query($conn, "SELECT * FROM transactions WHERE seller_id = $id AND buyer_id != $id ORDER BY datetime DESC");
        $arr = array();
        if ($trans_sell_result) {
            $trans_buy_result = pg_query($conn, "SELECT * FROM transactions WHERE buyer_id = $id AND seller_id != $id ORDER BY datetime DESC");
            if ($trans_buy_result) {
                $trans_rebuy_result = pg_query($conn, "SELECT * FROM transactions WHERE buyer_id = $id AND seller_id = $id ORDER BY datetime DESC");
                if ($trans_rebuy_result) {
                    while ($sell_row = pg_fetch_array($trans_sell_result)) {
                        $arr[] = array(
                            'id' => $sell_row['id'],
                            'datetime' => $sell_row['datetime'],
                            'packets_quantity' => $sell_row['packets_quantity'],
                            'revox_coins_quantity' => $sell_row['revox_coins_quantity'],
                            'revox_value' => $sell_row['revox_value'],
                            'seller_id' => $sell_row['seller_id'],
                            'buyer_id' => $sell_row['buyer_id'],
                            'status' => $sell_row['status'],
                            'type' => 'sell',
                        );
                    }
                    while ($buy_row = pg_fetch_array($trans_buy_result)) {
                        $arr[] = array(
                            'id' => $buy_row['id'],
                            'datetime' => $buy_row['datetime'],
                            'packets_quantity' => $buy_row['packets_quantity'],
                            'revox_coins_quantity' => $buy_row['revox_coins_quantity'],
                            'revox_value' => $buy_row['revox_value'],
                            'seller_id' => $buy_row['seller_id'],
                            'buyer_id' => $buy_row['buyer_id'],
                            'status' => $buy_row['status'],
                            'type' => 'buy',
                        );
                    }
                    while ($rebuy_row = pg_fetch_array($trans_rebuy_result)) {
                        $arr[] = array(
                            'id' => $rebuy_row['id'],
                            'datetime' => $rebuy_row['datetime'],
                            'packets_quantity' => $rebuy_row['packets_quantity'],
                            'revox_coins_quantity' => $rebuy_row['revox_coins_quantity'],
                            'revox_value' => $rebuy_row['revox_value'],
                            'seller_id' => $rebuy_row['seller_id'],
                            'buyer_id' => $rebuy_row['buyer_id'],
                            'status' => $rebuy_row['status'],
                            'type' => 'rebuy',
                        );
                    }
                    // Comparison function
                    function date_compare($element1, $element2)
                    {
                        $datetime1 = strtotime($element1['datetime']);
                        $datetime2 = strtotime($element2['datetime']);
                        return $datetime2 - $datetime1;
                    }

                    // Sort the array
                    usort($arr, 'date_compare');
                }
            }
        }
        echo json_encode($arr);
    }else{
        if($_POST['mode'] == 'id_pending_search' && isset($_POST['t_id'])){
            $id = $_SESSION['id'];
            $t_id = pg_escape_string($_POST['t_id']);
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
                        'packets_quantity' => $id_row['packets_quantity'],
                        'revox_coins_quantity' => $id_row['revox_coins_quantity'],
                        'seller_id' => $id_row['seller_id'],
                        'buyer_id' => $id_row['buyer_id'],
                        'status' => $id_row['status'],
                        'type' => 'id',
                    );
                }


            }
            echo json_encode($arr);
        }else{
            $arr = array();
            echo json_encode($arr);
        }
    }

}else{
    $arr = array();
    echo json_encode($arr);
}
?>