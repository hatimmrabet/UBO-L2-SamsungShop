<?php
session_start();

//verification du statut de l'utilisateur et du profil s'il est connecté ou pas
if (!isset($_SESSION['pseudo']) || $_SESSION['statut'] != 'R') {
    //Si la session n'est pas ouverte, redirection vers la page du formulaire
    header("Location:../login/session.php");
    exit();
}

//connection a la base de donnee
require_once("../includes/BDD.php");


//recuperation de tous les Categorie
$sql = "SELECT * from t_visuel_vis order by vis_id desc";
$res = $mysqli->query($sql);
//echo $sql;

if ($res == false) {        // La requête a echoué
    echo "Error: Problème de requete \n";
    echo $sql;
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Visuels</title>
    <meta charset="UTF-8">
    <meta data="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../img/favicon.ico" />
    <link rel="stylesheet" href="../css/gestionnaire.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body style="padding:0px;">
    <?php $page = 4; ?>
    <?php require_once("../includes/navbar-redacteur.php"); ?>

    <div class="table-responsive-lg ">
        <table class="table table-light table-hover table-responsive-md">
            <thead class="thead-light">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Descriptif</th>
                    <th scope="col">Nom du fichier</th>
                    <th scope="col">Date</th>
                    <th style="text-align: center;" scope="col">Visibilité</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = $res->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo ($data['vis_id']) ?></th>
                        <td><?php echo ($data['vis_descriptif']) ?></td>
                        <td> <?php echo ($data['vis_nom_fichier']) ?></td>
                        <td><?php echo ($data['vis_date_ajout']) ?></td>
                        <td style="text-align: center;"><?php echo ($data['vis_visibilite']) ?></td>
                        <td style="text-align: center;"><a href="red_edit_vis.php?edit=<?php echo $data['vis_id']; ?>" class="btn btn-primary btn-sm">Modifier</a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <hr>


    <div class="row justify-content-center my-4 mx-auto" style="width:80%;padding: 2%;background-color: #e9ecef45;background-clip: border-box;border: 2px solid rgba(0,0,0,.125);border-radius: .55rem;">
        <form method="post" action="red_vis_action.php" enctype="multipart/form-data" class="form-group mx-auto" style="width: 60%;margin:auto;">
            <?php
            //affichage des msg d'erreur
            if (isset($_SESSION['msg'])) {
                echo ('<div style="margin-bottom: 1rem;">');
                if ($_SESSION['msg'] == 3) {  //afficher msg success 1
                    echo ('<div class="alert alert-success" role="alert">');
                    echo ('Visuel Ajouté <br>');
                    echo ('</div>');
                }
                if ($_SESSION['msg'] == 4) { //afficher msg danger 2
                    echo ('<div class="alert alert-danger" role="alert">');
                    echo ('ERREUR : Ajout annulé');
                    echo ('</div>');
                }
                if ($_SESSION['msg'] == 6) { //afficher msg danger 2
                    echo ('<div class="alert alert-danger" role="alert">');
                    echo ('ERREUR : l\'image utilisé existe déja');
                    echo ('</div>');
                }
                echo ('</div>');
            }
            ?>
            <fieldset>
                <h5>Ajoutez un visuel : </h5>
                <div class="mb-3">
                    <label>Entrer un descriptif :</label>
                    <input type="texte" class="form-control" placeholder="Descriptif " name="desc" required>
                </div>
                <div class="mb-3">
                    <label>Upload Visuel :</label>
                    <div class="mb-3">
                        <input type="file" accept="image/png, image/jpeg" name="vis_image" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Selectionnez Visibilité :</label><br>
                    <select class="custom-select col-3" id="inputGroupSelect01" name="visi" required>
                        <option selected value="C">Caché</option>
                        <option value="L">En ligne</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Entez la Date :</label>
                    <input type="date" class="form-control" style="width: 40%;" name="thedate" required value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="row" style="margin-right:0px; margin-left:0px;">
                    <input class="btn btn-lg btn-danger btn-block mt-3 col" style="width: 40%;margin-right: 13%;" type="reset" name="annuler" value="Annuler">
                    <input class="btn btn-lg btn-primary btn-block mt-3 col" style="width: 40%;" type="submit" name="ajouter" value="Ajouter">
                </div>
            </fieldset>
        </form>

        <form class="form-group mx-auto" style="width: 25%;margin:auto;" method="post" action="red_vis_action.php">
            <?php
            //affichage des msg d'erreur
            if (isset($_SESSION['msg'])) {
                echo ('<div style="margin-bottom: 1rem;">');
                if ($_SESSION['msg'] == 1) {  //afficher msg success 1
                    echo ('<div class="alert alert-success" role="alert">');
                    echo ('visuel supprimé <br>');
                    echo ('</div>');
                }
                if ($_SESSION['msg'] == 2) { //afficher msg success 2
                    echo ('<div class="alert alert-danger" role="alert">');
                    echo ('N° de visuel incorrect');
                    echo ('</div>');
                }
                if ($_SESSION['msg'] == 5) { //afficher msg success 2
                    echo ('<div class="alert alert-danger" role="alert">');
                    echo ('Vous n\'avez pas le droit de supprimer cette visuel');
                    echo ('</div>');
                }
                echo ('</div>');
                unset($_SESSION['msg']);    //toujours dans la derniere condition -- pour ne pas l'afficher apres
            }
            ?>
            <fieldset>
                <h5>Supprimer un Visuel : </h5>
                <label>Entrer le N° :</label>
                <input type="texte" class="form-control" placeholder="N° " name="id" required>
                <input class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="supprimer" value="Supprimer">
            </fieldset>
        </form>
    </div>

</body>

</html>