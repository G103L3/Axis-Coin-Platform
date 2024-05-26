<?php
include "..\client_conn_server_protocols\config_protocols\start.php";

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['referral_user']))
	{
    $username = pg_escape_string($conn, $_POST['username']);
    $email = pg_escape_string($conn, $_POST['email']);
    $password = pg_escape_string($conn, $_POST['password']);
    $referral_user = pg_escape_string($conn, $_POST['referral_user']);


    $referral_id = strval(time()) + strval(rand(0, 9));

    if($referral_user != null && $referral_user != "null"){
        $signup_query="INSERT INTO users (username, email, password, referral_id, referral_user)
           VALUES('$username', '$email', " . hash_crypt($password) . ", $referral_id, $referral_user)";
    }else{
        $signup_query="INSERT INTO users (username, email, password, referral_id)
           VALUES('$username', '$email', " . hash_crypt($password) . ", $referral_id)";
    }
      //Verifica username
      $username_query= "SELECT ID FROM users WHERE username='$username'";
      $username_result=pg_query($conn, $username_query);
      if (pg_num_rows($username_result)==0)
      {
        //Verifica email
        $email_query= "SELECT ID FROM users WHERE email='$email'";
        $email_result=pg_query($conn, $email_query);
        if (pg_num_rows($email_result)==0)
        {
          //Registrazione utente

          $signup_result = pg_query($conn, $signup_query);
          if ($signup_result)
          {
              $password_query= "SELECT * FROM users WHERE username = '$username' AND password = " . hash_crypt($password) . "";

              $password_result=pg_query($conn, $password_query);
              if (pg_num_rows($password_result)==0)
              {
                  echo "false";
              }else{
                  $user_row=pg_fetch_array($password_result);
                  $id = $user_row['id'];
                  $id = hash_crypt($id);
                  $register_cash_wallet_result= pg_query($conn, "INSERT INTO cash_wallets (user_id, balance) VALUES($id, 0.000)");
                  $register_network_wallet_result= pg_query($conn, "INSERT INTO network_wallets (user_id, balance) VALUES($id, 0.000)");
                  $register_users_session_result= pg_query($conn, "INSERT INTO users_sessions (user_id, session_id) VALUES($id, '" . session_id() . "')");

                  if($register_cash_wallet_result && $register_network_wallet_result && $register_users_session_result){
                      $_SESSION['id'] = $user_row['id'];
                      $_SESSION['username'] = $user_row['username'];
                      $_SESSION['email'] = $user_row['email'];
                      $_SESSION['password'] = $user_row['password'];
                      $_SESSION['url_photo'] = $user_row['url_photo'];
                      $_SESSION['status'] = $user_row['status'];
                      $_SESSION['grade'] = $user_row['grade'];
                      $_SESSION['referral_id'] = $user_row['referral_id'];
                      if($referral_user != null && $referral_user != "null"){
                          $_SESSION['referral_user'] = $user_row['referral_user'];
                      }else{
                          $_SESSION['referral_user'] = "null";
                      }
                      echo "true";
                  }else{
                      $delete_result = pg_query($conn, "DELETE FROM users where id= $id");
                      $delete_c_result = pg_query($conn, "DELETE FROM cash_wallets where user_id= " . hash_crypt($id) . "");
                      $delete_n_result = pg_query($conn, "DELETE FROM network_wallets where user_id= " . hash_crypt($id) . "");
                      echo "false";
                  }
              }
          }else{
            echo "false";
          }
        }else{
            echo "false";
        }
      }else{
          echo "false";
      }
	}
	else{
        echo "false";
	}

?>
