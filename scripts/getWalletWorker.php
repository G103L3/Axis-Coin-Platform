<?php
function get_wallet($conn, $target_id){
    if($target_id != null) {
        $id = $target_id;
        $id = hash_crypt($id);

        $cash_wallets_result = pg_query($conn, "SELECT id, balance FROM cash_wallets WHERE user_id=$id");
        $network_wallets_result = pg_query($conn, "SELECT id, balance FROM network_wallets WHERE user_id=$id");
        $packets_wallets_result = pg_query($conn, "SELECT SUM(value) AS s_value FROM revox_packets WHERE user_id=$id AND (status = 'active' OR status = 'committed')");

        //$all_wallets_result = pg_query($conn, "SELECT c.id as cash_id, c.balance as cash_balance, n.id as network_id, n.balance as network_balance, SUM(o.value) as packetss_value FROM cash_wallets as c LEFT JOIN network_wallets as n ON (c.user_id = n.user_id) LEFT JOIN packets as o ON (c.user_id = o.user_id)WHERE c.user_id =$id group by c.id, c.balance, n.id, n.balance");

        $arr = array();

        if(pg_num_rows($cash_wallets_result) > 0 && pg_num_rows($network_wallets_result) > 0 && pg_num_rows($packets_wallets_result) > 0){
            $cash_row = pg_fetch_array($cash_wallets_result);
            $network_row = pg_fetch_array($network_wallets_result);
            $packets_row = pg_fetch_array($packets_wallets_result);
            $arr = array(
                'cash_wallet' => $cash_row['balance'],
                'network_wallet' => $network_row['balance'],
                'packets_wallet' => $packets_row['s_value'],
            );
        }
        return $arr;
    }
}
?>