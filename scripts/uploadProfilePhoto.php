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
    $location = "../uploads/profiles/".$filename;

// Valid extension
    if ($_FILES['file']['size'] / 1048576 < 7) {
        $_SESSION[$filename] = $_FILES['file'];
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $id = $_SESSION['id'];
            $profile_photo_result = pg_query($conn, "UPDATE users set url_photo = '$location'");
            if($profile_photo_result){
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