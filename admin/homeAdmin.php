
<?php   include("../nav.php");
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
      <title>Administration</title>
      <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
     <script type="text/javascript" src="../dist/js/bootstrap.js"></script>
     <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
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
            <li><a href="compte.php">Afficher tous les comptes</a></li>
            <li ><a href="../deconnexion.php">Se deconnecter</a></li>
          </ul><br>
        </div> 
      </div>
    
      <div class = "container">
        <div class="col-sm-9">
          <div class="jumbotron">
            <h1 class="display-4">Bienvenue dans la page d'administration</h1>
            <p class="lead">Vous pouvez gérer les comptes utilisateurs(ajouter et supprimer).</p><br><br><br><br><br><br>
          </div>
        </div>
      </div>
  </div>





    </body>
  </html>
    <?php
    include("../footer.php");
  }
  else {
    redirectTo("../index.php");
  }
  }

else {
  redirectTo("../index.php");
}
  ?>
