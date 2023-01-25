<?php
//connection a la base de donnee
$mysqli = new mysqli('localhost','hatimmrabet','gestionBDD2018','zfl2-zm_rabeha'); 

if ($mysqli->connect_errno)
{
    // Affichage d'un message d'erreur
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    // Arrêt du chargement de la page
    exit();
}
// Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
if (!$mysqli->set_charset("utf8")) {
    //printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    exit();
}
?>