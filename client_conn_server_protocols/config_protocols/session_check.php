<?php
function check_session($conn){
  if(			isset($_SESSION['id']) &&
  				isset($_SESSION['username']) &&
  				isset($_SESSION['email']) &&
                isset($_SESSION['password']) &&
  				isset($_SESSION['url_photo']) &&
  				isset($_SESSION['status']) &&
  				isset($_SESSION['grade']) &&
  				isset($_SESSION['referral_id']) &&
  				isset($_SESSION['referral_user'])
    ){
      return true;
    }else{
      return false;
    }
}
 ?>
