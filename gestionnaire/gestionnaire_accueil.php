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

$pseudo=$_SESSION['pseudo'];	//requperation de pseudo

$sql="SELECT * from t_profil_pfl join t_compte_cpt using(cpt_pseudo) where cpt_pseudo='".$pseudo."'";
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
		<div class="jumbotron border border-success" style="text-align:center;padding: 2% 4%;background-color:#f8f8f8;">
			<h2>Bonjour : <span style="text-transform:uppercase;"><?php echo $data['pfl_nom']."  ".$data['pfl_prenom']; ?></span></h2>
		</div>
		<!-- division informations personnelles -->
		<div class="jumbotron col border border-dark" style="padding:2rem 3rem;background-color:#f8f8f8;">
			<h3 style="margin-bottom: 6%;">Informations Peronnelles :</h3>
			<form>
			<fieldset disabled>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Nom :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly style="text-transform: uppercase;" class="form-control" value="<?php echo $data['pfl_nom'] ?>" disbled></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Prenom :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly style="text-transform: uppercase;" class="form-control" value="<?php echo $data['pfl_prenom'] ?>" disbled></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Statut :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly class="form-control" value="<?php if($data['pfl_statut']=='R')
							{echo 'Redacteur';}else{echo 'Gestionaire';}?>" disbled>
						</input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Pseudo :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly class="form-control" value="<?php echo $data['cpt_pseudo'] ?>" disbled></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Email :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly class="form-control" value="<?php echo $data['pfl_mail'] ?>" disbled></input>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label font-weight-bold">Inscrit le :</label>
					<div class="col-sm-7 ">
						<input type="text" readonly class="form-control" value="<?php echo $data['pfl_date'] ?>" disbled></input>
					</div>
				</div>
			</fieldset>
			</form>
		</div>
	</main>
</body>
</html>
