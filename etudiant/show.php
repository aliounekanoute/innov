<?php
include("../nav.php");
require("../function.php");
$bd=connect();
if(isset($_SESSION['email']) and isset($_SESSION['mdp']) and isset($_SESSION['matricule'])){
  $matricule = $_SESSION['matricule'];
  $requete = $bd->prepare('select * from etudiant where matricule = ?');
  $requete ->execute(array($matricule));
  $show = $requete ->fetch();
    if($matricule == $show['matricule']){
      $demande=$_POST['demande'];
      $donnee = $bd->prepare('select * from categories where name = ?');
      $donnee->execute(array($demande));
      $showC = $donnee->fetch();
      $donneeC = $bd->prepare('select * from cours where id_cat = ?');
      $donneeC->execute(array($showC['id']));
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title>Cours</title>
        <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
        <script type="text/javascript" src="../dist/js/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
      </head>
      <body>
      <div class="row content">
            
                <div class="col-xs-2 sidenav compte">
                    <div class = "panel panel-default panel-design">
                        <h2 style = "position : relative;left:10px;"> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>  </h2>
                        <br><br><br>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="../forum/forum.php">Forum</a></li>
                            <li><a href="cours.php">Afficher les formations</a></li>
                            <li><a href="../deconnexion.php">Se deconnecter</a></li>
                        </ul><br>
                </div>      
             </div>
                <div class = "container">
                    <div class ="col-xs-10">
      <?php
        echo '<h2>Les cours de'.' '.$demande.'</h2><br>';
      if($donneeC->rowCount() > 0){
              ?>
              <table class="table">
              <?php
              while($data = $donneeC->fetch()){
                  ?>
                  <tr>
                    <td><?php echo $data['titre']; ?></td>
                    <td><?php echo '<a href="'.$data['fichier'].'" target="_blank">Afficher</a>'; ?></td>
                  </tr>
                <?php
              }
              ?>
              </table>
              <?php
            }
          else {
            ?>
            <br>
            Aucun cours n'a été mis en ligne pour le moment...
            <?php
          }
          ?>
          </div>
        </div>
      </div>
      </body>
      <?php
      include("../footer.php");
      ?>
      </html> 
      <?php
    }
    else{
        redirectTo("../index.php");
    }
  }
  else{
      redirectTo("../index.php");
  }

?>
