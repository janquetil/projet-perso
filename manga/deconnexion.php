<?php
  session_start();
  if(!empty($_SESSION['pseudo']) AND !empty($_POST['bite'])){
    $_SESSION = array();
    session_destroy();

    if(isset($_COOKIE['pseudo'], $_COOKIE['password']) AND !empty($_COOKIE['pseudo']) AND !empty($_COOKIE['password'])) {
      setcookie('pseudo', '', time()-1);
      setcookie('password', '', time()-1);
    }
    echo 'success';
  }
?>
