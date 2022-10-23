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


//requete pour les categories
$sql="SELECT cat_id, cat_intitule from t_categorie_cat ";
$query=$mysqli->query($sql);
//echo $sql;

if ($query==false) {        // La requête a echoué
	echo "Error: Problème de requete \n";
	echo $sql;
	exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajout de comptes</title>
    <meta charset="UTF-8">
	<meta data="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="icon" type="image/png" href="../img/favicon.ico"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>


<body class="bg-light" style="padding-top:0px;">

	<?php $page=1; ?>
    <?php require_once("../includes/navbar-gestionnaire.php"); ?>

    <div class="container" style="margin-top: 4rem;">
        <div class="py-3 text-center">
        <h2>Ajouter un compte </h2>
    </div>
    <div class="col-md-8 order-md-1" style=" margin: auto;">

    <form class="needs-validation" action="gest_insc_action.php" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nom</label>
                <input name="nom" type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">Valid last name is required.</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Prenom</label>
                <input name="prenom" type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">Valid First name is required.</div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Pseudo </label>
          <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                <input name="pseudo" type="text" class="form-control" id="username" placeholder="Username" required maxlength="60">
            <div class="invalid-feedback" style="width: 100%;">Your username is required.</div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email </label>
                <input name="mail" type="email" class="form-control"  pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}$"
                    placeholder="you@example.com" required>
          <div class="invalid-feedback">Please enter a valid email address.</div>
        </div>
        <div class="row">
        <div class="col-md-6 mb-3">
            <label for="mdp1">Mot de passe </label>
                <input name="mdp1" type="password" class="form-control"  placeholder="********" minlength="5" required>
            <div class="invalid-feedback">Please enter a valid password .</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="mdp2">Confirmation de Mot de passe </label>
                <input name="mdp2" type="password" class="form-control"  placeholder="********" minlength="5" required>
            <div class="invalid-feedback">Please enter a valid password .</div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Enregister</button>
    </form>
    </div>
</body>
    