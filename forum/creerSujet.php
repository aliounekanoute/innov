<?php
include("nav.php");
require("../function.php");
if(isset($_SESSION['nni']) or isset($_SESSION['matricule']))
{
    ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Créer un sujet</title>
</head>
<body>
<div class="row content">
            
            <div class="col-xs-2 sidenav compte">
                <div class = "panel panel-default panel-design">
                    <h2 style = "position : relative;left:10px;"> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>  </h2>
                    <br><br><br>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="../forum/forum.php">Forum</a></li>
                        <li><a href="sujet.php">Afficher tous les sujets</a></li>
                        <li><a href="afficherSujet.php">Afficher vos sujets</a></li>
                        <li><a href="../deconnexion.php">Se deconnecter</a></li>
                    </ul><br>
            </div>      
        </div>

        <div class ="container">
            <div class ="row">
                
                <div class = 'col-xs-10'>
                    <div class = "panel panel-info">
                        <div class = "panel-heading">
                            <h2 class = "text-center">Créer un sujet de discussion</h2>
                        </div>
                        <div class ="panel-body">
                                <form action="../controlleur/ajouterSujet.php" method="post" >
                                    <table class="table">
                                        <tr>
                                            <td><label for="categorie">Categorie:</label></td>
                                            <td><select name="choix" id="categorie" class ="form-control">
                                                    <option value="Bureautique">Bureautique</option>
                                                    <option value="Multimedia">Multimedia</option>
                                                    <option value="Reseaux et maintenance">Reseaux et maintenance</option>
                                                    <option value="Initiation à l'informatique">Initiation à l'informatique</option>
                                                </select>
                                            </td>
                                            <tr>
                                                <td> <label for="titre">Titre</label> </td>
                                                <td> <input type="text" name="titre" id="titre" > </td>
                                            </tr>
                                            <tr>
                                                <td> <label for="objet">Question</label> </td>
                                                <td> <textarea name="objet" id="objet" cols="30" rows="10"></textarea> </td>
                                            </tr> 
                                            <tr>
                                                <td></td>
                                                <td> <input type="submit" value="Créer" class ="btn btn-info"> </td>
                                            </tr>                                              
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>
<?php
}
else {
    redirectTo("../index.php");
}
?>
