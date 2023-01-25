<?php
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
  //CONNECTION
	$msg=-2;	
	if($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if( $_POST['pseudo'] AND $_POST['mdp'] ){ //les 2 champs sont remplies

			$pseudo=htmlspecialchars(addslashes(($_POST['pseudo'])));
			$mdp=htmlspecialchars(addslashes(($_POST['mdp'])));
			
			//echo $pseudo; echo "<br>"; echo md5($mdp);

			$reqconnect="SELECT * FROM t_compte_cpt WHERE cpt_pseudo='".$pseudo."' AND cpt_psswd= md5('".$mdp."') ";
			$reqresult=$mysqli->query($reqconnect);
			$exist=$reqresult->num_rows ;
			//echo $reqconnect;
			//echo $exist;

			if($exist==1){  //compte + mdp existe
				$result=$reqresult->fetch_assoc();
				$msg=1;
				//header("Location: ../index.php?pseudo=".$_SESSION['cpt_pseudo']);
			}
			else //probleme de mot de passe et de login
			{
				//echo "mot de passe ou login ne correspondes pas <br>";
				$msg=0;
			}
		}
		else //des champs vides
		{
			//echo "il y a des champs manquants";
			$msg=-1;
		}// fin de conditions de champs
	}//end if
?>


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


	<div style="margin-top:2rem;">

		<?php if( $msg==1 ) { //afficher msg succes	?>
			<div class="alert alert-success" role="alert">
				Bonjour : <?php echo $pseudo ?><br>
				Login et mot de passe sont correctes <br>
			</div>
		<?php } ?>

		<?php if( $msg==0 ) { //afficher msg error 1	?>
			<div class="alert alert-danger" role="alert">
				Mot de passe ou login ne correspond pas
			</div>
		<?php } ?>

		<?php if( $msg==-1 ) { //afficher msg error 2	?>
			<div class="alert alert-danger" role="alert">
				il y a des champs manquants
			</div>
		<?php } ?>

	</div>

	<form class="form-signin" method="post" action="">
	  <img class="mb-4" src="../img/Samsung-logo" alt="" height="165">
		<h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
		<label for="inputEmail" class="sr-only">Pseudo </label>
				<input type="texte" id="inputEmail" class="form-control" placeholder="Pseudo " name="pseudo" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<p class="mt-3 mb-3 text-muted">Pour l'<strong><a href="inscription.php">inscription</strong></a></p>
	</form>

	<?php $mysqli->close() //fermer la connexion ?>
</body>

</html>