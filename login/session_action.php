<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="icon" type="image/png" href="../img/favicon.ico"/>
	<link rel="stylesheet" href="../css/login.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body class="text-center" style="padding-top:0px;">

<?php $accueil=1; ?>

<?php require_once("../includes/navbar-cat.php"); ?>

<?php
//Ouverture d'une session
session_start();

//CONNECTION
//$msg=-2;	
if( $_POST['pseudo'] AND $_POST['mdp'] )    //les 2 champs sont remplies
{ 
    $pseudo=htmlspecialchars(addslashes(($_POST['pseudo'])));
    $mdp=htmlspecialchars(addslashes(($_POST['mdp'])));
    
    //echo $pseudo; echo "<br>"; echo md5($mdp);

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
    
    $sql="SELECT cpt_pseudo, pfl_statut, pfl_validite from t_profil_pfl join t_compte_cpt using (cpt_pseudo) where cpt_pseudo='".$pseudo."' AND cpt_psswd= md5('".$mdp."') ";
    $res=$mysqli->query($sql);
    //echo $sql;  echo "<br>";
    if ($res==false) {        // La requête a echoué
        echo "Error: Problème d'accès à la base \n";
        echo $sql;
        exit();
    }
    else
    {   if($res->num_rows==1){  //compte + mdp existe

            $data=$res->fetch_assoc();
            $pseudo=$data['cpt_pseudo'];
            $statut=$data['pfl_statut'];
            $validite=$data['pfl_validite'];

            if($validite=='A')
            {
                $problem=0;

                $_SESSION['pseudo']=$pseudo;
                $_SESSION['statut']=$data['pfl_statut'];

                $msg=1;

                //redirection
                if($_SESSION['statut']=='R')
                {
                    header("Location: ../redacteur/redacteur_accueil.php");
                }
                if($_SESSION['statut']=='G')
                {
                    header("Location: ../gestionnaire/gestionnaire_accueil.php");
                }
            }
            else
            {
                //echo "VOTRE COMPTE EST DESACTIVé <br>";
                $problem=1;
                $msg=-2;
            }
        }
        else
        {
            //echo "mot de passe ou login ne correspondes pas <br>";
            $msg=0;
            $problem=1;
        }
    }//$reqresult true
}
else //des champs vides
{
    //echo "il y a des champs manquants";
    $msg=-1;
    $problem=1;
}// fin de conditions de champs

if($problem==1)
{
    //affichage des msg d'erreur
    echo('<div style="margin-top:2rem;">');
		if( $msg==1 ) { //afficher msg succes
			echo('<div class="alert alert-success" role="alert">');
                echo('Bonjour : <?php echo $pseudo ?><br>');
                echo('Login et mot de passe sont correctes <br>');
            echo('</div>');
		}

		if( $msg==0 ) { //afficher msg error 1
			echo('<div class="alert alert-danger" role="alert">');
				echo('Mot de passe ou login ne correspond pas');
			echo('</div>');
		}

		if( $msg==-1 ) { //afficher msg error 2	
			echo('<div class="alert alert-danger" role="alert">');
				echo('il y a des champs manquants');
			echo('</div>');
        }
        if( $msg==-2 ) { //afficher msg error 2	
			echo('<div class="alert alert-danger" role="alert">');
				echo('VOTRE COMPTE EST DESACTIVé');
			echo('</div>');
		}
    echo('</div>');
    
    //reaffichage du formualire
    echo('<form class="form-signin" method="post" action="session_action.php">');
    echo('<img class="mb-4" src="../img/Samsung-logo" alt="" height="165">');
    echo('<h1 class="h3 mb-3 font-weight-normal">Sign in</h1>');
        echo('<label for="inputEmail" class="sr-only">Pseudo </label>');
                echo("<input type=\"texte\" id=\"inputEmail\" class=\"form-control\" placeholder=\"Pseudo \" value =\"$pseudo\" name=\"pseudo\" required autofocus>");
        echo('<label for="inputPassword" class="sr-only">Password</label>');
                echo('<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required>');
        echo('<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>');
        echo('<p class="mt-3 mb-3 text-muted">Pour l\'<strong><a href="inscription.php">inscription</strong></a></p>');
	echo('</form>');
}
?>


</body>

</html>
