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


$sql="SELECT * from t_profil_pfl join t_compte_cpt using(cpt_pseudo) where cpt_pseudo='".$_SESSION['pseudo']."';";
$query=$mysqli->query($sql);
$data=$query->fetch_assoc();
//echo $sql;

if ($query==false) {        // La requête a echoué
	echo "Error: Problème de requete \n";
	echo $sql;
	exit();
}

if(isset($_POST['save']))
{
    $nomEdit=htmlspecialchars(addslashes($_POST['nomEdit']));
    $prenomEdit=htmlspecialchars(addslashes($_POST['prenomEdit']));


    if(strcmp($_POST['mailEdit'],$data['pfl_mail'])!=0) //pas le meme mail
    {
        $sqlMail="SELECT pfl_mail from t_profil_pfl where pfl_mail='".$_POST['mailEdit']."';";
        //echo $sqlMail;
        $resMail=$mysqli->query($sqlMail);
        $nbMail=$resMail->num_rows;
        if($nbMail==1){     //si cette adresse mail existe deja
            echo "Mail déja utilisé";
            $_SESSION['msgEdit']=0;
        }else{
            $sqlUpdate="UPDATE t_profil_pfl 
                        set pfl_nom='".$nomEdit."' , pfl_prenom = '".$prenomEdit."' , pfl_mail='".$_POST['mailEdit']."'
                        where cpt_pseudo = '".$_SESSION['pseudo']."';";
            //echo $sqlUpdate;
            $resUpdate=$mysqli->query($sqlUpdate);
            if($resUpdate==false)
            {
                echo "Error: Problème de requete \n";
                echo $sqlUpdate;
                //exit();
            }
            $_SESSION['msgEdit']=1;
        }
    }else{      //meme mail
        $sqlUpdate="UPDATE t_profil_pfl 
        set pfl_nom='".$nomEdit."' , pfl_prenom = '".$prenomEdit."' , pfl_mail='".$_POST['mailEdit']."'
        where cpt_pseudo = '".$_SESSION['pseudo']."';";
        //echo $sqlUpdate;
        $resUpdate=$mysqli->query($sqlUpdate);
        if($resUpdate==false)
        {
        echo "Error: Problème de requete \n";
        echo $sqlUpdate;
        //exit();
        }
        $_SESSION['msgEdit']=1;
    }

    if(!empty($_POST['mdp1']) && !empty($_POST['mdp2']) ){
        if(strcmp($_POST['mdp1'],$_POST['mdp2'])==0){

            $mdp=htmlspecialchars(addslashes($_POST['mdp1']));

            $sqlMdp="UPDATE t_compte_cpt SET cpt_psswd = md5('$mdp') where cpt_pseudo = '".$_SESSION['pseudo']."';";
            $resMdp=$mysqli->query($sqlMdp);
            echo $sqlMdp;

            if($resMdp== false){
                echo "Error: Problème de requete \n";
                echo $sqlMdp;
                exit();
            }else{
                $_SESSION['msgMdp']=1;      //Modification reussite
            }
        }else{
            echo "les 2 mdp sont differents";
            $_SESSION['msgMdp']=2;
        }
    }
    elseif(empty($_POST['mdp1']) xor empty($_POST['mdp2']))
    {
        echo "il faut confirmer le mot de passe";
        $_SESSION['msgMdp']=3;
    }


    header("Location: red_edit_infpers.php");
}

$mysqli->close(); ?>