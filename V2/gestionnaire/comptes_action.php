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
if(isset($_POST['modifier']))
{
//eviter les probleme de ' et "
$pseudo=htmlspecialchars(addslashes(trim($_POST['pseudo'])));

//requperer la validite d'un compte
$sql="SELECT pfl_validite from t_profil_pfl join t_compte_cpt using(cpt_pseudo) where cpt_pseudo='".$pseudo."'";
$res=$mysqli->query($sql);
//echo $sql;
$compte=$res->fetch_assoc();
if($res==false)
{
    echo "ERREUR : $sql";
}
else
{
    if($res->num_rows==1)
    {
        if($compte['pfl_validite']=='D')
        {
            $sql1="UPDATE t_profil_pfl set pfl_validite = 'A' where cpt_pseudo = '".$pseudo."' ";
            $res1=$mysqli->query($sql1);
            if($res1==false)
            {
                echo "ERREUR : $sql1";
            }
            else
            {
                $_SESSION['msg']=1;
                echo "Compte activé";
            }
        }
        else
        {
            $sql1="UPDATE t_profil_pfl set pfl_validite = 'D' where cpt_pseudo = '".$pseudo."' ";
            $res1=$mysqli->query($sql1);
            if($res1==false)
            {
                echo "ERREUR : $sql1";
            }
            else
            {
                $_SESSION['msg']=2;
                echo "Compte désactivé";
            }
        }
    }else{
        $_SESSION['msg']=3;
        echo "Pseudo introuvable";
    }
    header("Location: gestionnaire_comptes.php");
}
}
$mysqli->close();
?>