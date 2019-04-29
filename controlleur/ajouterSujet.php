<?php
session_start();
require("../function.php");
$bd =connect();
if(isset($_SESSION['nni'])){
    if(isset($_POST['choix']) and isset($_POST['titre']) and isset($_POST['objet'])){
        $choix = $_POST['choix'];
        $req = $bd->prepare('select id from categories where name=?');
        $req->execute(array($choix));
        $reqs=$req->fetch();
        $nni = $_SESSION['nni'];
        $titre = htmlspecialchars($_POST['titre']);
        $objet = htmlspecialchars($_POST['objet']);
        $query = $bd->prepare('insert into sujet (NNI,titre,categorie,objet,date) values (?,?,?,?,now()) ');
        $query->execute(array($nni,$titre,$reqs['id'],$objet));
        $_SESSION['id_S'] = $nni;
        redirectTo("../forum/sujet.php");
    }
    else {
        redirectTo("../forum/creerSujet.php");
    }
}
elseif(isset($_SESSION['matricule'])){
    if(isset($_POST['choix']) and isset($_POST['titre']) and isset($_POST['objet'])){
        $choix = $_POST['choix'];
        $req = $bd->prepare('select id from categories where name=?');
        $req->execute(array($choix));
        $reqs=$req->fetch();
        $matricule = $_SESSION['matricule'];
        $titre = htmlspecialchars($_POST['titre']);
        $objet = htmlspecialchars($_POST['objet']);
        $query = $bd->prepare('insert into sujet (matricule,titre,categorie,objet,date) values (?,?,?,?,now()) ');
        $query->execute(array($matricule,$titre,$reqs['id'],$objet));
        $_SESSION['id_S'] = $matricule;
        redirectTo("../forum/sujet.php");
    }
    else {
        redirectTo("../forum/creerSujet.php");
    }    
}
else {
    redirectTo("../index.php");
}
?>