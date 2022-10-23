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
    
<div class="card" style="width: 90%;margin-top:2%;">
    <?php
        if(isset($_GET['indice']))
        {
            //echo ("Valeur de indice : ");echo ($_GET['indice']);     echo ("<br />");
            $numero=$_GET['indice'];    //recuperation de l'indice
            $req1 = "SELECT * from t_categorie_cat";    //requete pour la categorie
            //echo $req1;echo ("<br />");
            
            $result1=$mysqli->query($req1);
            if($result1==false)
            {
                echo "Error: La requête a échoué \n";
                echo "Query: " . $req1 . "\n";
                echo "Errno: " . $mysqli->errno . "\n";
                echo "Error: " . $mysqli->error . "\n";
                exit;
            }
            else
            {
                $nbcat=$result1->num_rows;  //nombre de categorie 
                //echo "nbcat  : ";echo $nbcat;echo ("<br />");
                if($nbcat>0)
                {
                    for ($i=0;$i<$nbcat;$i++)   //stockge des ID des categorie dans le tableau $id[]
                    {
                        //echo $i;  echo ("<br />");
                        $cat=$result1->fetch_assoc();   //récupération d’une ligne de résultat1 de categorie
                        $id[$i]=$cat['cat_id'];         //affectation de l’ID d'un categorie dans une case du tableau
                        //echo ($id[$i]);   echo ("<br />");
                    }
                    
                        $req3="SELECT cat_intitule from t_categorie_cat where cat_id=".$id[$numero]."";  //nom du categorie a partir de son id
                        //echo $req3;echo ("<br />");
                        $result3=$mysqli->query($req3);
                        $intitule=$result3->fetch_assoc();  //recuperation de cat_intitule pour chaque categorie

                        if($result3==false)
                        {
                            echo "Error: La requête a échoué \n";
                            echo "Query: " . $req3 . "\n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit;
                        }
                        else
                        {
                            $req2="SELECT * from t_information_inf join t_categorie_cat using(cat_id) where cat_id='".$id[$numero]."' and inf_etat='L' ORDER by inf_id desc limit 5 ;";     //requperation des informations
                            //echo $req2; echo ("<br />");
                            $result2=$mysqli->query($req2);
                            $nbinf=$result2->num_rows;  //nombre d'informations...

                            if($result2==false)
                            {
                                echo "Error: La requête a échoué \n";
                                echo "Query: " . $req2 . "\n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                exit;
                            }
                            else
                            {
                                if($_GET['indice']+1<$nbcat)    //si le prochain indice = ou superieur au nombre de categorie
                                {   $numero=$_GET['indice']+1;
                                    header("refresh:5;url=affichagecategorie.php?indice=".$numero."");  //pour le deroulement des pages
                                }
                                else
                                {   $numero=0;
                                    header("refresh:5;url=affichagevisuel.php");  //pour le deroulement des pages
                                }

                                //echo "indice prochain : "; echo $numero;

                                if($nbinf==0)
                                {
                                    ?>
                                    <div class="card-header" style="font-size: 30px;">
                                        <?php echo $intitule["cat_intitule"] ?>
                                    </div>
                                    <div class="card-body" style="font-size: 27px;">
                                        <blockquote class="blockquote mb-0">
                                            <h4>Aucune Information</h4>
                                            <p>Aucune Information</p>
                                        </blockquote>
                                    </div>
                                    <?php
                                }
                                else
                                {   ?>
                                    <div class="card-header" style="font-size: 30px;">
                                        <?php echo $intitule["cat_intitule"] ?>
                                    </div>

                                    <div class="card-body" >
                                    <?php
                                        while($inf=$result2->fetch_assoc()) //recuperation d'une ligne d'information
                                        {
                                            //printf("%s,  %s.\n",$inf['inf_texte'],$inf['cat_id']);
                                            //echo "<br>";
                                    ?>

                                        <blockquote class="blockquote mb-0" style="font-size: 27px;">    
                                            <p><?php echo $inf["inf_texte"] ?></p>
                                            <footer class="blockquote-footer">
                                                Publié par : <cite><?php echo $inf["cpt_pseudo"] ?></cite>
                                                le <?php echo $inf["inf_date_ajout"] ?> 
                                            </footer>
                                            <hr>
                                        </blockquote>

                                    <?php
                                        }       // fin de recuperation d'un ligne d'information
                                    ?>

                                    </div>
                                    <?php
                                }//nb d'information
                            }// error de req2
                        }//error de req3
                }
                else    //else nbcat;
                {   ?>
                    <div class="card-header" style="font-size: 30px;">
                       Pas de Catégorie :
                    </div>
                    <div class="card-body" style="font-size: 27px;">
                        <blockquote class="blockquote mb-0">
                            <h4>Aucune Information</h4>
                            <p>Aucune Information</p>
                        </blockquote>
                    </div>
           <?php     }
            }//error de req1
        }
        else
        {
            echo ("Vous avez oublié le paramètre !");
            exit();          
        }//cond indice                    
        ?>

        <?php $mysqli->close(); ?>
    </div>
</div>            

</body>
</html>