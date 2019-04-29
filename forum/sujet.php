<?php
include("nav.php");
require("../function.php");
if(isset($_SESSION['nni']) or isset($_SESSION['matricule'])){
    $bd=connect();
    ?>
    <!DOCTYPE html>
        <html lang="en">
        <head>            
            <meta charset='utf-8'>
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
                            <li><a href="sujet.php">Afficher tous les sujets</a></li>
                            <li><a href="afficherSujet.php">Afficher vos sujets</a></li>
                            <li><a href="creerSujet.php">Créer un sujet</a></li>
                            <li><a href="../deconnexion.php">Se deconnecter</a></li>
                        </ul><br>
                </div>      
            </div>
            <div class ="container">
                <div class ="row">
                    <div class = "col-xs-1"></div>
                    <div class = "col-xs-10">
                        <div class = "panel panel-info">
                            <div class = "panel-heading">
                                <h2 class = "text-center">Sujet</h2>
                            </div>
                            <div class = "panel-body">
                                <?php
                                    if(isset($_POST['demande'])){
                                        $demande = $_POST['demande'];
                                        $query = $bd->prepare('select * from sujet where categorie = ? order by date desc');
                                        $query->execute(array($demande));
                                        $req = $bd->prepare('select name from categories where id = ?');
                                        $req->execute(array($demande));
                                        $reqs=$req->fetch();
                                        if($query->rowCount() > 0)
                                        {
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
                                    <h4>Aucun sujet pour cette categorie</h4>
                                    <?php
                                } 
                                    }
                            elseif (isset($_SESSION['id_S']) and $_SESSION['id_S']!='') {
                                $id = $_SESSION['id_S'];
                                $query = $bd->prepare('select * from sujet where NNI = :nni or matricule = :matricule');
                                $query->execute(array(
                                    'nni' => $id,
                                    'matricule' => $id
                                ));
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
                                        <td><?php echo '<form action="afficher.php" method="post" ><input type="hidden" name="demande" value="'.$show['id'].'"><input type="submit" value="Commenter"></form>'; ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <?php
                                    $_SESSION['id_S'] = '';
                            }
                            else {
                                $query = $bd->query('select * from sujet order by categorie desc');
                            if($query->rowCount() > 0)
                            {
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
                                    <td><?php echo '<form action="afficher.php" method="post" ><input type="hidden" name="demande" value="'.$show['id'].'"><input type="submit" value="Commenter" class ="btn btn-info"></form>'; ?>
                                    </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                <?php
                    }
                    else {
                        ?>
                        <h4>Aucun sujet...</h4>
                        <?php
                    }
                    }  
                 ?>
        </body>
         
        </html>
<?php
}
else 
{
    redirectTo("../index.php");
}
?>   