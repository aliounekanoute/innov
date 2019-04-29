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
      if(isset($_POST['id'])){
        $id = $_POST['id'];
        $q = $bd->query('delete from etudiant where matricule ='.$id.' ');
        $q = $bd->query('delete from professeur where NNI ='.$id.' ');
        echo 'Le compte a été supprimer';
        redirectTo("compte.php");
      }
      else{
        redirectTo("compte.php");
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
