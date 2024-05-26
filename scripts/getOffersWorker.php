<?php

function get_offers($conn){
    $trans_sell_result = pg_query($conn, "SELECT * FROM transactions WHERE status = 'pending' ORDER BY datetime DESC");
    $arr = array();
    if ($trans_sell_result) {
        while ($sell_row = pg_fetch_array($trans_sell_result)) {
            $arr[] = array(
                'id' => $sell_row['id'],
                'datetime' => $sell_row['datetime'],
                'packets_quantity' => $sell_row['packets_quantity'],
                'revox_coins_quantity' => $sell_row['revox_coins_quantity'],
                'seller_id' => $sell_row['seller_id'],
                'buyer_id' => $sell_row['buyer_id'],
                'status' => $sell_row['status'],
                'type' => 'buy',
            );
        }
    }
    return $arr;
}
?>