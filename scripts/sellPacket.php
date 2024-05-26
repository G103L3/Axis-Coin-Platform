<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['packets_quantity']) && isset($_POST['revox_coins_quantity']))
{
    $arr = array();

    $packets_quantity = pg_escape_string($conn, $_POST['packets_quantity']);
    $revox_coins_quantity = pg_escape_string($conn, $_POST['revox_coins_quantity']);

    $seller_id = $_SESSION['id'];
    $buyer_id = 0;
    $max_quantity = 0;

    if($_SESSION['status'] == 'verified'){
        //Verifica presenza dei Packets
        $packets_result = pg_query($conn, "SELECT COUNT(*) AS max_quantity FROM revox_packets WHERE value=$revox_coins_quantity AND user_id=" . hash_crypt($seller_id) . " AND status = 'active'");
        if(pg_num_rows($packets_result) > 0) {
            $packets_row = pg_fetch_array($packets_result);
            $max_quantity = $packets_row['max_quantity'];
            //Verifica Cheat
            if($packets_quantity <= $max_quantity && strpos($packets_quantity, '.') == false && is_nan($packets_quantity) == false){
                $packets_value = pg_query($conn, "SELECT * FROM revox_value WHERE id=793459934264688641 LIMIT 1");
                if(pg_num_rows($packets_value) > 0) {
                    $packets_value_row = pg_fetch_array($packets_value);
                    $revox_value = $packets_value_row['value'];
                    $usd_amount = $packets_quantity * $revox_coins_quantity * $revox_value;
                    //Registrazione transazione
                    $transactions_register = pg_query($conn, "INSERT INTO transactions (packets_quantity, revox_coins_quantity, revox_value, seller_id, buyer_id, status) VALUES($packets_quantity, $revox_coins_quantity, null, $seller_id, 0, 'pending') RETURNING id");
                    if(pg_num_rows($transactions_register) > 0){
                        $transactions_row = pg_fetch_row($transactions_register);
                        $op_id = $transactions_row['0'];
                        //Modifica status packets
                        $packets_set = pg_query($conn, "UPDATE revox_packets SET status = 'committed', operation_id = $op_id WHERE value = $revox_coins_quantity AND user_id=" . hash_crypt($seller_id) . " AND status = 'active' LIMIT $packets_quantity");
                        if(pg_affected_rows($packets_set) > 0){
                            $arr[] = array(
                                'status' => "true",
                                'type' => "sell",
                                'cash_value' => $usd_amount,
                                'packets_quantity' => $packets_quantity,
                                'revox_coins_quantity' => $revox_coins_quantity,
                                'revox_value' => $revox_value,
                            );
                            include "reloadTransactionsList.php";
                            reload_transactions_list($conn);
                            echo json_encode($arr);
                        }else {
                            if(transaction_delete($op_id, $conn)){
                            }
                            $arr[] = array(
                                'status' => "false",
                                'info' => "System error, please try again in a few minutes ERROR: #SE3",
                            );
                            echo json_encode($arr);
                        }
                    }else {
                        $arr[] = array(
                            'status' => "false",
                            'info' => "System error, please try again in a few minutes ERROR: #SE4",
                        );
                        echo json_encode($arr);
                    }
                }
            }else{
                $arr[] = array(
                    'status' => "false",
                    'info' => "Anti-cheat system encountered a fraud attempt",
                );
                echo json_encode($arr);
            }
        }else{
            $arr[] = array(
                'status' => "false",
                'info' => "You don't have enough packets",
            );
            echo json_encode($arr);
        }
    }else{
        $arr[] = array(
            'status' => "false",
            'info' => "Unverified account - provide proof for verification",
        );
        echo json_encode($arr);
    }
} else{
    $arr = array();
    $arr[] = array(
        'status' => "false",
        'info' => "System error, please try again in a few minutes ERROR: #SE5",
    );
    echo json_encode($arr);
}


function transaction_delete($t_id, $conn){
    $transactions_delete = pg_query($conn, "DELETE FROM transactions WHERE id = $t_id");
    if(pg_affected_rows($transactions_delete) > 0){
        return true;
    }else{
        //Scriverlo su un file con id e bilancio da rispristinare
    }
}
?>
