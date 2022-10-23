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


if(isset($_POST['texte']) && isset($_POST['etat']) && isset($_POST['cat']) )
{
    $texte=htmlspecialchars(addslashes($_POST['texte']));
    $etat=htmlspecialchars(addslashes($_POST['etat']));
    $cat=htmlspecialchars(addslashes($_POST['cat']));

    $autorisation="SELECT cat_autorisation from t_categorie_cat where cat_id ='$cat' ";
    $res=$mysqli->query($autorisation);
    $aut=$res->fetch_assoc();
    //echo $autorisation;

    if($aut['cat_autorisation']==$_SESSION['statut'])
    {
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
        echo "Vous n'avez pas l'autorisation pour publiez une information dans cette categorie";
        $_SESSION['msg']=2;
    }
}else{
    echo "IL y a des champs manquantes";
    $_SESSION['msg']=3;
}

header("Location: redacteur_inf_ajout.php");

$mysqli->close();
?>