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


if(isset($_POST['supprimer']))      //supression des actualités
{
    //eviter les probleme de ' et "
    $id=htmlspecialchars(addslashes(trim($_POST['id'])));

    //chercher l'actualité avec cet id
    $sql="SELECT new_num from t_news_new where new_num ='".$id."'";
    $res=$mysqli->query($sql);
    //echo $sql;
    if($res==false)
    {
        echo "ERREUR : $sql";
    }
    else
    {
        if($res->num_rows==1)
        {
            $sql1="DELETE from t_news_new where new_num='".$id."' ";
            $res1=$mysqli->query($sql1);
            if($res1==false)
            {
                echo "ERREUR : $sql1 .\n";
            }
            else
            {
                $_SESSION['msg']=1;
                echo "Actualité supprimé";
            }

        }else{
            $_SESSION['msg']=2;
            echo "N° d'actualité incorrect";
        }
    }

    header("Location: redacteur_actualites.php");

}


if(isset($_POST['ajouter']))        //ajout des actualités
{
    //eviter les probleme de ' et "
    $titre=htmlspecialchars(addslashes(trim($_POST['titre'])));
    $texte=htmlspecialchars(addslashes(trim($_POST['texte'])));

    //chercher l'actualité avec cet id
    $sql="INSERT INTO t_news_new values(null,'".$titre."','".$texte."','".$_POST['thedate']."','".$_POST['etat']."','".$_SESSION['pseudo']."');";
    $res=$mysqli->query($sql);
    //echo $sql;
    if($res==false)
    {
        echo "ERREUR : $sql";
        $_SESSION['msg']=4;
    }
    else
    {
        $_SESSION['msg']=3;
        echo "Actualité Ajouté";
    }

    header("Location: redacteur_actualites.php");

}

if(isset($_POST['modifier'])){
    $titre=htmlspecialchars(addslashes($_POST['titre']));
    $texte=htmlspecialchars(addslashes($_POST['texte']));

    $sql1=  "UPDATE t_news_new 
            SET new_titre='$titre' , new_texte='$texte',  new_etat='".$_POST['etat']."' , new_date='".$_POST['thedate']."'
            where new_num=".$_GET['edit'].";";
    echo $sql1;

    $res=$mysqli->query($sql1);

    if ($res==false) {        // La requête a echoué
        echo "Error: Problème de requete \n";
        echo $sql1;
        exit();
    }

    $_SESSION['msg']=1;
    header("Location: redacteur_edit_act.php?edit=".$_GET['edit']."");
}


$mysqli->close();
?>