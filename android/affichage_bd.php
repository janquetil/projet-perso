<?php

/*
 * Following code will list all the data in the db
 */

// array for JSON response
$response = array();

// include db connect class
require_once('_inc_parametres.php');
require_once('_inc_connexion.php');

// get all products from products table
$resultat = $cnx->prepare("SELECT * FROM TableExemple");
$resultat->execute();
$result = $resultat->fetchAll();

// check for empty result
if (!empty($result[0][0])) {
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
    // no products found
    $response["success"] = 0;
    $response["message"] = "No data found";

    // echo no users JSON
    echo json_encode($response);
}
?>
