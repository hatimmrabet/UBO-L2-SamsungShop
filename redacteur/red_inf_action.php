<?php
session_start();

//verification du statut de l'utilisateur et du profil s'il est connecté ou pas
if(!isset($_SESSION['pseudo']) || $_SESSION['statut']!='R') 
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


//requete pour l'autorisation du catégorie
$sql="SELECT cat_autorisation from t_categorie_cat join t_information_inf using(cat_id) where inf_id = '".$_GET["edit"]."';";
$query=$mysqli->query($sql);
//echo $sql;
$resAut=$query->fetch_assoc();

if ($query==false) {        // La requête a echoué
	echo "Error: Problème de requete \n";
	echo $sql;
	exit();
}

if($resAut['cat_autorisation']=='R'){       //s'il a l'autorisation...

    $sqlUpdate="UPDATE t_information_inf
    set inf_texte='".$texteEdit."' , inf_etat = '".$_POST['etatEdit']."' , cat_id='".$_POST['catEdit']."'
    where inf_id = '".$_GET['edit']."';";
    //echo $sqlUpdate;


    $resUpdate=$mysqli->query($sqlUpdate);  //execution de la requete

    if($resUpdate==false)
    {
    echo "Error: Problème de requete \n";
    echo $sqlUpdate;
    exit();
    }
    $_SESSION['msgEdit']=1;
}
else        //il n'a pas l'autorisation
{
    $_SESSION['msgEdit']=2;
    echo "Vous n\'avez pas le droit de modifier une information de cette categorie";
}

    header("Location: red_edit_inf.php?edit=".$_GET['edit']."");
}

$mysqli->close(); ?>