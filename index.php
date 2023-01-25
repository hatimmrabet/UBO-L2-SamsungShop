  <?php require_once("includes/BDD.php"); ?>

 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta http-equiv="x-ua-compatible" content="ie=edge">

     <title>Samsung</title>
     <link rel="icon" type="image/png" href="img/favicon.ico" />

     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800,600,300,300italic,700' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
     <link href="css/materialize.css" rel="stylesheet">
     <link href="css/magnific-popup.css" rel="stylesheet">
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/mdb.min.css" rel="stylesheet">
     <link href="css/responsive.css" rel="stylesheet">

     <link href="css/style.css" rel="stylesheet">
 </head>

 <body>
     <?php $accueil = 0;
        require_once("includes/header.php"); ?>

     <div id="home" class="slider">
         <ul class="slides">
             <?php
                $sql = "SELECT * from t_visuel_vis where vis_visibilite = 'L' order by vis_id desc limit 4"; //les 4 derniers photo enligne
                $res = $mysqli->query($sql);

                while ($vis = $res->fetch_assoc()) {
                ?>
                 <li>
                     <img src="img/visuels/<?php echo $vis['vis_nom_fichier'] ?>"> <!-- random image -->
                     <div class="caption center-align">
                         <div class="single_home">
                             <h1><?php echo $vis['vis_descriptif'] ?></h1>
                             <p> Pour plus d'informations, Visitez notre site officiel.</p>
                             <button type="button" class="btn btn-danger m-t-3 waves-effect waves-red"><a href="https://www.samsung.com/fr/" style="color: white;">See More</a></button>
                         </div>
                     </div>
                 </li>
             <?php } ?>
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
                            $requet = "SELECT * from t_news_new where new_etat='L' order by new_date desc , new_num desc limit 3";
                            $result = $mysqli->query($requet);
                            if ($result == false) {
                                echo "Error: La requête a echoué \n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                exit();
                            } else //La requête s’est bien exécutée
                            {
                                $row_cnt = $result->num_rows;
                                while ($row = $result->fetch_assoc()) {
                            ?>

                                 <!--    Balise d'actualites    -->
                                 <div class="card-body">
                                     <blockquote class="blockquote mb-0">
                                         <h4><?php echo $row["new_titre"] ?></h4>
                                         <p><?php echo $row["new_texte"] ?></p>
                                         <small style="margin-left: 25px;"> - Publié par : <span style="font-weight: 400;"><?php echo $row["cpt_pseudo"] ?></span>
                                             le <span style="font-weight: 400;"><?php echo $row["new_date"] ?></span>
                                         </small>
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
                                         <img src="img/visuels/Moniteur_C49RG90SSU.webp" alt="team" />
                                         <div class="single_team_overlay">
                                             <h4>Moniteur C49RG90SSU</h4>
                                             <p>Moniteur</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="single_team white-text m-t-2 wow zoomIn">
                                         <img src="img/visuels/TV_82Q950R.webp" alt="team" />
                                         <div class="single_team_overlay">
                                             <h4>TV 82Q950R</h4>
                                             <p>TV</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="single_team white-text m-t-2 wow zoomIn">
                                         <img src="img/visuels/Lave-linge_WW80M645OQM.webp" alt="team" />
                                         <div class="single_team_overlay">
                                             <h4>Lave-linge WW80M645OQM</h4>
                                             <p>Lave-linge</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="single_team white-text m-t-2 wow zoomIn">
                                         <img src="img/visuels/Barre-son_HW-Q90R.webp" alt="team" />
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
                                         <img src="img/visuels/note10.jpg" alt="" />
                                         <div class="mixi_portfolio_overlay">
                                             <a href="#!"><i class="fa fa-search"></i></a>
                                             <a href="img/visuels/note10.jpg" class="gallery-img"><i class="fa fa-link"></i></a>
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
                                         <img src="img/visuels/Galaxy-Note-9.jpg" alt="" />
                                         <div class="mixi_portfolio_overlay">
                                             <a href="#!"><i class="fa fa-search"></i></a>
                                             <a href="img/visuels/Galaxy-Note-9.jpg" class="gallery-img"><i class="fa fa-link"></i></a>
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
                                         <img src="img/visuels/Galaxy-Note9.jpg" alt="" />
                                         <div class="mixi_portfolio_overlay">
                                             <a href="#!"><i class="fa fa-search"></i></a>
                                             <a href="img/visuels/Galaxy-Note9.jpg" class="gallery-img"><i class="fa fa-link"></i></a>
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
                                         <img src="img/visuels/Lave-linge_WW80M645OQM.webp" alt="" />
                                         <div class="mixi_portfolio_overlay">
                                             <a href="#!"><i class="fa fa-search"></i></a>
                                             <a href="img/visuels/Lave-linge_WW80M645OQM.webp" class="gallery-img"><i class="fa fa-link"></i></a>
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
                                         <img src="img/visuels/Barre-son_HW-Q90R.webp" alt="" />
                                         <div class="mixi_portfolio_overlay">
                                             <a href="#!"><i class="fa fa-search"></i></a>
                                             <a href="img/visuels/Barre-son_HW-Q90R.webp" class="gallery-img"><i class="fa fa-link"></i></a>
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
                                         <img src="img/visuels/TV_82Q950R.webp" alt="" />
                                         <div class="mixi_portfolio_overlay">
                                             <a href="#!"><i class="fa fa-search"></i></a>
                                             <a href="img/visuels/TV_82Q950R.webp" class="gallery-img"><i class="fa fa-link"></i></a>
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
     </section><!-- End of produits Section -->

     <section id="footer" class="footer">
         <div class="container ">
             <div class="row main_footer_area white-text p-b-1 p-t-1 col-md-3 " style="margin-left: 38%;">
                 <div class="single_f_widget wow fadeInUp">
                     <img src="img/logo_blanc.png" alt="">
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

 <?php $mysqli->close();  //Ferme la connexion avec la base MariaDB 
    ?>

 </html>