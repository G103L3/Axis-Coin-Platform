<?php

function get_transactions_chart($conn){
    $t_buy_query = "SELECT id, datetime, packets_quantity, revox_coins_quantity FROM transactions WHERE status = 'completed' /*AND datetime >= (CURRENT_TIMESTAMP(3) - INTERVAL '10 hours')*/ ORDER BY datetime DESC LIMIT 20";
    $t_sell_query = "SELECT id, datetime, packets_quantity, revox_coins_quantity FROM transactions WHERE (status = 'pending' OR status = 'completed') /*AND datetime >= (CURRENT_TIMESTAMP(3) - INTERVAL '10 hours')*/ ORDER BY datetime DESC LIMIT 20";
    $all_time_sell_high_query = "SELECT MAX(revox_coins_quantity) as max_amount FROM transactions WHERE (status = 'pending' OR status = 'completed')";
    $circulating_query = "SELECT packets_quantity, revox_coins_quantity FROM transactions WHERE status = 'pending'";
    $mode_query = "SELECT revox_coins_quantity, count(*) FROM transactions WHERE status = 'completed' GROUP BY revox_coins_quantity LIMIT 1";

    $trans_buy_result = pg_query($conn, $t_buy_query);
    $trans_sell_result = pg_query($conn, $t_sell_query);
    $all_time_sell_high_result = pg_query($conn, $all_time_sell_high_query);
    $circulating_result = pg_query($conn, $circulating_query);
    $mode_result = pg_query($conn, $mode_query);

    $arr = array();
    $arr[] = array();
    if ($trans_buy_result) {
        while ($trans_buy_row = pg_fetch_array($trans_buy_result)) {
            $arr[0][] = array(
                'id' => $trans_buy_row['id'],
                'datetime' => $trans_buy_row['datetime'],
                'packets_quantity' => $trans_buy_row['packets_quantity'],
                'revox_coins_quantity' => $trans_buy_row['revox_coins_quantity'],
            );
        }
    }
    $t_f_query = "SELECT id, datetime, packets_quantity, revox_coins_quantity FROM transactions WHERE (status = 'pending' OR status = 'completed') /*AND datetime >= (CURRENT_TIMESTAMP(3) - INTERVAL '10 hours')*/ ORDER BY datetime DESC LIMIT 1";
    $arr[0] = cmp_f_data($t_f_query, $arr[0], $conn);
    $arr[] = array();
    if ($trans_sell_result) {
        while ($trans_sell_row = pg_fetch_array($trans_sell_result)) {
            $arr[1][] = array(
                'id' => $trans_sell_row['id'],
                'datetime' => $trans_sell_row['datetime'],
                'packets_quantity' => $trans_sell_row['packets_quantity'],
                'revox_coins_quantity' => $trans_sell_row['revox_coins_quantity'],
            );
        }
    }
    $arr[] = array();
    if ($all_time_sell_high_result) {
        while ($all_time_sell_high_row = pg_fetch_array($all_time_sell_high_result)) {
            $arr[2][] = array(
                'max_amount' => $all_time_sell_high_row['max_amount'],
            );
        }
    }
    $arr[] = array();
    $circulating =0;
    if ($circulating_result) {
        while ($circulating_row = pg_fetch_array($circulating_result)) {
            $circulating += $circulating_row['revox_coins_quantity'] * $circulating_row['packets_quantity'];
        }
        $arr[3][] = array(
            'circulating' => $circulating,
        );
    }
    $arr[] = array();
    if ($mode_result) {
        while ($mode_row = pg_fetch_array($mode_result)) {
            $arr[4][] = array(
                'mode' => $mode_row['revox_coins_quantity'],
            );
        }
    }
    return $arr;
}
function cmp_f_data($t_f_query, $arr, $conn){
    $trans_f_result = pg_query($conn, $t_f_query);
    if ($trans_f_result) {
        while ($trans_f_row = pg_fetch_array($trans_f_result)) {
            if(count($arr) > 0){
                if($arr[0]['datetime'] < $trans_f_row['datetime']){
                    $tmp = array();
                    $tmp[] = array(
                        'id' => $trans_f_row['id'],
                        'datetime' => $trans_f_row['datetime'],
                        'revox_coins_quantity' => $arr[0]['revox_coins_quantity'],
                        'packets_quantity' => $arr[0]['packets_quantity'],
                    );
                    $arr = array_merge($tmp, $arr);
                }
            }
        }
    }
    return $arr;
}

?>