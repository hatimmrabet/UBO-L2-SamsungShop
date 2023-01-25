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
$mysqli = new mysqli('localhost','zm_rabeha','Hatimtim123','zfl2-zm_rabeha'); //ouverture de connection
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

<?php
if(isset($_POST['supprimer']))
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
}


if(isset($_POST['ajouter']))
{
    //eviter les probleme de ' et "
    $titre=htmlspecialchars(addslashes(trim($_POST['titre'])));
    $texte=htmlspecialchars(addslashes(trim($_POST['texte'])));

    //chercher l'actualité avec cet id
    $sql="INSERT INTO t_news_new values(null,'".$titre."','".$texte."',sysdate(),'".$_POST['etat']."','".$_SESSION['pseudo']."');";
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
}

header("Location: gestionnaire_actualites.php");


$mysqli->close();
?>