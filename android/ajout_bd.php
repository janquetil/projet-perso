<?php
/* Requête HTTP Post */
// tableau de réponse JSON (array)
$reponse = array();

// tester si les champs sont valides
if (isset($_POST['col2']) && isset($_POST['col3']) && isset($_POST['col4'])) {
  $valeur_col2 = $_POST['col2'];
  $valeur_col3 = $_POST['col3'];
  $valeur_col4 = $_POST['col4'];

  // inclure la classe de connexion
  require_once('_inc_parametres.php');
  require_once('_inc_connexion.php');

  // requéte pour insérer les données
  $resultat = $cnx->prepare("INSERT INTO TableExemple(col2, col3, col4) VALUES(:val2, :val3, :val3)");
  $resultat->bindValue(':val2', $valeur_col2, PDO::PARAM_STR);
  $resultat->bindValue(':val3', $valeur_col3, PDO::PARAM_STR);
  $resultat->bindValue(':val4', $valeur_col4, PDO::PARAM_STR);
  $resultat->execute();

  // tester si les données sont bien insérées
  if ($resultat) {
    // Données bien insérées
    $reponse["success"] = 1;
    $reponse["message"] = "Donnees bien inserees";

    // afficher la reponse JSON
    echo json_encode($reponse);
  }
  else {
    // erreur d'insertion
    $reponse["success"] = 0;
    $reponse["message"] = utf8_decode("Oops! Erreur d'insrtion.");

    // afficher la réponse JSON
    echo json_encode($reponse);
  }
}
else {
  // Champ(s) manquant(s)
  $reponse["success"] = 0;
  $reponse["message"] = utf8_decode("Champ(s) manquant(s)");

  // afficher la réponse JSON
  echo json_encode($reponse);
}

?>
