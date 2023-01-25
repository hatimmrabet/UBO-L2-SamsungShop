<?php
session_start();

//verification du statut de l'utilisateur et du profil s'il est connecté ou pas
if(!isset($_SESSION['pseudo']) || $_SESSION['statut']!='G') 
{
//Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:../login/session.php");
exit();
}

require_once("../includes/BDD.php");


//requete pour affichage inf + categories
$sql="SELECT * from t_categorie_cat left join t_information_inf using(cat_id) order by inf_id desc";
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
    <title>Informations</title>
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

        <div class="table-responsive">
        <?php
            //affichage des msg d'erreur
            if(isset($_SESSION['msgDelete'])){
            echo('<div class="mx-auto" style="margin: 1rem;width:24%;text-align: center;">');
                if($_SESSION['msgDelete']==1){  //afficher msg success 1
                echo('<div class="alert alert-success" role="alert">');
                    echo('Information Supprimée <br>');
                echo('</div>');
                }
                if($_SESSION['msgDelete']==2){  //afficher msg error
                echo('<div class="alert alert-danger" role="alert">');
                    echo('Catégorie Vide <br>');
                echo('</div>');
                }
            echo('</div>');
            unset($_SESSION['msgDelete']);
            }
        ?>
            <table class="table table-light table-hover ">
                <thead class="thead-light">
                    <tr>
                    <th scope="col" style="width:15%;">Categorie</th>
                    <th scope="col">Information</th>
                    <th scope="col">Autorisation</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col" style="width:7rem;">Date</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($data=$query->fetch_assoc()) {?>
                    <tr>
                    <th scope="row"><?php echo ($data['cat_intitule']) ?></th>
                    <td><?php echo ($data['inf_texte']) ?></td>
                    <td style="text-align: center;"><?php echo ($data['cat_autorisation']) ?></td>
                    <td style="text-align: center;"><?php echo ($data['inf_etat']) ?></td>
                    <td><?php echo ($data['cpt_pseudo']) ?></td>
                    <td><?php echo ($data['inf_date_ajout']) ?></td>
                    <td><a href="gest_edit_inf.php?edit=<?php echo $data['inf_id']; ?>" class="btn btn-primary btn-sm" >Modifier</a></td>

                    <td><a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $data['inf_id']; ?>">Supprimer</a></td>


                    <div class="modal fade" id="delete<?php echo $data['inf_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Supprimer l'information</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <div class="modal-body">Voulez vous supprimer cette information.</div>
                            <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <a class="btn btn-danger" href="gest_delete_inf.php?delete=<?php echo $data['inf_id']; ?>">Supprimer</a>
                            </div>
                        </div>
                        </div>
                    </div>


                    </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
</body>








