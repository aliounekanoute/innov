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
                <meta charset='utf-8'>
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
                                <li><a href="show.php">Afficher les cours mis en ligne</a></li>
                                <li><a href = "../deconnexion.php">Se deconnecter</a></li>
                            </ul>
                        </div>    
                    </div>
                    <div class ="container">   
                        <div class = "col-xs-3"></div>
                        <div class ="col-xs-9">

                            <div class = "panel panel-info">
                                <div class = "panel-heading">
                                <h2>Ajouter un cours </h2>
                                </div>
                                <div class = "panel-body panel-design">
                                    <form method="post" action="traitementAjout.php" enctype="multipart/form-data" class ="">
                                        <table class = "table table-design">
                                            <tr>
                                                <td><label for="categorie">Categorie:</label></td>
                                                <td><select name="choix" id="categorie" class ="form-control">
                                                <option value="Bureautique">Bureautique</option>
                                                <option value="Multimedia">Multimedia</option>
                                                <option value="Reseaux et maintenance">Reseaux et maintenance</option>
                                                <option value="Initiation à l'informatique">Initiation à l'informatique</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="titre">titre:</label></td>
                                                <td><input type="text" name="titre" placeholder="Titre du cours" id="titre" class ="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><label for="fich">fichier:</label></td>
                                                <td><input type="file" name="fichier" id="fich" class ="form-control"></td>
                                                
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" value="Enregistrer" class ="btn btn-info"></td>
                                            </tr>
                                        </table>

                                    </form>
                                </div>
                        </div>
                    </div>    
                </div>
                </div>           
                <?php include("../footer.php");?>
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
