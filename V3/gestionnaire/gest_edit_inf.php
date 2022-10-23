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


//requete pour affichage inf + categorie d'id $_GET
$sqlInf="SELECT * from t_categorie_cat left join t_information_inf using(cat_id) where inf_id=".$_GET['edit'].";";
$resInf=$mysqli->query($sqlInf);
$infData=$resInf->fetch_assoc();
//echo $sqlInf;

if ($resInf==false) {        // La requête a echoué
	echo "Error: Problème de requete \n";
	echo $sqlInf;
	exit();
}

//requete pourcategorie differet de celle selectionner
$sqlCat="SELECT distinct cat_id ,cat_intitule from t_categorie_cat join t_information_inf using(cat_id) where cat_id != ".$infData['cat_id'].";";
$resCat=$mysqli->query($sqlCat);
//echo $sqlCat;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier informations</title>
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

    <?php if(isset($_SESSION['msgEdit']))
    {
        //affichage des msg d'erreur
        echo('<div style="margin-bottom:2rem;">');
            if( $_SESSION['msgEdit']==1 ) { //afficher msg succes
                echo('<div class="alert alert-success" role="alert">');
                    echo('Modification avec success');
                echo('</div>');
            }
        echo('</div>');
        unset($_SESSION['msgEdit']);
    } 
    ?>

        <h3 style="margin-bottom: 6%;">Modifier Informations :</h3>
        <form method="post" action="gest_inf_action.php?edit=<?php echo $infData['inf_id']; ?>">
        <fieldset>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold">Information Text : </label>
                <div class="col-sm-7 ">
                <textarea class="form-control" aria-label="With textarea" name="texteEdit" required><?php echo $infData['inf_texte'] ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold">Etat :</label>
                <div class="col-sm-7 ">
                    <select class="custom-select" id="inputGroupSelect01" name="etatEdit" required>
                        <option selected value="<?php echo $infData['inf_etat'] ?>"><?php echo $infData['inf_etat'] ?></option>
                        <?php if($infData['inf_etat']=='C'){ ?>
                            <option value="L">L</option>
                        <?php }else{?>
                            <option value="C">C</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold">Categorie :</label>
                <div class="col-sm-7 ">
                    <select class="custom-select" id="inputGroupSelect01" name="catEdit" required>
                        <option selected value="<?php echo $infData['cat_id'] ?>"><?php echo $infData['cat_intitule'] ?></option>
                        <?php while($cat=$resCat->fetch_assoc()){ ?>
                        <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_intitule'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <hr>
            <input class="btn btn-primary col-4" style="margin-left: 30%;" type="submit" name="save" value="Enregistrer">
        </fieldset>
        </form>
    </div>
    </main>
    
</body>

<?php $mysqli->close() ?>