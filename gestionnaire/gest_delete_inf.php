<?php
session_start();

//verification du statut de l'utilisateur et du profil s'il est connecté ou pas
if(!isset($_SESSION['pseudo']) || $_SESSION['statut']!='G') 
{
//Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:../login/session.php");
exit();
}

//connection a la base de donnee
require_once("../includes/BDD.php");


if($_GET["delete"] != null){
    $sqlDelete="DELETE FROM  t_information_inf where inf_id = '".$_GET["delete"]."';";
    //echo $sqlDelete;
    $resDelete=$mysqli->query($sqlDelete);

    if($resDelete==false)
    {
    echo "Error: Problème de requete \n";
    echo $sqlDelete;
    exit();
    }
    $_SESSION['msgDelete']=1;
}
else    // get is null
{
    $_SESSION['msgDelete']=2;
    echo "Categorie Vide";
}

    header("Location: gest_affich_info.php");


$mysqli->close(); ?>