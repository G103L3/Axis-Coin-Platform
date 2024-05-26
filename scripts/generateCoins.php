<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

for($i = 0; $i <= 300; $i++){
    $generate_result = pg_query($conn, "INSERT INTO packets (user_id, operation_id, value, status) VALUES(SHA384(SHA256(MD5('790428745085222913'))), 0, 1.12, 'active')");
}

?>