<?php

/*
 * Following code will update a row information
 * A row is identified by  id (col1)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['col1']) && isset($_POST['col2']) && isset($_POST['col3']) && isset($_POST['col4'])) {

    $value_col1 = $_POST['col1'];
    $value_col2 = $_POST['col2'];
    $value_col3 = $_POST['col3'];
    $value_col4 = $_POST['col4'];

    // connecting to db
    require_once('_inc_parametres.php');
    require_once('_inc_connexion.php');

    // mysql update row with matched pid
    $resultat = $cnx->query("UPDATE TableExemple SET col2 = '$value_col2', col3 = '$value_col3', col4 = '$value_col4' WHERE col1 = $value_col1");

    $response["success"] = 1;
    $response["message"] = "Row successfully updated.";

    // echoing JSON response
    echo json_encode($response);

} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
