<?php
include 'getOffersWorker.php';
include 'getTransactionsChartWorker.php';


function reload_transactions_list($conn){
    $file = '../real_time/offers';
    $offers_text =  json_encode(get_offers($conn));
    file_put_contents($file, $offers_text);
    $file = '../real_time/transactions_chart';
    $transactions_chart_text = json_encode(get_transactions_chart($conn));
    file_put_contents($file, $transactions_chart_text);
}
?>