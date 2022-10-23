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

?>

<?php   
if(isset($_POST['supprimer']))      //supression des catégorie
{
    //eviter les probleme de ' et "
    $id=htmlspecialchars(addslashes(trim($_POST['id'])));

    //chercher l'actualité avec cet id
    $sql="SELECT cat_id from t_categorie_cat where cat_id ='".$id."'";
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
            $sql1="DELETE from t_categorie_cat where cat_id='".$id."' ";
            $res1=$mysqli->query($sql1);
            if($res1==false)
            {
                echo "ERREUR : $sql1 .\n";
            }
            else
            {
                $_SESSION['msg']=1;
                echo "Catégorie supprimé";
            }

        }else{
            $_SESSION['msg']=2;
            echo "N° de Catégorie incorrect";
        }
    }

    header("Location: gest_cat.php");

}


if(isset($_POST['ajouter']))        //ajout des catégorie
{
    //eviter les probleme de ' et "
    $intitulé=htmlspecialchars(addslashes(trim($_POST['intitulé'])));

    //chercher la catégorie avec cet id
    $sql="INSERT INTO t_categorie_cat values (null,'".$intitulé."','".$_POST['thedate']."','".$_POST['aut']."');";
    $res=$mysqli->query($sql);
    echo $sql;
    if($res==false)
    {
        echo "ERREUR : $sql";
        $_SESSION['msg']=4;
    }
    else
    {
        $_SESSION['msg']=3;
        echo "Catégorie Ajouté";
    }

    header("Location: gest_cat.php");

}

if(isset($_POST['modifier'])){
    $intitulé=htmlspecialchars(addslashes(trim($_POST['intitulé'])));

    $sql1=  "UPDATE t_categorie_cat 
            SET cat_intitule='$intitulé' , cat_autorisation='".$_POST['aut']."' , cat_date='".$_POST['thedate']."'
            where cat_id=".$_GET['edit'].";";
    echo $sql1;

    $res=$mysqli->query($sql1);

    if ($res==false) {        // La requête a echoué
        echo "Error: Problème de requete \n";
        echo $sql1;
        exit();
    }

    $_SESSION['msg']=1;
    header("Location: gest_cat_edit.php?edit=".$_GET['edit']."");
}


$mysqli->close();
?>