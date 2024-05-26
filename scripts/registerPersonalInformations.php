<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['dob']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['postal']) && isset($_POST['country']) && isset($_POST['id_card']))
{
    $dob = pg_escape_string($conn, $_POST['dob']);

    if(check_date($dob) && $_SESSION['status'] == 'not_verified'){
        $_SESSION['name'] = pg_escape_string($conn, $_POST['name']);
        $_SESSION['surname'] = pg_escape_string($conn, $_POST['surname']);
        $_SESSION['dob'] = pg_escape_string($conn, $_POST['dob']);
        $_SESSION['address'] = pg_escape_string($conn, $_POST['address']);
        $_SESSION['city'] = pg_escape_string($conn, $_POST['city']);
        $_SESSION['postal'] = pg_escape_string($conn, $_POST['postal']);
        $_SESSION['country'] = pg_escape_string($conn, $_POST['country']);
        $_SESSION['id_card'] = strtoupper(pg_escape_string($conn, $_POST['id_card']));
        echo "true";
    }else{
        echo "false";
    }
}
else{
    if(isset($_SESSION['name']) && isset($_SESSION['surname']) && isset($_SESSION['dob']) && isset($_SESSION['address']) && isset($_SESSION['city']) && isset($_SESSION['postal']) && isset($_SESSION['country']) && isset($_SESSION['id_card']))
    {
        $name = $_SESSION['name'];
        $surname = $_SESSION['surname'];
        $dob = $_SESSION['dob'];
        $address = $_SESSION['address'];
        $city = $_SESSION['city'];
        $postal = $_SESSION['postal'];
        $country = $_SESSION['country'];
        $id_card = $_SESSION['id_card'];
        $id = $_SESSION['id'];

        $update_query = pg_query($conn, "UPDATE users SET name = '$name', surname = '$surname', birth_date = '$dob', address = '$address', city = '$city', postal_code = '$postal', country = '$country', id_card_number = '$id_card', status = 'pending' WHERE id = $id");
        if($update_query){
            $_SESSION['status'] = 'pending';
            header('location:../verify-step-3.php');
            exit;
        }else{
            echo "false";
        }
    }else{
        echo "false";
    }
}



function check_date($date)
{

    $today = date("d-m-Y");
    $limit = strtotime($today) - 31548400*14;


    $date_time = strtotime($date);



    if ($date_time < $limit) {
        return true;
    }else{
        return false;
    }
}

?>