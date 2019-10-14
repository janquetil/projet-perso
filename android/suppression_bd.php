<?php

/*
 Requete HTTP Post
 */

 // tableau de reponse JSON (array)
 $reponse = array();

// tester s'il y a une donnée récue
if (isset($_POST['col1'])) {
    $valeur_col1 = $_POST['col1'];
    // inclure la classe de connexion
    require_once('_inc_parametres.php');
    require_once('_inc_connexion.php');

    // supprimer la ligne
    $resultat = $cnx->prepare("DELETE FROM TableExemple WHERE col1 = :val1");
    $resultat->bindValue(':val1', $valeur_col1, PDO::PARAM_INT);
    $resultat->execute();

    // ligne supprimée
    $reponse["success"] = 1;
    $reponse["message"] = "ligne supprimée";

    // afficher  la reponse JSON
    echo json_encode($reponse);
    
} else {
    // Champ manquant col1
    $reponse["success"] = 0;
    $reponse["message"] = "Champ manquant";

    // afficher  la reponse JSON
    echo json_encode($reponse);
}
?>
