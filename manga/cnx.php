<?php
  session_start();
  include('src/_inc_parametres.php');
  include('src/_inc_connexion.php');

  if(!empty($_POST["mdp"])){
    $mdp = $_POST["mdp"];
    $identifiant = $_POST["login"];

    $resultat = $cnx->prepare("select identifiant, password, id from login where identifiant=:log");
    $resultat->bindValue(':log', $identifiant, PDO::PARAM_STR);
    $resultat->execute();
    $test = $resultat->fetchAll();

    if (empty($test[0][0])){
      echo "Erreur : L'identifiant ".$identifiant." est introuvable.";
    }
    elseif (sha1($mdp) != $test[0][1]) {
      echo "Erreur : Le mot de passe est incorrect.";
    }
    else {
      $_SESSION['pseudo'] = $identifiant;
      $_SESSION['idMembre'] = $test[0][2];
      $_SESSION['prio']= 'user';
      $_SESSION['last_time_see'] = time();
      echo "success";
    }
  }
?>
