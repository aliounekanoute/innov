<?php
session_start();
require("../function.php");
$bd = connect();
if(isset($_SESSION['email']) and isset($_SESSION['mdp']) and isset($_SESSION['pseudo'])){
  $pseudo = $_SESSION['pseudo'];
  $requete = $bd ->prepare('select * from admin where email = :mail ');
  $requete->execute(array(
    'mail'=> $pseudo
  ));
  $show = $requete->fetch();
  if($pseudo == $_SESSION['pseudo']){
    if (isset($_POST['choix']) and isset($_POST['nni']) and isset($_POST['prenom']) and isset($_POST['nom']) and isset($_POST['mail'])) {
      $choix = $_POST['choix'];
      $nni = $_POST['nni'];
      $prenom = strtoupper($_POST['prenom']);
      $nom = strtoupper($_POST['nom']);
      $mail = $_POST['mail'];
      $mdp = $_POST['mdp'];
      $donneeP = $bd->prepare('select * from professeur where email = :mail or NNI = :nni');
      $donneeP->execute(array
      ('mail' => $mail,
       'nni' => $nni
     ));
     $showP = $donneeP->fetch();
     $donneeE = $bd->prepare('select * from etudiant where email = : mail ');
     $donneeE->execute(array(
       'mail' => $mail
     ));
     $showE = $donneeE->fetch();
     if($showP!=NULL or $showE!=NULL){
       echo 'Le compte '.$mail.' existe deja';
       redirectTo("../admin/compte.php");
     }
     else{
       if($choix == 'professeur'){
         $query =$bd->prepare('insert into professeur (NNI,pseudo,nom,prenom,password,email) values (:nni,:pseudo,:nom,:prenom,:password,:mail)');
         $query->execute(array(
           'nni' => $nni,
           'pseudo' => $pseudo,
           'nom' => $nom,
           'prenom' => $prenom,
           'password' => $mdp,
           'mail' => $mail
         ));

         echo 'Le compte professeur a ete bien cree';
          redirectTo("../admin/compte.php");
       }
       else {
         $query =$bd->prepare('insert into etudiant (pseudo,nom,prenom,password,email) values (:pseudo,:nom,:prenom,:password,:mail)');
         $query->execute(array(
           'pseudo' => $pseudo,
           'nom' => $nom,
           'prenom' => $prenom,
           'password' => $mdp,
           'mail' => $mail
         ));
         echo 'Le compte ettudiant a ete bien cree';
         redirectTo("../admin/compte.php");
       }
     }
    }
     else {
       redirectTo("../admin/adduser.php");
     }
  }
  else{
    redirectTo("../index.php");
  }
  }
  else{
    redirectTo("../index.php");
  }

 ?>
