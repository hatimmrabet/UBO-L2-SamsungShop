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


//recuperation des données de la catégorie
$sql="SELECT * from t_categorie_cat where cat_id='".$_GET['edit']."';";  
$query=$mysqli->query($sql);
$cat=$query->fetch_assoc();
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
    <title>Modification de Catégorie</title>
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
	<?php $page=4; ?>
    <?php require_once("../includes/navbar-gestionnaire.php"); ?>

    <div class="row justify-content-center mx-auto" style="width:80%;margin-top:3%;padding:3%;background-color: #e9ecef45;background-clip: border-box;border: 2px solid rgba(0,0,0,.125);border-radius: .55rem;">
    <form  class="form-group mx-auto" style="width: 60%;margin:auto;" method="post" action="gest_cat_action.php?edit=<?php echo $_GET['edit'] ?>">
        <?php
            //affichage des msg d'erreur
            if(isset($_SESSION['msg'])){
            echo('<div style="margin-bottom: 1rem;">');
                if($_SESSION['msg']==1){  //afficher msg success 1
                echo('<div class="alert alert-success" role="alert">');
                    echo('Catégorie Modifié <br>');
                echo('</div>');
                }
                unset($_SESSION['msg']);
            echo('</div>');
            }
        ?>
        <fieldset>
        <h5>Modifier la catégorie : </h5>
        <div class="mb-3">
            <label >Entrer le nom du catégorie :</label>
            <input type="texte" class="form-control" placeholder="Intitulé " name="intitulé" Value="<?php echo $cat['cat_intitule'] ?>" required autofocus>
        </div>
        <div class="mb-3">
            <label >Selectionnez l'autorisation :</label><br>
                <select class="custom-select col-1" id="inputGroupSelect01" name="aut" required>
                    <option selected Value="<?php echo $cat['cat_autorisation'] ?>"><?php echo $cat['cat_autorisation'] ?></option>
                    <?php if( $cat['cat_autorisation']=='R'){ ?>
                        <option value="G">G</option>
                    <?php }else{ ?>
                        <option value="R">R</option>
                    <?php } ?>
                </select>
        </div>
        <div class="mb-3">
            <label >Entez la Date :</label>
            <input type="date" class="form-control" style="width: 40%;" name="thedate" autofocus value="<?php echo $cat['cat_date'] ?>">
        </div>
        <div class="row" style="margin-right:0px; margin-left:0px;">
            <input class="btn btn-lg btn-danger btn-block mt-3 col" style="width: 40%;margin-right: 13%;" type="reset" name="annuler" value="Annuler">
            <input class="btn btn-lg btn-primary btn-block mt-3 col" style="width: 40%;" type="submit" name="modifier" value="Modifier">
        </div>
        </fieldset>
        </div>
        </fieldset>
    </form>
    </div>

</body>

<?php $mysqli->close(); ?>