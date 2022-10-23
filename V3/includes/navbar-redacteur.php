<style>
    .btn-outline-light:hover {
        color: white;
        background-color: #ef1818;
        border-color: #f8f9fa;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>

<nav class="navbar navbar-expand navbar-dark bg-primary" style="width:100%;">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if($page==0) {echo"active";}?> ">
            <a class="nav-link" href="redacteur_accueil.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown <?php if($page==1) {echo"active";}?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Gestion des informations </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="redacteur_informations.php">Affichage</a>
            <a class="dropdown-item" href="redacteur_inf_ajout.php">Ajout d'information</a>
            </div>
        </li>
        <li class="nav-item <?php if($page==2) {echo"active";}?> ">
            <a class="nav-link" href="redacteur_actualites.php">Gestion des actualités <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($page==3) {echo"active";}?> ">
            <a class="nav-link" href="red_cat.php">Gestion des catégories <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($page==4) {echo"active";}?> ">
            <a class="nav-link" href="red_vis.php">Gestion des visuels <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($page==5) {echo"active";}?> ">
            <a class="nav-link" href="#">Gestion des URL <span class="sr-only">(current)</span></a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="">
            <button class="btn btn-outline-light my-2 my-sm-0" name="logout" type="submit" style="width:150px;">Log out</button>
        </form>
    </div>
</nav>

<?php //se deconnecter
if(isset($_POST['logout']))
{
    // destruction de la session
    session_destroy();
    // libération des variables globales associées à la session
    unset($_SESSION['pseudo']);
    unset($_SESSION['statut']);
    header('location: ../login/session.php');
}
?>