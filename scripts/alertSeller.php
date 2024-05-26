<?php
function alert_seller($seller_id){
    $file = '../real_time/' . $seller_id . '_balance';
    file_put_contents($file, '');
    $file = '../real_time/' . $seller_id . '_personal_transactions';
    file_put_contents($file, '');
}
?>