<?php
include("nav.php");
require("../function.php");
$bd = connect();
if(isset($_SESSION['email']) and isset($_SESSION['mdp'])){
    if(isset($_SESSION['nni'])){
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
        <script type="text/javascript" src="../dist/js/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
    <title>Vos sujets</title>
</head>
<body>
<div class="row content">
            
            <div class="col-xs-2 sidenav compte">
                <div class = "panel panel-default panel-design">
                    <h2 style = "position : relative;left:10px;"> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>  </h2>
                    <br><br><br>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="forum.php">Forum</a></li>
                        <li><a href="sujet.php">Afficher tous les sujets</a></li>
                        <li><a href="creerSujet.php">Créer un sujet</a></li>
                        <li><a href="../deconnexion.php">Se deconnecter</a></li>
                    </ul><br>
                </div>      
            </div> 
            <div class ="container">
                <div class = "row">
                    <div class = "col-xs-1"></div>
                        <div class = "col-xs-10">
                            <div class = "panel panel-info panel-design">
                                <div class = "panel-heading">
                                    <h2 class = "text-center">Les sujets que vous avez crée</h2>
                                </div>
                                <div class="panel-body">
                                <?php
                                $nni = $_SESSION['nni'];
                                $query = $bd->prepare('select * from sujet where NNI = ?');
                                $query->execute(array($nni));
                                if($query->rowCount() > 0){
                                    ?>
                                        <table class = "table">
                                        <tr>
                                        <th>Titre</th>
                                        <th>Objet</th>
                                        <th>Categorie</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                        while($show = $query->fetch()){
                                            $req = $bd->prepare('select name from categories where id = ?');
                                                    $req->execute(array($show['categorie']));
                                                    $reqs=$req->fetch();
                                        ?>
                                    <tr>
                                        <td><?php echo $show['titre']; ?></td>
                                        <td><?php echo $show['objet']; ?></td>
                                        <td><?php echo $reqs['name']; ?></td>
                                        <td><?php echo $show['date']; ?></td>
                                        <td><?php echo '<form action="afficher.php" method="post" ><input type="hidden" name="demande" value="'.$show['id'].'"><input type="submit" value="Commenter" class = "btn btn-info"></form>'; ?>
                                        </td>
                                    </tr>
                                        <?php
                                        }
                                        ?>
                                        </table>
                                    <?php
                                }
                                else{
                                    ?>
                                    Vous n'avez crée aucun sujet...
                                    <?php
                                }
                                ?>
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
    elseif(isset($_SESSION['matricule'])){
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
                <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
                <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
                <script type="text/javascript" src="../dist/js/bootstrap.js"></script>
                <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
            <title>Vos sujets</title>
        </head>
        <body>
        <div class="row content">
                    
                    <div class="col-xs-2 sidenav compte">
                        <div class = "panel panel-default panel-design">
                            <h2 style = "position : relative;left:10px;"> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>  </h2>
                            <br><br><br>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="forum.php">Forum</a></li>
                                <li><a href="sujet.php">Afficher tous les sujets</a></li>
                                <li><a href="creerSujet.php">Créer un sujet</a></li>
                                <li><a href="../deconnexion.php">Se deconnecter</a></li>
                            </ul><br>
                        </div>      
                    </div> 
                    <div class ="container">
                        <div class = "row">
                            <div class = "col-xs-1"></div>
                                <div class = "col-xs-10">
                                    <div class = "panel panel-info panel-design">
                                        <div class = "panel-heading">
                                            <h2 class = "text-center">Les sujets que vous avez crée</h2>
                                        </div>
                                        <div class="panel-body">
                                        <?php
                                        $matricule = $_SESSION['matricule'];
                                        $query = $bd->prepare('select * from sujet where matricule = ?');
                                        $query->execute(array($matricule));
                                        if($query->rowCount() > 0){
                                            ?>
                                                <table class = "table table-bordered table-striped">
                                                <tr>
                                                <th>Titre</th>
                                                <th>Objet</th>
                                                <th>Categorie</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                            <?php
                                                while($show = $query->fetch()){
                                                    $req = $bd->prepare('select name from categories where id = ?');
                                                            $req->execute(array($show['categorie']));
                                                            $reqs=$req->fetch();
                                                ?>
                                            <tr>
                                                <td><?php echo $show['titre']; ?></td>
                                                <td><?php echo $show['objet']; ?></td>
                                                <td><?php echo $reqs['name']; ?></td>
                                                <td><?php echo $show['date']; ?></td>
                                                <td><?php echo '<form action="afficher.php" method="post" ><input type="hidden" name="demande" value="'.$show['id'].'"><input type="submit" value="Commenter" class = "btn btn-info"></form>'; ?>
                                                </td>
                                            </tr>
                                                <?php
                                                }
                                                ?>
                                                </table>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            Vous n'avez crée aucun sujet...
                                            <?php
                                        }
                                        ?>
                                        </div>
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
    else {
        redirectTo("../index.php");
    }
?>

<?php
}
else {
    redirectTo("../index.php");
}
?>
