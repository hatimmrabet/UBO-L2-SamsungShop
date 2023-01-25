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

$sql="SELECT * from t_profil_pfl join t_compte_cpt using(cpt_pseudo) order by pfl_date desc";  //recuperation de tous les comptes + profiles 
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
    <title>Accueil Gestionnaire</title>
    <meta charset="UTF-8">
	<meta data="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="icon" type="image/png" href="../img/favicon.ico"/>
	<link rel="stylesheet" href="../css/gestionnaire.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body style="padding:0px;">
	<?php $page=1; ?>
    <?php require_once("../includes/navbar-gestionnaire.php"); ?>

    <div class="pere">
        <div class="table-responsive-lg table1">
            <table class="table table-light table-hover table-responsive-md">
                <thead class="thead-light">
                    <tr>
                    <th colspan="8">
                        <?php
                                /*********************      1ere methode        ******************
                            $query1="SELECT count(cpt_pseudo) as Nombre from t_compte_cpt join t_profil_pfl using (cpt_pseudo)";
                            //echo $query1;

                            if ($result = $mysqli->query($query1)) {
                                while ($obj = $result->fetch_object()) {
                                // printf ("%s \n", $obj->Nombre);

                            ?>
                            <p>Nombre de comptes : <?php echo ($obj->Nombre); ?></p>
                            <?php }
                            }else{echo "error";} */
                        ?>
                        <?php
                                /*********************      2emess methode        ****************** */
                            $query1="SELECT count(cpt_pseudo) as Nombre from t_compte_cpt join t_profil_pfl using (cpt_pseudo)";
                            //echo $query1;

                            if ($result = $mysqli->query($query1)) {
                                while ($row = $result->fetch_row()) {
                                // printf ("%s \n", $row[0]);
                            ?>
                            <p>Nombre de comptes : <?php echo ($row[0]); ?></p>
                            <?php }
                            }else{echo "error";}
                        ?>
                    </th>
                    </tr>
                    <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Validité</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($data=$query->fetch_assoc()) {?>
                    <tr>
                    <th scope="row"><?php echo ($data['cpt_pseudo']) ?></th>
                    <td><?php echo ($data['pfl_nom']) ?></td>
                    <td><?php echo ($data['pfl_prenom']) ?></td>
                    <td><?php echo ($data['pfl_mail']) ?></td>
                    <td><?php if($data['pfl_statut']=='R'){echo 'Redacteur';}else{echo 'Gestionnaire';} ?></td>
                    <td><?php echo ($data['pfl_validite']) ?></td>
                    <td><?php echo ($data['pfl_date']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="edit">
            <form  class="form-signin" method="post" action="comptes_gestionnaire.php">
                <fieldset>
                    <label>Entrer le PSEUDO :</label>
                    <input type="texte"class="form-control" placeholder="Pseudo " name="pseudo" required autofocus>
                    <input class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="modifier2" value="Modifier">
                    <?php if(isset($_POST['modifier2'])){echo "modifier";} ?>
                </fieldset>
            </form>
        </div>

    </div>


</body>