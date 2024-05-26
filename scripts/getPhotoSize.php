<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_FILES['file']) && isset($_POST['filename'])) {
// Getting file name
    $filename = $_FILES['file']['name'];

// file type
    $filename = $_POST['filename'];

// Valid extension
        if ($_FILES['file']['size'] / 1048576 < 7) {
            $_SESSION[$filename] = $_FILES['file'];
            echo "true";
        } else {
            echo "false";
        }
}else{
    echo "false";
}

?>