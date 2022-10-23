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
    if($res->num_rows==1)// s'il existe un compte
    {
        if(strcmp($_SESSION['pseudo'],$pseudo)==0) //si c'est votre compte
        {
            $_SESSION['msg']=0;
            echo "Vous ne pouvez pas changez la validité de votre Compte";
        }
        else    //si c'est pas votre compte
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
        }
    }
    else    //si le compte est introuvable
    {
        $_SESSION['msg']=3;
        echo "Pseudo introuvable";
    }
}
}

if(isset($_POST['supprimer'])){
    $pseudo=htmlspecialchars(addslashes(trim($_POST['pseudo'])));

    $sql="SELECT cpt_pseudo from t_profil_pfl join t_compte_cpt using(cpt_pseudo) where cpt_pseudo='".$pseudo."'";
    $res=$mysqli->query($sql);
    //echo $sql;

    if($nb=$res->num_rows==1){ //existe un compte + profil

        $delProfil="DELETE FROM t_profil_pfl where cpt_pseudo ='$pseudo';";
        $resProdil=$mysqli->query($delProfil);
        echo $delProfil;
        if($resProdil==false)
        {
            echo "ERREUR : $delProfil ";
        }
        else
        {
            $delCpt="DELETE FROM t_compte_cpt where cpt_pseudo ='$pseudo';";
            $resCpt=$mysqli->query($delCpt);
            echo $delCpt;

            $_SESSION['msgDel']=0;
            
        }
    }else{
        $_SESSION['msgDel']=1;
        echo "erreur : ";
    }
}

header("Location: gestionnaire_comptes.php");

$mysqli->close();
?>