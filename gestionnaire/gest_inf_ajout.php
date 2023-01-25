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
    <title>Ajout Informations</title>
    <meta charset="UTF-8">
	<meta data="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="icon" type="image/png" href="../img/favicon.ico"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body style="padding:0px;">

	<?php $page=3; ?>
    <?php require_once("../includes/navbar-gestionnaire.php"); ?>

    <main class="container" style="margin-top: 2%;">
    <!-- division insertion d'informations -->
    <div class="jumbotron col border border-dark" style="margin:1%;padding:2rem 3rem;background-color:#f8f8f8;">

    <?php if(isset($_SESSION['msg']))
    {
        //affichage des msg d'erreur
        echo('<div style="margin-bottom:2rem;">');
            if( $_SESSION['msg']==1 ) { //afficher msg succes
                echo('<div class="alert alert-success" role="alert">');
                    echo('Ajout avec success');
                echo('</div>');
            }

            if( $_SESSION['msg']==2 ) { //afficher msg error 1
                echo('<div class="alert alert-danger" role="alert">');
                    echo('Vous n\'avez pas l\'autorisation pour publiez une information dans cette categorie');
                echo('</div>');
            }
            if( $_SESSION['msg']==3 ) { //afficher msg error 2
                echo('<div class="alert alert-danger" role="alert">');
                    echo('IL y a des champs manquantes');
                echo('</div>');
        }
        echo('</div>');
        unset($_SESSION['msg']);
    } 
    ?>

        <h3 style="margin-bottom: 6%;">Ajout Informations :</h3>
        <form method="post" action="ajout_inf_action.php">
        <fieldset>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold">Information Text : </label>
                <div class="col-sm-7 ">
                <textarea class="form-control" aria-label="With textarea" name="texte" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold">Etat :</label>
                <div class="col-sm-7 ">
                    <select class="custom-select" id="inputGroupSelect01" name="etat" required>
                        <option selected value="C">C</option>
                        <option value="L">L</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold">Categorie :</label>
                <div class="col-sm-7 ">
                    <select class="custom-select" id="inputGroupSelect01" name="cat" required>
                        <option selected value="">--- Selectionnez Une categorie ---</option>
                        <?php while($cat=$query->fetch_assoc()){ ?>
                        <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_intitule'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="ajouter" value="Ajouter">
        </fieldset>
        </form>
    </div>
    </main>
    
</body>

<?php $mysqli->close() ?>