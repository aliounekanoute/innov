<?php
  include("../nav.php");
 
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
      ?>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
          <script type="text/javascript" src="../dist/js/bootstrap.js"></script>
          <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
          <title>Compte utilisateur</title>
        </head>
        <body>
        <div class="container-fluid">
    <div class="row content">
      <div class="col-xs-3 sidenav">
        <div class ="panel panel-default panel-design">
          <h1 style = "position : relative;left:10px;"><?php echo $_SESSION['prenom'];?></h1>
          <br><br><br>
          
          <div class ="row">
            <div class = "col-xs-1"></div>
            <div class = "col-xs-9">
              <form method="post" action="result.php">
                <div class="input-group">
                  <input type="text" name="recherche" class="form-control" placeholder="rechercher un compte" style = "position : relative;right:15px;">
                    <span class="input-group-btn"><input class="btn btn-success" type="submit" value = "?" style = "position : relative;right:13.75px;"> 
                    </span>
                </div>
              </form>
            </div>
          </div>  

          <ul class="nav nav-pills nav-stacked">
            <li><a href="adduser.php">Ajouter un compte</a></li>
            <li ><a href="../deconnexion.php">Se deconnecter</a></li>
          </ul><br>
        </div> 
      </div>
        <div  align="center" class = "container">
          <div class = "col-xs-2"></div>
            <div class = "col-xs-8">
              <div class = "panel panel-info">
                <div class = "panel-heading">
                  <?php
                      $bd=connect();
                      $donneeE = $bd->query('select * from etudiant order by matricule asc');
                      $donneeP = $bd->query('select * from professeur order by NNI asc');
                      ?>
                      <h3>Comptes Etudiants</h3>
                </div>
                <div class = "panel-body">
                <ul>
                      <?php
                        while($show = $donneeE -> fetch() ){
                      ?>
                        <li><?php   echo '<form action="delete.php" method="post">'.$show['matricule'].' - '.$show['prenom'].' '.$show['nom'].'  <input type="hidden" name="id" value="'.$show['matricule'].'"><input type="submit" value="Supprimer" class = "btn btn-danger"></form>'; ?></li>
                    <?php
                  } ?>
                  </ul>
                </div>
              </div>      
                <div class ="panel panel-info">
                  <div class = "panel-heading">
                    <h3>Comptes Professeurs</h3>
                  </div>
                  <div class = "panel-body">
                  <ul>
                    <?php
                      while($show = $donneeP->fetch()){
                        ?>
                        <li><?php   echo '<form action="delete.php" method="post">'.$show['NNI'].' - '.$show['prenom'].' '.$show['nom'].'  <input type="hidden" name="id" value="'.$show['NNI'].'"><input type="submit" value="Supprimer" class = "btn btn-danger"></form>'; ?></li>
                    <?php
                      }
                  ?>
                    </ul>
                </div>
            </div>
        </div>
        </div>
      </div>
      </div>          
        </body>
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
  include("../footer.php");
  ?>
