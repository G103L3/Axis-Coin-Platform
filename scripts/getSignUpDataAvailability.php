<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['s_type']) && isset($_POST['s_data']))
{
    $type = pg_escape_string($conn, $_POST['s_type']);
    $data = pg_escape_string($conn, $_POST['s_data']);

    //Verifica elem
    $elem_query= "SELECT id FROM users WHERE " . $type . "='$data'";
    $elem_result=pg_query($conn, $elem_query);
    if (pg_num_rows($elem_result)==0)
    {
        echo "true";
    }else{
        echo "false";
    }
}
else{
    echo "false";
}

?>
