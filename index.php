<?php
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
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Samsung</title>
        <link rel="icon" type="image/png" href="img/favicon.ico"/>

     <!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
-->  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800,600,300,300italic,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
        <link href="css/materialize.css" rel="stylesheet">
        <link href="css/magnific-popup.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mdb.min.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">
    </head>

    <body >
       <div class='preloader'><div class='loaded'>&nbsp;</div></div>    
       <?php $accueil=0; ?>

       <?php require_once("includes/header.php"); ?>

        <div id="home" class="slider">
            <ul class="slides">
                <li>
                    <img src="img/fold.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <div class="single_home">
                            <h1>Galaxy Fold</h1>
                            <p> Le Galaxy Fold est né à partir d'un rêve.<br>
                                Celui de pouvoir plier et déplier votre écran de smartphone au gré de vos besoins.</p>
                            <button type="button" class="btn btn-danger m-t-3 waves-effect waves-red">See More</button>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="img/Galaxy-Note-9.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <div class="single_home">
                            <h1>Galaxy NOTE 9</h1>
                            <p> UN SANS-FAUTE<br>
                                Améliorations mineures pour smartphone majeur</p>
                            <button type="button" class="btn btn-danger m-t-3 waves-effect waves-red">See More</button>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="img/note10.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <div class="single_home">
                            <h1>Galaxy NOTE 10</h1>
                            <p>Galaxy Note10 : Le pouvoir de créer.<br>
                                Capturez comme un pro, éditez et prenez des notes, le tout à votre façon.
                                </p>
                            <button type="button" class="btn btn-danger m-t-3 waves-effect waves-red">See More</button>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="img/s10+.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <div class="single_home">
                            <h1>Galaxy S10+</h1>
                            <p>Le meilleur de Samsung en grand format</p>
                            <button type="button" class="btn btn-danger m-t-3 waves-effect waves-red">See More</button>
                        </div>
                    </div>
                </li>
            </ul>
            <hr>
        </div> <!-- end of slider -->

        <section id="actualite" class="service">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 m-y-3">
                        <div class="card">
                            <div class="card-header">
                                <i>Actualités :</i>
                            </div>
                            <!-- debut d'affichage des actualites  -->
                            <?php
                                $requet="SELECT * from t_news_new where new_etat='L' order by new_num desc limit 3";
                                //echo $requet;    echo "<br>";
                                $result=$mysqli->query($requet);

                                if ($result == false)
                                { 
                                    echo "Error: La requête a echoué \n";
                                    echo "Errno: " . $mysqli->errno . "\n";
                                    echo "Error: " . $mysqli->error . "\n";
                                    exit();
                                }
                                else //La requête s’est bien exécutée
                                {
                                    $row_cnt = $result->num_rows;
                                    //printf("Le jeu de résultats a %d lignes.\n", $row_cnt);
                                    /* Récupère un tableau associatif */
                                    while ($row = $result->fetch_assoc()) {
                                    //printf ("%s (%s)\n", $row["new_titre"], $row["new_texte"]);
                            ?>

                            <!--    Balise d'actualites    -->
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <h4><?php echo $row["new_titre"] ?></h4>
                                <p><?php echo $row["new_texte"] ?></p>
                                <footer class="blockquote-footer">
                                    Publié par : <cite title="Source Title"><?php echo $row["cpt_pseudo"] ?></cite>
                                    le <?php echo $row["new_date"] ?> 
                                </footer>
                                </blockquote>
                            </div>
                            <hr>

                            <?php
                                    } //Fin boucle while
                                    $result->free();    /* Libération des résultats */
                                }//end if
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </section> <!-- End of actualites section -->

        <section id="new" class="team">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main_team_area m-y-3">
                            <div class="head_title center  wow fadeInUp">
                                <h2>NOUVEAUTÉS</h2>
                                <p>Les dernniers produits de samsung :</p>
                            </div>

                            <div class="main_team_content center">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="single_team white-text m-t-2 wow zoomIn">
                                            <img src="img/Moniteur_C49RG90SSU.webp" alt="team" />
                                            <div class="single_team_overlay">
                                                <h4>Moniteur C49RG90SSU</h4>
                                                <p>Moniteur</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="single_team white-text m-t-2 wow zoomIn">
                                            <img src="img/TV_82Q950R.webp" alt="team" />
                                            <div class="single_team_overlay">
                                                <h4>TV 82Q950R</h4>
                                                <p>TV</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="single_team white-text m-t-2 wow zoomIn">
                                            <img src="img/Lave-linge_WW80M645OQM.webp" alt="team" />
                                            <div class="single_team_overlay">
                                                <h4>Lave-linge WW80M645OQM</h4>
                                                <p>Lave-linge</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="single_team white-text m-t-2 wow zoomIn">
                                            <img src="img/Barre-son_HW-Q90R.webp" alt="team" />
                                            <div class="single_team_overlay">
                                                <h4>Barre son HW-Q90R</h4>
                                                <p>Barre de son</p>
                                            </div>
                                        </div>
                                    </div><!-- End of col-sm-3 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </section><!-- End of neauvautés section -->

            
        <section id="deals" class="joinus">
            <div class="main_joinus_area m-y-3">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="main_joinus_content center white-text wow fadeInUp">
                                <h2 class="text-uppercase m-b-3">BEST DEAL !!</h2>
                                <p style="text-transform: uppercase;">“ Hello! Voilà les derniers promotions de Hallowen Profitez au max...”</p>
                                <a href="#!" class="btn btn-danger waves-effect waves-red">Plus de details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </section> <!-- End of best deal section -->

        <section id="produits" class="portfolio">
            <div class="container">
                <div class="row">
                    <div class="main_portfolio_area m-y-3">
                        <div class="head_title center wow fadeInUp">
                            <h2>Tous nos Produits</h2>
                            <p></p>
                        </div>

                        <div class="main_portfolio_content center wow fadeInUp">
                            <div class="main_mix_menu m-y-2">
                                <ul class="text-uppercase">
                                    <li class="filter" data-filter="all">All</li>
                                    <li class="filter" data-filter=".cat1">Smartphone</li>
                                    <li class="filter" data-filter=".cat2">Electroménager</li>
                                    <li class="filter" data-filter=".cat3">Tablettes</li>
                                    <li class="filter" data-filter=".cat4">TV</li>
                                </ul>
                            </div>

                            <div id="mixcontent" class="mixcontent  wow zoomIn">
                                <div class="col-md-4 mix cat1">
                                    <div class="single_mixi_portfolio center">
                                        <div class="single_portfolio_img">
                                            <img src="img/note10.jpg" alt="" />
                                            <div class="mixi_portfolio_overlay">
                                                <a href="#!"><i class="fa fa-search"></i></a>
                                                <a href="img/note10.jpg" class="gallery-img"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="single_portfolio_text">
                                            <h3>Note 10</h3>
                                            <p>Samsung GALAXY NOTE 10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mix cat1">
                                    <div class="single_mixi_portfolio center">
                                        <div class="single_portfolio_img">
                                            <img src="img/Galaxy-Note-9.jpg" alt="" />
                                            <div class="mixi_portfolio_overlay">
                                                <a href="#!"><i class="fa fa-search"></i></a>
                                                <a href="img/Galaxy-Note-9.jpg" class="gallery-img"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="single_portfolio_text">
                                            <h3>note 9</h3>
                                            <p>Samsung GALAXY NOTE 9</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mix cat1">
                                    <div class="single_mixi_portfolio center">
                                        <div class="single_portfolio_img">
                                            <img src="img/Galaxy-Note9.jpg" alt="" />
                                            <div class="mixi_portfolio_overlay">
                                                <a href="#!"><i class="fa fa-search"></i></a>
                                                <a href="img/Galaxy-Note9.jpg" class="gallery-img"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="single_portfolio_text">
                                            <h3>note 9</h3>
                                            <p>Samsung GALAXY NOTE 9</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mix cat2">
                                    <div class="single_mixi_portfolio center">
                                        <div class="single_portfolio_img">
                                            <img src="img/Lave-linge_WW80M645OQM.webp" alt="" />
                                            <div class="mixi_portfolio_overlay">
                                                <a href="#!"><i class="fa fa-search"></i></a>
                                                <a href="img/Lave-linge_WW80M645OQM.webp" class="gallery-img"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="single_portfolio_text">
                                            <h3>Lave linge</h3>
                                            <p>Lave-linge QuickDrive 8kg - WW80M645OQM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mix cat2">
                                    <div class="single_mixi_portfolio center">
                                        <div class="single_portfolio_img">
                                            <img src="img/Barre-son_HW-Q90R.webp" alt="" />
                                            <div class="mixi_portfolio_overlay">
                                                <a href="#!"><i class="fa fa-search"></i></a>
                                                <a href="img/Barre-son_HW-Q90R.webp" class="gallery-img"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="single_portfolio_text">
                                            <h3>Barre de son 7.1.4</h3>
                                            <p>Barre de son 7.1.4 - 510W - Dolby Atmos – HW-Q90R</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mix cat2 cat4">
                                    <div class="single_mixi_portfolio center">
                                        <div class="single_portfolio_img">
                                            <img src="img/TV_82Q950R.webp" alt="" />
                                            <div class="mixi_portfolio_overlay">
                                                <a href="#!"><i class="fa fa-search"></i></a>
                                                <a href="img/TV_82Q950R.webp" class="gallery-img"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="single_portfolio_text">
                                            <h3>TV QLED 8K</h3>
                                            <p>TV QLED 8K 82Q950R, Ecran Quantum Dot, Full LED Platinum</p>
                                        </div>
                                    </div>
                                </div><!-- End of col-md-4 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </section><!-- End of produits Section -->

        <section id="counter" class="counter">
            <div class="main_counter_area m-y-3">
                <div class="overlay p-y-3">
                    <div class="container">
                        <div class="row">
                            <div class="main_counter_content center white-text wow fadeInUp">
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-heart m-b-1"></i>
                                        <h2 class="statistic-counter">1256</h2>
                                        <p>5 Stars review</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-globe m-b-1"></i>
                                        <h2 class="statistic-counter">2890</h2>
                                        <p>Demande en ligne</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-refresh m-b-1"></i>
                                        <h2 class="statistic-counter">512</h2>
                                        <p>repeat client</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single_counter p-y-2 m-t-1">
                                        <i class="fa fa-check m-b-1"></i>
                                        <h2 class="statistic-counter">480562</h2>
                                        <p>Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </section> <!-- End of counter Section -->

        <section id="revien" class="client">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="main_client_area">
                            <div class="head_title center m-y-3 wow fadeInUp">
                                <h2>CUSTOMER REVIEWS</h2>
                            </div>
                            <div class="main_client_content m-b-3">
                                <div class="carousel carousel-slider">
                                    <div class="carousel-item" >
                                        <div class="single_client_area">
                                            <div class="single_client">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="single_c_img center">
                                                            <img class="img-circle" src="img/client1.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="single_c_text text-md-left text-xs-center">
                                                            <h3>LATIF Islam</h3>
                                                            <span class="text-uppercase m-b-1">5 Stars</span>
                                                            <p>“ Service rapide et trés comfortable”</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single_client">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="single_c_img center">
                                                            <img class="img-circle" src="img/client2.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="single_c_text text-md-left text-xs-center">
                                                            <h3>Iqball Hossain</h3>
                                                            <span class="text-uppercase m-b-1">4 stars</span>
                                                            <p>“ Prix imbatables ”</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End of carouser item -->
                                </div><!-- End of carouser slider -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End of revienws Section -->

        <section id="footer" class="footer">
            <div class="container">
                <div class="row">
                    <div class="main_footer_area white-text p-b-3">
                        <div class="col-md-3">
                            <div class="single_f_widget p-t-3 wow fadeInUp">
                                <img src="img/logo.png" alt="" style="background-color: white;">
                                <div class="single_f_widget_text">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                    <div class="socail_f_widget">
                                        <a href="#!" ><i class="fa fa-facebook"></i></a>
                                        <a href="#!" ><i class="fa fa-google-plus"></i></a>
                                        <a href="#!" ><i class="fa fa-twitter"></i></a>
                                        <a href="#!" ><i class="fa fa-vimeo"></i></a>
                                        <a href="#!" ><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single_f_widget m-t-3 wow fadeInUp">
                                <h4 class="text-lowercase">Some features</h4>
                                <div class="single_f_widget_text f_reatures">
                                    <ul>
                                        <li><i class="fa fa-check"></i>Lorem ipsum dolor sit amet</li>
                                        <li><i class="fa fa-check"></i>Aliquam tincidunt cons ectetuer</li>
                                        <li><i class="fa fa-check"></i>Vestibulum auctor dapibus con</li>
                                        <li><i class="fa fa-check"></i>Lorem ipsum dolor sit amet auctor dapibus</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </section>

        <!-- SCRIPTS -->
        <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="js/tether.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script type="text/javascript" src="js/wow.min.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
        <script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
        <script type="text/javascript" src="js/accordion.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script>
            $(".button-collapse").sideNav();
        </script>
        <script type="text/javascript">
            new WOW().init();
        </script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>

    <?php $mysqli->close();  //Ferme la connexion avec la base MariaDB ?>

</html>