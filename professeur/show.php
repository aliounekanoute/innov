<?php
  include("../nav.php");
  require("../function.php");

  $bd=connect();
  if(isset($_SESSION['email']) and isset($_SESSION['mdp']) and isset($_SESSION['nni'])){
    $nni = $_SESSION['nni'];
    $requete = $bd->prepare('select * from professeur where NNI = :nni');
    $requete->execute(array('nni' => $nni
                      ));
    $show = $requete->fetch();
    if($nni == $show['NNI']){
      $donee = $bd->prepare('select * from cours where NNI = ?');
      $donee->execute(array($nni));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cours</title>
</head>

  <body>
  <div class="row content">
                    <div class="col-sm-3 sidenav">
                        <div class = "panel panel-default panel-design">
                            <h2 style = "position : relative;left:10px;"><?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?></h2>
                            <br><br><br>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="../forum/forum.php">Forum</a></li>
                                <li><a href="ajouterCours.php">Ajouter un cours</a></li>
                                <li><a href = "../deconnexion.php">Se deconnecter</a></li>
                            </ul>
                        </div>    
                    </div>
    <div class = "container">
      <div class = "row">
      <div class = "col-xs-2"></div>
        <div class = "col-xs-8">
          <div class = "panel panel-info panel-design">
            <div class = "panel-heading">
            <?php  echo '<h2 class ="text-center">Vos cours </h2><br>'; ?>
            </div>
                  <?php
                      if($donee->rowCount() > 0){
                        ?>
                        <table class ="table">
                      <?php
                        while($data = $donee->fetch())
                        {
                          $query=$bd->prepare('select name from categories where id = ?');
                          $query->execute(array($data['id_cat']));
                          $show = $query->fetch();
                  ?>
                    <tr>
                      <td align="center">
                          <?php  echo $data['titre'];?>
                      </td>
                      <td><?php echo $show['name']; ?></td>
                      <td align="center"><?php echo '<a href="'.$data['fichier'].'"  target="_blank">Afficher</a>'; ?></td>
                      <td align="center"><?php echo '<form action="supprimerCours.php" method="post"><input type="hidden" name="id" value="'.$data['id_cours'].'"><input type="submit" value="Supprimer" class = "btn btn-danger btn-supr"></form>'; ?></td>
                    </tr>
                  <?php      
                        }
                  ?>
            </table>

            
            <?php
                      }
                  else{
                    ?>
                    Aucun cours mis en ligne...
                    <?php
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
          </div>
        </div>  
        <div class ="col-xs-2"></div>
      </div>  
    </div>
  </body>
  <?php include("../footer.php");?>
</html>


