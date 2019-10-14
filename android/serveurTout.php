<?php

require_once('_inc_parametres.php');
require_once('_inc_connexion.php');

if(!empty($_POST['operation'])) {

  if($_POST['operation'] == "afficher") {

    // array for JSON response
    $response = array();

    $lesdonnees = $_POST['lesdonnees'];


    // get all products from products table
    $resultat = $cnx->prepare("SELECT * FROM TableExemple WHERE col1=$lesdonnees");
    $resultat->execute();
    $result = $resultat->fetchAll();

    // check for empty result
    if (!empty($result[0][0])) {

        print('afficher%');

        // looping through all results
        $response["valeurs"] = array();

        foreach ($result as $row) {
          $ligne = array();
          $ligne["col1"] = $row[0];
          $ligne["col2"] = $row[1];
          $ligne["col3"] = $row[2];
          $ligne["col4"] = $row[3];

          array_push($response["valeurs"], $ligne);
        }
        // success
        $response["success"] = 1;

        // echoing JSON response
        echo json_encode($response);
    } else {

        print('erreur%');

        // no products found
        $response["success"] = 0;
        $response["message"] = 'pas de résultat';

        // echo no users JSON
        echo json_encode($response);
    }
  }
  elseif ($_POST['operation'] == "ajout") {

    // tableau de réponse JSON (array)
    $reponse = array();

    $lesdonnees = $_POST['lesdonnees'];
    $donnees = json_decode($lesdonnees);

    $valeur_col2 = $donnees[0];
    $valeur_col3 = $donnees[1];
    $valeur_col4 = $donnees[2];

    if (!empty($valeur_col2) && !empty($valeur_col3) && !empty($valeur_col4)) {

      // requéte pour insérer les données
      $resultat = $cnx->prepare("INSERT INTO TableExemple(col2, col3, col4) VALUES(:val2, :val3, :val4)");
      $resultat->bindValue(':val2', $valeur_col2, PDO::PARAM_STR);
      $resultat->bindValue(':val3', $valeur_col3, PDO::PARAM_STR);
      $resultat->bindValue(':val4', $valeur_col4, PDO::PARAM_STR);
      $resultat->execute();

      // tester si les données sont bien insérées
      if ($resultat) {

        print('ajout%');

        // Données bien insérées
        $reponse["success"] = 1;
        $reponse["message"] = "Donnees bien inserees";

        // afficher la reponse JSON
        echo json_encode($reponse);
      }
      else {

        print('erreur%');

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
  }
  elseif ($_POST['operation'] == "suppression") {

    // tableau de reponse JSON (array)
    $reponse = array();

    if (isset($_POST['col1'])) {

        print('suppression%');

        $valeur_col1 = $_POST['col1'];

        // supprimer la ligne
        $resultat = $cnx->prepare("DELETE FROM TableExemple WHERE col1 = :val1");
        $resultat->bindValue(':val1', $valeur_col1, PDO::PARAM_INT);
        $resultat->execute();

        $reponse["success"] = 1;
        $reponse["message"] = "ligne supprimée";

        // afficher  la reponse JSON
        echo json_encode($reponse);

    } else {

        print('erreur%');

        // Champ manquant col1
        $reponse["success"] = 0;
        $reponse["message"] = "Champ manquant";

        // afficher  la reponse JSON
        echo json_encode($reponse);
    }
  }
  elseif ($_POST['operation'] == "update") {

    // array for JSON response
    $response = array();

    // check for required fields
    if (isset($_POST['col1']) && isset($_POST['col2']) && isset($_POST['col3']) && isset($_POST['col4'])) {

        print('update%');

        $value_col1 = $_POST['col1'];
        $value_col2 = $_POST['col2'];
        $value_col3 = $_POST['col3'];
        $value_col4 = $_POST['col4'];

        // mysql update row with matched pid
        $resultat = $cnx->query("UPDATE TableExemple SET col2 = '$value_col2', col3 = '$value_col3', col4 = '$value_col4' WHERE col1 = $value_col1");

        $response["success"] = 1;
        $response["message"] = "Row successfully updated.";

        // echoing JSON response
        echo json_encode($response);

    } else {

        print('erreur%');

        // required field is missing
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing";

        // echoing JSON response
        echo json_encode($response);
    }
  }

}


?>
