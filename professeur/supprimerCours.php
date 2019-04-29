<?php
require("../function.php");
$bd=connect();
session_start();
if(isset($_SESSION['email']) and isset($_SESSION['mdp']) and isset($_SESSION['nni'])){
  $nni = $_SESSION['nni'];
  $requete = $bd->prepare('select * from professeur where NNI = :nni');
  $requete->execute(array('nni' => $nni
                    ));
  $show = $requete->fetch();
  if($nni == $show['NNI']){
    $id = $_POST['id'];
    $q = $bd->prepare('delete from cours where id_cours = :id');
    $q->execute(array(
      'id' => $id
    ));
    redirectTo("show.php");
  }
  else{
    redirectTo("../index.php");
  }
}
else{
  redirectTo("../index.php");
}
 ?>
