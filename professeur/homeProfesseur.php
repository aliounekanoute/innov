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
        ?>
        <!DOCTYPE html>
        <html>
          <head>
            <meta charset="utf-8">
            <title>Page d'acceuil</title>
            <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
            <script type="text/javascript" src="../dist/js/bootstrap.js"></script>
            <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
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
                                <li><a href="show.php">Afficher les cours mis en ligne</a></li>
                                <li><a href = "../deconnexion.php">Se deconnecter</a></li>
                            </ul>
                        </div>    
                    </div>


                    <div class = "container">
                        
                        <div class="col-sm-9">
                            <div class="jumbotron">
                                <h1 class="display-4">Bienvenue </h1>
                                <p class="lead">Vous pouvez ajouter et supprimer vos cours, et aussi participer au forum du discussion.</p><br><br><br><br><br><br><br><br><br><br><br><br>
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

    
?>






































<?php include("../footer.php");?>
