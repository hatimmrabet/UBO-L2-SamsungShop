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



//recuperation de tous les comptes + profiles 
$sql="SELECT * from t_profil_pfl join t_compte_cpt using(cpt_pseudo) order by pfl_date desc";  
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
                    <th colspan="8" style="height: 20px;">
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
                            Nombre de comptes : <?php echo ($row[0]); ?>
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
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
                        
        <div class="edit">
            <?php
                //affichage des msg d'erreur
                if(isset($_SESSION['msg'])){
                echo('<div style="margin-bottom: 1rem;">');
                if($_SESSION['msg']==0){  //afficher msg danger 0
                    echo('<div class="alert alert-danger" role="alert">');
                        echo('Vous ne pouvez pas changez la validité de votre Compte');
                    echo('</div>');
                    }
                    if($_SESSION['msg']==1){  //afficher msg success 1
                    echo('<div class="alert alert-success" role="alert">');
                        echo('Compte activé <br>');
                    echo('</div>');
                    }
                    if($_SESSION['msg']==2 ) { //afficher msg success 2
                        echo('<div class="alert alert-success" role="alert">');
                            echo('Compte désactivé');
                        echo('</div>');
                    }
                    if($_SESSION['msg']==3 ) { //afficher msg error 2
                        echo('<div class="alert alert-danger" role="alert">');
                            echo('Pseudo introuvable');
                        echo('</div>');
                    }
                echo('</div>');
                unset($_SESSION['msg']);
                }
            ?>
            <form  class="form-group" method="post" action="comptes_action.php">
                <fieldset>
                <h5>Activer/désactiver</h5><br>
                <p>Selectionnez un compte désactivé pour l'activé et Vice versa</p>
                    <label style="text-transform: uppercase;font-weight:bold;">Entrer le PSEUDO :</label>
                    <input type="texte"class="form-control" placeholder="Pseudo " name="pseudo" required autofocus>
                    <input class="btn btn-primary btn-block mt-3" type="submit" name="modifier" value="Modifier">
                </fieldset>
            </form>
            <hr>
            <form  class="form-group" method="post" action="comptes_action.php">
            <?php
                //affichage des msg d'erreur
                if(isset($_SESSION['msgDel'])){
                echo('<div style="margin-bottom: 1rem;">');
                    if($_SESSION['msgDel']==0){  //afficher msgDel succes 0
                    echo('<div class="alert alert-success" role="alert">');
                        echo('Compte Supprimé');
                    echo('</div>');
                    }
                    if($_SESSION['msgDel']==1){  //afficher msgDel danger 0
                    echo('<div class="alert alert-danger" role="alert">');
                        echo('Ce pseudo n\'existe pas');
                    echo('</div>');
                    }
                echo('</div>');
                unset($_SESSION['msgDel']);
                }
            ?>
                <fieldset>
                <h5>Supprimer un compte</h5><br>
                <p>Selectionnez un compte pour le supprimer :</p>
                    <label style="text-transform: uppercase;font-weight:bold;">Entrer le PSEUDO :</label>
                    <input type="texte"class="form-control" placeholder="Pseudo " name="pseudo" required autofocus>
                    <input class="btn btn-danger btn-block mt-3" type="submit" name="supprimer" value="Supprimer">
                </fieldset>
            </form>
        </div>
        

    </div>


</body>
<?php $mysqli->close(); ?>