<?php
    require("../function.php");
    session_start();
    if(isset($_SESSION['nni'])){
        $bd=connect();
        if(isset($_POST['poste']) and isset($_POST['id_sujet'])){
            $id_sujet = $_POST['id_sujet'];
            $poste = $_POST['poste'];
            $nni = $_SESSION['nni'];
            $query = $bd->prepare('insert into postesujet (id_sujet,NNI,contenu,date) values (?,?,?,now())');
            $query->execute(array($id_sujet,$nni,$poste));
            $_SESSION['id_S'] = $id_sujet;
            redirectTo("afficher.php");
            
        }
        else{
            redirectTo("afficher.php");
        }
    }
    elseif(isset($_SESSION['matricule'])){
        $bd=connect();
        $id_sujet = $_SESSION['id_sujet'];
        if(isset($_POST['poste']) and isset($_POST['id_sujet'])){
            $id_sujet = $_POST['id_sujet'];
            $poste = $_POST['poste'];
            $matricule = $_SESSION['matricule'];
            $query = $bd->prepare('insert into postesujet (id_sujet,matricule,contenu,date) values (?,?,?,now())');
            $query->execute(array($id_sujet,$matricule,$poste));
            $_SESSION['id_S'] = $id_sujet;
            redirectTo("afficher.php");
        }
        else{
            redirectTo("afficher.php");
        }
    } 
    else{
        redirectTo("../index.php");
    }
?>