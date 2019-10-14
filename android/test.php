<?php
require_once('_inc_parametres.php');
require_once('_inc_connexion.php');
$resultat = $cnx->prepare("SELECT * FROM TableExemple WHERE col1=9");
$resultat->execute();
$result = $resultat->fetchAll();

echo $result[0][1];


 ?>
