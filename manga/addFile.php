<?php
  session_start();
  include('src/_inc_parametres.php');
  include('src/_inc_connexion.php');

  if(!empty($_POST["nom"])){
    $nom = $_POST["nom"];
    $numEp = $_POST["numEp"];
    $link = $_POST["link"];
    $actu = $_POST["actu"];
    if (empty($link)) {
      $resultat = $cnx->prepare("insert into liste(nom, noEpisode, idUser) VALUES(:nom, :noEp, :idUse);");
      $resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
      $resultat->bindValue(':noEp', $numEp, PDO::PARAM_STR);
      $resultat->bindValue(':idUse', $_SESSION['idMembre'], PDO::PARAM_STR);
      $resultat->execute();
      $test = $resultat->fetchAll();
    }
    else {
      $resultat = $cnx->prepare("insert into liste(nom, noEpisode, lien, ActuAuto, idUser) VALUES(:nom, :noEp, :lien, :actu, :idUse)");
      $resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
      $resultat->bindValue(':noEp', $numEp, PDO::PARAM_STR);
      $resultat->bindValue(':lien', $link, PDO::PARAM_STR);
      $resultat->bindValue(':actu', $actu, PDO::PARAM_STR);
      $resultat->bindValue(':idUse', $_SESSION['idMembre'], PDO::PARAM_STR);
      $resultat->execute();
      $test = $resultat->fetchAll();
    }

    echo "success";

  }
?>
