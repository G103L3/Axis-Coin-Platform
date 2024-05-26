<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_FILES['file']) && isset($_POST['filetype'])) {
// Getting file name
    $filename = time();

// file type
    $filetype = $_POST['filetype'];

    $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    $filename = $filename . "." . $file_extension;
    $location = "../uploads/documents/".$filename;

// Valid extension
    if ($_FILES['file']['size'] / 1048576 < 7) {
        $_SESSION[$filename] = $_FILES['file'];
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $id = $_SESSION['id'];
            $id_card_result = pg_query($conn, "INSERT INTO id_cards (id_users, url, type) VALUES ($id, '$location', '$filetype')");
            if($id_card_result){
                echo "true";
            }else{
                echo "false";
            }
        }
    } else {
        echo "false";
    }
}else{
    echo "false";
}

?>
