<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['s_data']))
{
    $date = pg_escape_string($conn, $_POST['s_data']);

    $today = date("d-m-Y");
    $limit = strtotime($today) - 31548400*14;


    $date_time = strtotime($date);



    if ($date_time < $limit) {
        echo "true";
    }else{
        echo "false";
    }
}
else{
    echo "false";
}

?>