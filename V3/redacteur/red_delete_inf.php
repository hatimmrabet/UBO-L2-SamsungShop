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


//requete pour l'autorisation du catégorie
$sql="SELECT cat_autorisation from t_categorie_cat join t_information_inf using(cat_id) where inf_id = '".$_GET["delete"]."';";
$query=$mysqli->query($sql);
//echo $sql;
$resAut=$query->fetch_assoc();

if ($query==false) {        // La requête a echoué
	echo "Error: Problème de requete \n";
	echo $sql;
	exit();
}

if($_GET["delete"] != null){
    if($resAut['cat_autorisation']=='R'){       //s'il a l'autorisation...

        $sqlDelete="DELETE FROM  t_information_inf where inf_id = '".$_GET["delete"]."';";
        //echo $sqlDelete;
        $resDelete=$mysqli->query($sqlDelete);

        if($resDelete==false)
        {
        echo "Error: Problème de requete \n";
        echo $sqlDelete;
        exit();
        }
        echo "suppression success";
        $_SESSION['msgDelete']=1;
    }
    else
    {
        echo "Vous n\'avez pas l\'autorisation de supprimer une information de cette catégorie";
        $_SESSION['msgDelete']=2;
    }
}else // get is null
{
    $_SESSION['msgDelete']=3;
    echo "Categorie Vide";
}

header("Location: redacteur_informations.php");


$mysqli->close(); ?>
