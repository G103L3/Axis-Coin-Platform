<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['t_id']) && isset($_POST['method']) && isset($_POST['packets_quantity']) && isset($_POST['seller_id']) && isset($_POST['buyer_id']) && isset($_POST['revox_value']))
{
    $arr = array();

    $t_id = pg_escape_string($conn, $_POST['t_id']);
    $method = pg_escape_string($conn, $_POST['method']);
    $packets_quantity = pg_escape_string($conn, $_POST['packets_quantity']);
    $seller_id = pg_escape_string($conn, $_POST['seller_id']);
    $buyer_id = pg_escape_string($conn, $_POST['buyer_id']);

    $seller_id = 0;
    $max_quantity = 0;
    $revox_coins_quantity = 0;
    $last_balance_seller = 0;
    $last_balance_buyer = 0;
    if($_SESSION['status'] == 'verified'){
        //Prelievo informazioni dalla transazione
        $transactions_result = pg_query($conn, "SELECT * FROM transactions WHERE id=$t_id AND status = 'pending'");
        if(pg_num_rows($transactions_result) > 0) {
            $transactions_set = pg_query($conn, "UPDATE transactions SET status = 'loading' WHERE id=$t_id AND status = 'pending'");
            if(pg_affected_rows($transactions_set) > 0){
                $transactions_row = pg_fetch_array($transactions_result);
                $seller_id = $transactions_row['seller_id'];
                $max_quantity = $transactions_row['packets_quantity'];
                $revox_coins_quantity = $transactions_row['revox_coins_quantity'];
                //Verifica Cheat
                if($packets_quantity <= $max_quantity && strpos($packets_quantity, '.') == false && is_nan($packets_quantity) == false/*&& $_SESSION['id'] != $seller_id*/){
                    $packets_value = pg_query($conn, "SELECT * FROM revox_value WHERE id=793459934264688641 LIMIT 1");
                    if(pg_num_rows($packets_value) > 0) {
                        $packets_value_row = pg_fetch_array($packets_value);
                        $revox_value = $packets_value_row['value'];
                        $usd_amount = $packets_quantity * $revox_coins_quantity * $revox_value;
                        //Verifica presenza dei Packets
                        $packets_result = pg_query($conn, "SELECT * FROM revox_packets WHERE user_id=" . hash_crypt($seller_id) . " AND operation_id=$t_id AND status='committed' LIMIT $packets_quantity");
                        if(pg_num_rows($packets_result) > 0){
                            //Verifica disponibilità fondi buyer
                            $buyer_cash_wallets_result = pg_query($conn, "SELECT id, balance FROM $method WHERE user_id=" . hash_crypt($buyer_id) . "");
                            if(pg_num_rows($buyer_cash_wallets_result) > 0){
                                $buyer_cash_row = pg_fetch_array($buyer_cash_wallets_result);
                                $balance = $buyer_cash_row['balance'] - $usd_amount;
                                $last_balance_buyer = $buyer_cash_row['balance'] - $usd_amount;
                                //Verifica della non Bancarotta
                                if($balance >= 0.0){
                                    //Prelievo fondi dal conto del buyer
                                    $balance_result=pg_query($conn, "UPDATE $method SET balance=$balance WHERE user_id = " . hash_crypt($buyer_id) . " RETURNING balance");
                                    if(pg_num_rows($balance_result) > 0){
                                        //Ri-Verifica Bilancio Buyer
                                        $balance_row = pg_fetch_row($balance_result);
                                        $new_balance = $balance_row['0'];
                                        if($new_balance >= 0.0){
                                            //Verifica disponibilità fondi seller
                                            $seller_cash_wallets_result = pg_query($conn, "SELECT id, balance FROM cash_wallets WHERE user_id=" . hash_crypt($seller_id) . "");
                                            if(pg_num_rows($seller_cash_wallets_result) > 0){
                                                $seller_cash_row = pg_fetch_array($seller_cash_wallets_result);
                                                $last_balance_seller = $seller_cash_row['balance'];
                                                //Carico fondi sul conto del seller
                                                $seller_usd_amount = $usd_amount * 0.75;
                                                $taxes = $usd_amount * 0.25;
                                                $seller_balance_result=pg_query($conn, "UPDATE cash_wallets SET balance=balance+$seller_usd_amount WHERE user_id = " . hash_crypt($seller_id) . "");
                                                if(pg_affected_rows($seller_balance_result) > 0){
                                                    //Cambio proprietà Packets
                                                    $packets_change = pg_query($conn, "UPDATE revox_packets SET user_id=" . hash_crypt($buyer_id) . ", value = value*2, status='active' WHERE user_id=" . hash_crypt($seller_id) . " AND operation_id=$t_id AND status='committed' LIMIT $packets_quantity");
                                                    if(pg_affected_rows($packets_change) > 0){
                                                        //Gestione Transazione
                                                        if($packets_quantity == $max_quantity){
                                                            $transactions_change = pg_query($conn, "UPDATE transactions SET datetime = CURRENT_TIMESTAMP(3), buyer_id=$buyer_id, revox_value=$revox_value, status='completed' WHERE id=$t_id");
                                                            if(pg_affected_rows($transactions_change) > 0){
                                                                $arr[] = array(
                                                                    'status' => "true",
                                                                    'type' => "buy",
                                                                    'cash_value' => $usd_amount,
                                                                    'payment_method' => $method,
                                                                    'packets_quantity' => $packets_quantity,
                                                                    'revox_coins_quantity' => $revox_coins_quantity,
                                                                    'revox_value' => $revox_value,
                                                                );
                                                                include "alertSeller.php";
                                                                alert_seller($seller_id);
                                                                include "reloadTransactionsList.php";
                                                                reload_transactions_list($conn);
                                                                echo json_encode($arr);
                                                            }else{
                                                                if(transaction_loading_return($t_id, $conn)){
                                                                }
                                                                if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                                }
                                                                if(seller_balance_return($last_balance_seller, $seller_id, $conn)){
                                                                }
                                                                if(packets_return($t_id, $buyer_id, $seller_id, $packets_quantity, $conn)){
                                                                }
                                                                $arr[] = array(
                                                                    'status' => "false",
                                                                    'info' => "System error, please try again in a few minutes ERROR: #3",
                                                                );
                                                                echo json_encode($arr);
                                                            }
                                                        }else{
                                                            if($packets_quantity < $max_quantity){
                                                                $transactions_change = pg_query($conn, "UPDATE transactions SET datetime = CURRENT_TIMESTAMP(3), buyer_id=$buyer_id, packets_quantity=$packets_quantity, revox_value=$revox_value, status='completed' WHERE id=$t_id");
                                                                if(pg_affected_rows($transactions_change) > 0){
                                                                    $diff_quantity = $max_quantity-$packets_quantity;
                                                                    $transactions_register = pg_query($conn, "INSERT INTO transactions (packets_quantity, revox_coins_quantity, seller_id, buyer_id, status) VALUES($diff_quantity, $revox_coins_quantity, $seller_id, 0, 'pending') RETURNING id");
                                                                    if(pg_num_rows($transactions_register) > 0){
                                                                        $transactions_row = pg_fetch_row($transactions_register);
                                                                        $new_id = $transactions_row['0'];
                                                                        //Cambio identificativo transazione dei Packets
                                                                        $packets_change_2 = pg_query($conn, "UPDATE revox_packets SET operation_id=$new_id WHERE user_id=" . hash_crypt($seller_id) . " AND operation_id=$t_id AND value=$revox_coins_quantity AND status='committed' LIMIT $max_quantity-$packets_quantity");
                                                                        if(pg_affected_rows($packets_change_2) > 0){
                                                                            $arr[] = array(
                                                                                'status' => "true",
                                                                                'type' => "buy",
                                                                                'cash_value' => $usd_amount,
                                                                                'payment_method' => $method,
                                                                                'packets_quantity' => $packets_quantity,
                                                                                'revox_coins_quantity' => $revox_coins_quantity,
                                                                                'revox_value' => $revox_value,
                                                                            );
                                                                            include "alertSeller.php";
                                                                            alert_seller($seller_id);
                                                                            include "reloadTransactionsList.php";
                                                                            reload_transactions_list($conn);
                                                                            echo json_encode($arr);
                                                                        }else{
                                                                            if(transaction_loading_return($t_id, $conn)){
                                                                            }
                                                                            if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                                            }
                                                                            if(seller_balance_return($last_balance_seller, $seller_id, $conn)){
                                                                            }
                                                                            if(packets_return($t_id, $buyer_id, $seller_id, $packets_quantity, $conn)){
                                                                            }
                                                                            if(transaction_return($t_id, $max_quantity, $conn)){
                                                                            }
                                                                            if(transaction_delete($new_id, $conn)){
                                                                            }
                                                                            $arr[] = array(
                                                                                'status' => "false",
                                                                                'info' => "System error, please try again in a few minutes ERROR: #4",
                                                                            );
                                                                            echo json_encode($arr);
                                                                        }
                                                                    }else{
                                                                        if(transaction_loading_return($t_id, $conn)){
                                                                        }
                                                                        if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                                        }
                                                                        if(seller_balance_return($last_balance_seller, $seller_id, $conn)){
                                                                        }
                                                                        if(packets_return($t_id, $buyer_id, $seller_id, $packets_quantity, $conn)){
                                                                        }
                                                                        if(transaction_return($t_id, $max_quantity, $conn)){
                                                                        }
                                                                        $arr[] = array(
                                                                            'status' => "false",
                                                                            'info' => "System error, please try again in a few minutes ERROR: #5",
                                                                        );
                                                                        echo json_encode($arr);
                                                                    }
                                                                }else{
                                                                    if(transaction_loading_return($t_id, $conn)){
                                                                    }
                                                                    if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                                    }
                                                                    if(seller_balance_return($last_balance_seller, $seller_id, $conn)){
                                                                    }
                                                                    if(packets_return($t_id, $buyer_id, $seller_id, $packets_quantity, $conn)){
                                                                    }
                                                                    $arr[] = array(
                                                                        'status' => "false",
                                                                        'info' => "System error, please try again in a few minutes ERROR: #6",
                                                                    );
                                                                    echo json_encode($arr);
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        if(transaction_loading_return($t_id, $conn)){
                                                        }
                                                        if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                        }
                                                        if(seller_balance_return($last_balance_seller, $seller_id, $conn)){
                                                        }
                                                        $arr[] = array(
                                                            'status' => "false",
                                                            'info' => "System error, please try again in a few minutes ERROR: #7",
                                                        );
                                                        echo json_encode($arr);
                                                    }
                                                }else{
                                                    if(transaction_loading_return($t_id, $conn)){
                                                    }
                                                    if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                    }
                                                    $arr[] = array(
                                                        'status' => "false",
                                                        'info' => "System error, please try again in a few minutes ERROR: #8",
                                                    );
                                                    echo json_encode($arr);
                                                }
                                            }else{
                                                if(transaction_loading_return($t_id, $conn)){
                                                }
                                                if(buyer_balance_return($method, $last_balance_buyer, $buyer_id, $conn)){
                                                }
                                                $arr[] = array(
                                                    'status' => "false",
                                                    'info' => "System error, please try again in a few minutes ERROR: #9",
                                                );
                                                echo json_encode($arr);
                                            }
                                        }else{
                                            if(transaction_loading_return($t_id, $conn)){
                                            }
                                            $arr[] = array(
                                                'status' => "false",
                                                'info' => "Insufficient balance",
                                            );
                                            echo json_encode($arr);
                                        }
                                    }else{
                                        if(transaction_loading_return($t_id, $conn)){
                                        }
                                        $arr[] = array(
                                            'status' => "false",
                                            'info' => "Insufficient balance",
                                        );
                                        echo json_encode($arr);
                                    }
                                }else{
                                    if(transaction_loading_return($t_id, $conn)){
                                    }
                                    $arr[] = array(
                                        'status' => "false",
                                        'info' => "Insufficient balance",
                                    );
                                    echo json_encode($arr);
                                }
                            }else{
                                if(transaction_loading_return($t_id, $conn)){
                                }
                                $arr[] = array(
                                    'status' => "false",
                                    'info' => "System error, please try again in a few minutes ERROR: #10",
                                );
                                echo json_encode($arr);
                            }
                        }else{
                            if(transaction_loading_return($t_id, $conn)){
                            }
                            $arr[] = array(
                                'status' => "false",
                                'info' => "Offer no longer valid",
                            );
                            echo json_encode($arr);
                        }
                    }
                }else{
                    if(transaction_loading_return($t_id, $conn)){
                    }
                    $arr[] = array(
                        'status' => "false",
                        'info' => "Anti-cheat system encountered a fraud attempt",
                    );
                    echo json_encode($arr);
                }
            }else {
                $arr[] = array(
                    'status' => "false",
                    'info' => "Offer no longer valid",
                );
                echo json_encode($arr);
            }
        }else{
            $arr[] = array(
                'status' => "false",
                'info' => "Offer no longer valid",
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
}
else{
    $arr = array();
    $arr[] = array(
        'status' => "false",
        'info' => "System error, please try again in a few minutes ERROR: #11",
    );
    echo json_encode($arr);
}

function transaction_loading_return($t_id, $conn){
    $loading_return=pg_query($conn, "UPDATE transactions SET status = 'pending' WHERE id=$t_id");
    if(pg_affected_rows($loading_return) > 0){
        return true;
    }else{
        //Scriverlo su un file con id e bilancio da rispristinare
    }
}
function buyer_balance_return($method, $last_balance, $buyer_id, $conn){
    $balance_return=pg_query($conn, "UPDATE $method SET balance=$last_balance WHERE user_id = " . hash_crypt($buyer_id) . "");
    if(pg_affected_rows($balance_return) > 0){
        return true;
    }else{
        //Scriverlo su un file con id e bilancio da rispristinare
    }
}
function packets_return($t_id, $buyer_id, $seller_id, $packets_quantity, $conn){
    $packets_return = pg_query($conn, "UPDATE revox_packets SET user_id=" . hash_crypt($seller_id) . ", value= value/2, status='active' WHERE user_id=" . hash_crypt($buyer_id) . " AND operation_id=$t_id LIMIT $packets_quantity");
    if(pg_affected_rows($packets_return) > 0) {
        return true;
    }else{
        //Scriverlo su un file
    }
}
function seller_balance_return($last_balance, $seller_id, $conn){
    $balance_return=pg_query($conn, "UPDATE cash_wallets SET balance=$last_balance WHERE user_id = " . hash_crypt($seller_id) . "");
    if(pg_affected_rows($balance_return) > 0){
        return true;
    }else{
        //Scriverlo su un file con id e bilancio da rispristinare
    }
}
function transaction_return($t_id, $max_quantity, $conn){
    $transactions_return = pg_query($conn, "UPDATE FROM transactions WHERE id=$t_id SET buyer_id=0, packets_quantity=$max_quantity, status='pending'");
    if(pg_affected_rows($transactions_return) > 0){
        return true;
    }else{
        //Scriverlo su un file con id e bilancio da rispristinare
    }
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
