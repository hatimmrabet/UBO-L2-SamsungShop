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


$sql="SELECT * from t_profil_pfl join t_compte_cpt using(cpt_pseudo) where cpt_pseudo='".$_SESSION['pseudo']."'";
$query=$mysqli->query($sql);
$data=$query->fetch_assoc();
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
    <title>Accueil Gestionnaire</title>
    <meta charset="UTF-8">
	<meta data="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="icon" type="image/png" href="../img/favicon.ico"/>
	<link rel="stylesheet" href="../css/login.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body style="padding:0px;">
	<?php $page=0; ?>
	<?php require_once("../includes/navbar-gestionnaire.php"); ?>
	
    <main class="container" style="margin-top: 2%;">
    <!-- division informations personnelles -->
        <div class="jumbotron col border border-dark" style="padding:2rem 3rem;background-color:#f8f8f8;">
        <?php
            //affichage des msg d'erreur modification du Compte
            if(isset($_SESSION['msgEdit'])){
            echo('<div style="margin-bottom: 1rem;">');
                if($_SESSION['msgEdit']==0){  //afficher msgEdit error
                echo('<div class="alert alert-danger" role="alert">');
                    echo('l\'adresse mail choisie est deja utilisé');
                echo('</div>');
                }
                if($_SESSION['msgEdit']==1){  //afficher msgEdit success
                echo('<div class="alert alert-success" role="alert">');
                    echo('Profile Modifié <br>');
                echo('</div>');
                }
            echo('</div>');
            unset($_SESSION['msgEdit']);
			}
			
			if(isset($_SESSION['msgMdp'])){
				echo('<div style="margin-bottom: 1rem;">');
					if($_SESSION['msgMdp']==2){  //afficher msgMdp error
					echo('<div class="alert alert-danger" role="alert">');
						echo('les deux mots de passes sont différents');
					echo('</div>');
					}
					if($_SESSION['msgMdp']==1){  //afficher msgMdp success
					echo('<div class="alert alert-success" role="alert">');
						echo('Changement de mot de passe est réussi');
					echo('</div>');
					}
					if($_SESSION['msgMdp']==3){  //afficher msgMdp danger
						echo('<div class="alert alert-danger" role="alert">');
							echo('Il faut confirmer nouveau votre mot de passe');
						echo('</div>');
					}
				echo('</div>');
				unset($_SESSION['msgMdp']);
				}
        ?>
			<h3 style="margin-bottom: 6%;">Modifier les informations Peronnelles :</h3>

			<form method="POST" action="gest_infpers_action.php">
			<fieldset >
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Nom :</label>
					<div class="col-sm-7 ">
						<input type="text" style="text-transform: uppercase;" class="form-control" name="nomEdit" value="<?php echo $data['pfl_nom'] ?>" ></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Prenom :</label>
					<div class="col-sm-7 ">
						<input type="text" style="text-transform: uppercase;" class="form-control" name="prenomEdit" value="<?php echo $data['pfl_prenom'] ?>" ></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Statut :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly class="form-control" value="<?php if($data['pfl_statut']=='R')
							{echo 'Redacteur';}else{echo 'Gestionnaire';}?>" >
						</input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Pseudo :</label>
					<div class="col-sm-7 " >
						<input type="text" class="form-control" readonly value="<?php echo $data['cpt_pseudo'] ?>" ></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Email :</label>
					<div class="col-sm-7 ">
						<input type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="mailEdit" value="<?php echo $data['pfl_mail'] ?>" ></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Inscrit le :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly class="form-control" value="<?php echo $data['pfl_date'] ?>" ></input>
					</div>
				</div>
				<hr>
				<div class="form-group row " >
					<label class="col-sm-4 col-form-label font-weight-bold">Entrer le Nouveau mot de passe :</label>
					<div class="col-sm-7 ">
						<input type="password"  class="form-control" minlength="5" placeholder="Entrer Mot de passe" name="mdp1"></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Confirmer le Nouveau mot de passe :</label>
					<div class="col-sm-7 ">
						<input type="password"  class="form-control" minlength="5" placeholder="Confimer mot de passe" name="mdp2"></input>
					</div>
				</div>
			</fieldset>
			<hr>
            <div class="row mx-auto justify-content-center" style="margin-right:0px; margin-left:0px;">
                <input class="btn btn-danger mx-3 col-3" style="width: 30%;" type="reset" name="annuler" value="Annuler">
                <input class="btn btn-primary mx-3 col-3" style="width: 30%;" type="submit" name="save" value="Enregistrer">
            </div>
			</form>
        </div>
    </main>
        
</body>
</html>
<?php $mysqli->close(); ?>