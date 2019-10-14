<?php

require_once('_inc_parametres.php');
require_once('_inc_connexion.php');

$response = array();

if (!empty($_POST['operation'])){

  if($_POST['operation'] == 'connexion'){
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];

    $resultat = $cnx->prepare("select identifiant, password, id from login where identifiant=:log");
    $resultat->bindValue(':log', $identifiant, PDO::PARAM_STR);
    $resultat->execute();
    $result = $resultat->fetchAll();

    if (empty($result[0][0])) {
      print("error%");
      $reponse['message'] = 'identifiant non trouve '.$identifiant;

      print(json_encode($reponse));
    }
    else {
      if ($result[0][1] == sha1($mdp)) {
        print("successCnx%");
        $reponse[0] = $result[0][0];
        $reponse[1] = $result[0][2];

        print(implode(",", $reponse));
      }
      else {
        print("errorCnx%");
        $reponse['message'] = 'mot de passe incorrect';

        print(json_encode($reponse));
      }

    }
  }
  elseif ($_POST['operation'] == 'nomManga') {
    $id = $_POST['id'];

    $resultat = $cnx->prepare("SELECT nom FROM liste WHERE idUser=$id");
    $resultat->execute();
    $result = $resultat->fetchAll();

    if (empty($result[0][0])){
      print("errorNomManga%");
      $reponse['message'] = 'rien dans la liste';
      print(json_encode($reponse));
    }
    else {
      print("successNomManga%");
      $i=0;
      foreach ($result as $value) {
        $reponse[$i] = $value[0];
        $i+=1;
      }
      print(implode(",", $reponse));
    }

  }
  elseif ($_POST['operation'] == 'infoManga') {
    $name = $_POST['name'];

    $resultat = $cnx ->prepare("SELECT noEpisode, lien FROM liste WHERE nom='$name'");
    $resultat->execute();
    $result = $resultat->fetchAll();

    if(empty($result[0][0])){
      print("errorInfoManga%");
      $reponse['message'] = 'rien dans la liste '.$name;
      print(json_encode($reponse));
    }
    else {
      print("successInfoManga%");
      print($result[0][0].",".$result[0][1]);
    }
  }

}

?>
