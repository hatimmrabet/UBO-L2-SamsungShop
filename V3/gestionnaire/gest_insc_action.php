<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="../img/favicon.ico"/>
    <link rel="stylesheet" href="../css/login.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body class="bg-light" style="padding-top:0px;">

    <?php $page=1; ?>

    <?php require_once("../includes/navbar-gestionnaire.php");

    require_once("../includes/BDD.php");

    //Inscription
        $pseudo=htmlspecialchars(addslashes(($_POST['pseudo'])));
        $mdp1=htmlspecialchars(addslashes(($_POST['mdp1'])));
        $mdp2=htmlspecialchars(addslashes(($_POST['mdp2'])));
        $mail=htmlspecialchars(addslashes(($_POST['mail'])));
        $nom=htmlspecialchars(addslashes(($_POST['nom'])));
        $prenom=htmlspecialchars(addslashes(($_POST['prenom'])));
        
        $problem1=0;    //variable de probleme
        //echo $problem1;
        
        if($_POST['nom'] && $_POST['prenom'] && $_POST['pseudo'] && $_POST['mail'] && $_POST['mdp1'] && $_POST['mdp2'])
        {//cond que tous les champs sont remplies

            if(strcmp($_POST['mdp1'],$_POST['mdp2'])==0)    //meme mot de passe
            {
                //pseudo differents
                $reqpseudo="SELECT * FROM t_compte_cpt WHERE cpt_pseudo ='$pseudo'";
                $respseudo=$mysqli->query($reqpseudo);
                $existpseudo=$respseudo->num_rows ;
                //echo $existpseudo;

                //mail differents
                $reqmail="SELECT * FROM t_profil_pfl WHERE pfl_mail ='$mail'";
                $resmail=$mysqli->query($reqmail);
                $existmail=$resmail->num_rows ;
                //echo $existmail;

                if($existpseudo==0 && $existmail==0) //mail et pseudo jamais utilisés
                {
                    //preparation des requetes
                    $insertCompte="INSERT into t_compte_cpt values ('" .$pseudo. "',md5('" .$mdp1. "'))";
                    $insertProfile="INSERT INTO t_profil_pfl VALUES ('".$nom."','".$prenom."','".$mail."','R','D','".$pseudo."',sysdate())";
                    $deleteCompte="DELETE from  t_compte_cpt where cpt_pseudo = '" .$pseudo. "' ";
                    //$deleteprofile="DELETE from  t_profil_pfl where cpt_pseudo = '$pseudo'";
                    //echo $insertCompte;     echo "<br>";

                    $result3 = $mysqli->query($insertCompte);   //insertion de compte

                    if ($result3 == false ) //Erreur lors de l’exécution de la requête insertion compte
                    {
                        // La requête insertion compte a echoué
                        echo "Error: La requête a échoué \n";
                        echo "Query: " . $insertCompte . "\n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        $problem1=1;
                        exit;
                    }
                    else //Requête insertion compte réussie
                    {   
                        //echo "ajout de compte avec succes <br>";
                        //echo $insertProfile;    echo "<br>";

                        $problem1=0;
                        
                        $result4 = $mysqli->query($insertProfile);  //insertion profile

                        if ($result4 == false )     // La requête a echoué
                        {
                            $mysqli->query($deleteCompte);      //supression du compte
                            echo "supression du compte "; echo "<br>";
                            $problem1=1;
                            echo "Error: La requête a échoué \n";
                            echo "Query: " . $insertProfile . "\n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit;
                        }
                        else    //login correcte
                        {
                            //echo "ajout de profile avec succes <br>";
                            $problem1=0;
                            $_SESSION['connect']=1;                            
                            header("Location: gestionnaire_comptes.php");
                        }
                    }// end cond d'insertion compte et profile
                }
                else //email ou pseudo existe deja
                {
                    //echo "email ou pseudo existe deja";
                    $problem1=1;
                    $msg=0;
                }
            }
            else    //cond sur mdp 
            {
                //echo "les mots de passe ne sont pas identiques";
                $problem1=1;
                $msg=-1;
            }
        }
        else //champs vides
        {
            //echo "il y a des champs vides";
            $problem1=1;
            $msg=-2;
        }

        //echo $problem1;
        if($problem1==1)
        {
            $pseudo=stripslashes(($_POST['pseudo']));
            $mdp1=stripslashes(($_POST['mdp1']));
            $mdp2=stripslashes(($_POST['mdp2']));
            $mail=stripslashes(($_POST['mail']));
            $nom=stripslashes(($_POST['nom']));
            $prenom=stripslashes(($_POST['prenom']));
            //header("Location: inscription.php");

            //affichage des msg d'erreur
            echo('<div style="margin-top:2rem;">');

                if( $msg==0 ) { //afficher msg error 1
                    echo('<div class="alert alert-danger" role="alert">');
                        echo('email ou pseudo existe deja');
                    echo('</div>');
                }
                if( $msg==-1 ) { //afficher msg error 2
                    echo('<div class="alert alert-danger" role="alert">');
                        echo('les mots de passe ne sont pas identiques');
                    echo('</div>');
                }
                if( $msg==-2 ) { //afficher msg error 3
                    echo('<div class="alert alert-danger" role="alert">');
                        echo('il y a des champs manquants');
                    echo('</div>');
                }
            echo('</div>');


            //reaffichage du formulaire
            echo('<div class="container">');
                echo('<div class="py-3 text-center"><h2>Ajouter un compte</h2></div>');
                echo('<div class="col-md-8 order-md-1" style=" margin: auto;">');
                    echo('<form class="needs-validation" action="gest_insc_action.php" method="post">');
                    echo('<div class="row">');
                    echo('<div class="col-md-6 mb-3">');
                        echo('<label for="firstName">Nom</label>');
                        echo("<input name=\"nom\" type=\"text\" class=\"form-control\" id=\"firstName\" placeholder=\"Nom\" value= \"$nom\" required>");
                        echo('<div class="invalid-feedback">Valid last name is required.</div>');
                echo('</div>');
                    echo('<div class="col-md-6 mb-3">');
                        echo('<label for="lastName">Prenom</label>');
                            echo("<input name=\"prenom\" type=\"text\" class=\"form-control\" id=\"lastName\" placeholder=\"Prenom\" value= \"$prenom\" required>");
                        echo('<div class="invalid-feedback">Valid First name is required.</div>');
                    echo('</div>');
                    echo('</div>');

                    echo('<div class="mb-3">');
                    echo('<label for="username">Pseudo </label>');
                    echo('<div class="input-group">');
                        echo('<div class="input-group-prepend"><span class="input-group-text">@</span></div>');
                            echo("<input name=\"pseudo\" type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"Username\" value=\"$pseudo\" required maxlength=\"60\">");
                        echo('<div class="invalid-feedback" style="width: 100%;">Your username is required.</div>');
                    echo('</div>');
                    echo('</div>');

                    echo('<div class="mb-3">');
                    echo('<label for="email">Email </label>');
                        echo("<input name=\"mail\" type=\"email\" class=\"form-control\" id=\"email\" pattern=\"[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}$\"
                            placeholder=\"you@example.com\" value=\"$mail\" required>");
                    echo('<div class="invalid-feedback">Please enter a valid email address.</div>');
                    echo('</div>');
                    echo('<div class="row">');
                    echo('<div class="col-md-6 mb-3">');
                        echo('<label for="email">Mot de passe </label>');
                        echo("<input name=\"mdp1\" type=\"password\" class=\"form-control\" id=\"email\" placeholder=\"********\" required minlength=\"5\" value=\"$mdp1\" >");
                        echo('<div class="invalid-feedback">Please enter a valid password .</div>');
                    echo('</div>');
                    echo('<div class="col-md-6 mb-3">');
                        echo('<label for="email">Confirmation de Mot de passe </label>');
                        echo("<input name=\"mdp2\" type=\"password\" class=\"form-control\" id=\"email\" placeholder=\"********\" required minlength=\"5\" value=\"$mdp2\">");
                        echo('<div class="invalid-feedback">Please enter a valid password .</div>');
                    echo('</div>');
                    echo('</div>');
                    
                    echo('<hr class="mb-4">');
                    echo('<button class="btn btn-primary btn-lg btn-block" type="submit">Enregistrer</button>');
                    echo('</form>');
                echo('</div>');
            echo('</div>');
        }

    $mysqli->close();   //Ferme la connexion avec la base MariaDB
    ?>

</body>

</html>