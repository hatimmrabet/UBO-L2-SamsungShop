<?php
    $mysqli = new mysqli('localhost','zm_rabeha','Hatimtim123','zfl2-zm_rabeha');//ouvrir conx

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
        printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catégorie</title>

    <link rel="icon" type="image/png" href="../img/favicon.ico"/>
    <link rel="stylesheet" href="../css/login.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light" style="padding-top:0px;">
    <?php $accueil=3; ?>

    <?php require_once("../includes/navbar-cat.php"); ?>
    <?php
        $sql="SELECT * from t_visuel_vis  order by vis_id desc limit 9";
        $res=$mysqli->query($sql);
        //echo $sql;

        header("refresh:5;url=affichagecategorie.php?indice=0");  //pour le deroulement des pages
        
        if($res==false)
        {
            echo "Error: La requête a échoué \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
        }
        else
        {   $nbvis=$res->num_rows;
            ?>
        <div class="container">
            <div class="row justify-content-center">
            <?php
            for($j=1;$j<=$nbvis;$j++){ // nombre de photo TOTAL
                $vis=$res->fetch_assoc();
            ?>
                <div class="card" style="width: 18rem;margin: 1rem;">
                    <img src="../img/<?php echo $vis['vis_nom_fichier'] ?>" class="card-img-top" alt="..." style="width:100%;">
                    <div class="card-body">
                        <p class="card-text"><?php echo $vis['vis_descriptif'] ?></p>
                    </div>
                </div>
            <?php }     //nombre de photo par ligne ?>
            </div>  <!-- Balise pour row chaque ligne-->
    <?php   }     //nombre de ligne ?>
        </div>
    <?php $mysqli->close(); ?>
</div>            

</body>
</html>