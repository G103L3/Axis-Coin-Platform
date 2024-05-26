<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['s_type']) && isset($_POST['s_data']))
{
    $type = pg_escape_string($conn, $_POST['s_type']);
    $data = pg_escape_string($conn, $_POST['s_data']);

    if($type == "email"){
        //Verifica elem
        $elem_query= "SELECT id FROM users WHERE " . $type . "='$data'";
        $elem_result=pg_query($conn, $elem_query);
        if (pg_num_rows($elem_result)>0)
        {
            echo "true";
        }else{
            echo "false";
        }
    }else{
        if($type == "password" && $_POST['s_data2'] != ""){
            $data2 = pg_escape_string($conn, $_POST['s_data2']);

            //Verifica elem
            $elem_query= "SELECT id FROM users WHERE email = '$data2' AND " . $type . "= " . hash_crypt($data) . "";

            $elem_result=pg_query($conn, $elem_query);
            if (pg_num_rows($elem_result)>0)
            {
                echo "true";
            }else{
                echo "false";
            }
        }else{
            echo "true";
        }
    }

}
else{
    echo "false";
}

?>