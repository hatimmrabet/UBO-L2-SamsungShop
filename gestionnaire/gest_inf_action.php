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


if(isset($_POST['save']))
{
    $texteEdit=htmlspecialchars(addslashes($_POST['texteEdit']));

    $sqlUpdate="UPDATE t_information_inf
    set inf_texte='".$texteEdit."' , inf_etat = '".$_POST['etatEdit']."' , cat_id='".$_POST['catEdit']."'
    where inf_id = '".$_GET['edit']."';";
    //echo $sqlUpdate;
    $resUpdate=$mysqli->query($sqlUpdate);

    if($resUpdate==false)
    {
    echo "Error: Problème de requete \n";
    echo $sqlUpdate;
    exit();
    }
    $_SESSION['msgEdit']=1;

    header("Location: gest_edit_inf.php?edit=".$_GET['edit']."");
}

$mysqli->close(); ?>