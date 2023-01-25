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


if (isset($_POST['ajouter']))        //ajout des visuel
{
    //gestion de l'image "../img/visuels/"
    $file_name = basename($_FILES["vis_image"]["name"]);
    $file_name_tmp = $_FILES["vis_image"]["tmp_name"];
    $target_dir = '../img/visuels/';
    $target_file = $target_dir . $file_name;

    // prepare and bind
    $stmt = $mysqli->prepare("INSERT INTO t_visuel_vis VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("isssss", $id, $vis_desc, $nom_fichier, $thedate, $visi, $pseudo);
    // set parameters and execute
    $id = null;
    $vis_desc = $_POST['desc'];
    $nom_fichier = $file_name;
    $thedate = $_POST['thedate'];
    $visi = $_POST['visi'];
    $pseudo = $_SESSION['pseudo'];

    if (file_exists($target_file)) {      //le fichier existe deja
        $_SESSION['msg'] = 6;
    } else {
        $check_upload = move_uploaded_file($file_name_tmp, $target_file);   //upload de l'image
        if ($check_upload == false) {
            echo "ERREUR : Upload file";    //message d'erreur
            $_SESSION['msg'] = 4;
        } else {
            $stmt->execute();   // execution de la requete d'insertion
            if ($stmt == true) {
                echo "visuel Ajouté";
                $stmt->close();
                $_SESSION['msg'] = 3;
            } else {
                echo "ERREUR : $stmt";
                unlink($target_file);
                $_SESSION['msg'] = 4;
            }
        }
    }
    header("Location: red_vis.php");
}

//modifier fichier
if (isset($_POST['modifier'])) {
    if ($_POST['modif_vis'] == "non") {
        $stmt = $mysqli->prepare("  UPDATE t_visuel_vis 
                                    SET vis_descriptif=? , vis_visibilite=?, vis_date_ajout = ?
                                    where vis_id=?;");
        $stmt->bind_param("sssi", $desc, $visi, $thedate, $id);
        $desc = $_POST['desc'];
        $visi = $_POST['visi'];
        $thedate = $_POST['thedate'];
        $id = $_GET['edit'];
        $stmt->execute();
        if ($stmt == true) {
            echo "visuel Modifier";
            $_SESSION['msg'] = 1;
        } else {
            echo "ERREUR : $stmt";
            unlink($target_file);
            $_SESSION['msg'] = 3;
            exit();
        }
    }else{ //si on va changer la photo aussi
        //le nom du l'ancien fichier
        $req = $mysqli->prepare("SELECT * from t_visuel_vis where vis_id = ? ");
        $req->bind_param("i", $id);
        $id = $_GET['edit'];
        $req->execute();
        $res = $req->get_result();
        $data = $res->fetch_assoc();
        $old_file_name = $data['vis_nom_fichier'];

        //MAJ des donnes
        $stmt = $mysqli->prepare("UPDATE t_visuel_vis 
        SET vis_descriptif=? , vis_nom_fichier=? , vis_visibilite=?, vis_date_ajout = ?
        where vis_id=?;");
        $stmt->bind_param("ssssi", $desc, $new_file_name, $visi, $thedate, $id);
        $desc = $_POST['desc'];
        $new_file_name = basename($_FILES["vis_image"]["name"]);;
        $visi = $_POST['visi'];
        $thedate = $_POST['thedate'];
        $id = $_GET['edit'];

        $target_dir = '../img/visuels/';
        //remove old file
        $old_file_target = $target_dir . $old_file_name;
        unlink($old_file_target);

        //upload new file
        $new_file_name_tmp = $_FILES["vis_image"]["tmp_name"];
        $target_file = $target_dir . $new_file_name;
        $check_upload = move_uploaded_file($new_file_name_tmp, $target_file);

        if ($check_upload == false) {
            echo "ERREUR : Upload file";    //message d'erreur
            $_SESSION['msg'] = 2;
            exit();
        } else {
            $stmt->execute();   //execution de la requete de modification
            if ($stmt == true) {
                echo "visuel Modifier";
                $_SESSION['msg'] = 1;
            } else {
                echo "ERREUR : $stmt";
                unlink($target_file);
                $_SESSION['msg'] = 3;
                exit();
            }
            $stmt->close();
        }
    }
    header("Location: red_edit_vis.php?edit=" . $_GET['edit'] . "");
}

//supression des catégorie
if (isset($_POST['supprimer'])) {
    $stmt = $mysqli->prepare("SELECT * from t_visuel_vis where vis_id = ? ");
    $stmt->bind_param("i", $id);
    $id = $_POST['id'];
    $stmt->execute();

    if ($stmt == false) {
        echo "ERREUR : $stmt";
        exit();
    } else {
        $res = $stmt->get_result();
        if ($res->num_rows == 1) {
            $stmt->close();

            $stmt2 = $mysqli->prepare("DELETE from t_visuel_vis where vis_id = ? ");
            $stmt2->bind_param("i", $id);
            $id = $_POST['id'];
            $stmt2->execute();

            if ($stmt2 == false) {
                echo "ERREUR : $stmt2 .\n";
            } else {
                $target_dir = '../img/visuels/';
                $data = $res->fetch_assoc();
                unlink($target_dir . $data['vis_nom_fichier']);
                $stmt2->close();

                echo "Visuel supprimé";
                $_SESSION['msg'] = 1;
            }
        } else {
            $_SESSION['msg'] = 2;
            echo "N° de Visuel incorrect";
        }
    }
    header("Location: red_vis.php");
}

$mysqli->close();
