<?php
  if(!empty($_POST['msg'])) {
    $to = 'anquetil.jul@gmail.com';
    $sujet = 'Message de '.$_POST['nom'].' '.$_POST['prenom'].' du site anquetil.org';
    $message = $_POST['msg'];
    $headers = 'From: '.$_POST['mail']."\r\n".'Reply-To: '.$_POST['mail']."\r\n".'X-Mailer: PHP/'.phpversion();
    $message = $headers."\r\n\r\n".$message;
    try {
      mail($to, $sujet, $message, $headers);
      echo "Success";
    } catch (\Exception $e) {
      echo "Error";
    }

  }
?>
