<?php
session_start();

//verification du statut de l'utilisateur et du profil s'il est connecté ou pas
if(!isset($_SESSION['pseudo']) || $_SESSION['statut']!='G') 
{
//Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:../login/session.php");
exit();
}

require_once("../includes/BDD.php");


if(isset($_POST['texte']) && isset($_POST['etat']) && isset($_POST['cat']) )
{
    $texte=htmlspecialchars(addslashes($_POST['texte']));
    $etat=htmlspecialchars(addslashes($_POST['etat']));
    $cat=htmlspecialchars(addslashes($_POST['cat']));

    //requete pour l'insertion
    $sql="INSERT INTO t_information_inf (inf_texte, inf_date_ajout, inf_etat, cpt_pseudo, cat_id) VALUES ('$texte',sysdate() , '$etat','".$_SESSION['pseudo']."', '$cat')";
    $query=$mysqli->query($sql);
    echo $sql; echo "<br>";

    if ($query==false) {        // La requête a echoué
        echo "Error: Problème de requete \n";
        echo $sql;
        exit();
    }else{
        echo "ajout avec success \n";
        $_SESSION['msg']=1;
    }
}else{
    echo "IL y a des champs manquantes";
    $_SESSION['msg']=3;
}

header("Location: gest_inf_ajout.php");

$mysqli->close();
?>