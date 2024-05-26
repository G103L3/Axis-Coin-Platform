<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

	if(isset($_POST['email']) && isset($_POST['password']))
	{
        $email = pg_escape_string($conn, $_POST['email']);
        $password = pg_escape_string($conn, $_POST['password']);

        //Verifica EMAIL
        $email_query= "SELECT id FROM users WHERE email='$email'";
        $email_result=pg_query($conn, $email_query);
        if (pg_num_rows($email_result)==0)
        {
            echo "false";
        }else{
            //Verifica PASSWORD
            $password_query= "SELECT * FROM users WHERE email = '$email' AND password = " . hash_crypt($password) . "";

            $password_result=pg_query($conn, $password_query);
            if (pg_num_rows($password_result)==0)
            {
                echo "false";
            }else{
                $user_row=pg_fetch_array($password_result);
                $tmp_id = hash_crypt($user_row['id']);
                $users_sessions_set=pg_query($conn, "UPDATE users_sessions SET session_id='". session_id() . "' WHERE user_id =$tmp_id");
                if(pg_affected_rows($users_sessions_set) > 0){
                    $_SESSION['id'] = $user_row['id'];
                    $_SESSION['username'] = $user_row['username'];
                    $_SESSION['email'] = $user_row['email'];
                    $_SESSION['password'] = $user_row['password'];
                    $_SESSION['url_photo'] = $user_row['url_photo'];
                    $_SESSION['status'] = $user_row['status'];
                    $_SESSION['grade'] = $user_row['grade'];
                    $_SESSION['referral_id'] = $user_row['referral_id'];
                    if($user_row['referral_user'] != null && $user_row['referral_user'] != "null" && $user_row['referral_user'] != undefined && $user_row['referral_user'] != 'undefined'){
                        $_SESSION['referral_user'] = $user_row['referral_user'];
                    }else{
                        $_SESSION['referral_user'] = "null";
                    }
                    echo "true";
                }else{
                    echo "false";
                }
            }
        }
	}
	else{
		echo "false";
	}

?>
