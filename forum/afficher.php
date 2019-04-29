<?php
include("nav.php");
require("../function.php");
$bd = connect();
if(isset($_SESSION['nni']) or isset($_SESSION['matricule'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
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
                        <li><a href="forum.php">Forum</a></li>
                        <li><a href="sujet.php">Afficher tous les sujets</a></li>
                        <li><a href="afficherSujet.php">Afficher vos sujets</a></li>
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
                                <h2 class = "text-center">Forum</h2>
                            </div>
                            <div class="panel-body">
                            <?php
                                    if(isset($_POST['demande'])){
                                        $id = $_POST['demande'];
                                        $_SESSION['id_sujet'] = $id;
                                        $query = $bd->prepare('select * from sujet where id = ?');
                                        $query->execute(array($id));
                                        $showS = $query->fetch();
                                        if($showS['NNI']!=NULL){
                                            $id_C = $showS['NNI'];
                                            $queryC = $bd->prepare('select * from professeur where NNI = ?');
                                            $queryC->execute(array($id_C));
                                            $showC = $queryC->fetch();
                                        }
                                        else{
                                            $id_C = $showS['matricule'];
                                            $queryC = $bd->prepare('select * from etudiant where matricule = ?');
                                            $queryC->execute(array($id_C));
                                            $showC = $queryC->fetch();
                                        }
                                        $requete = $bd->prepare('select * from postesujet where id_sujet = ?');
                                        $requete->execute(array($id));
                                        ?>
                                        <table class="table">
                                            <tr>
                                                <td class ="text-center" colspan="3" style = "background-color:#d2d2d2;">
                                                <strong>Titre du sujet: </strong><?php echo $showS['titre']; ?>
                                                </td>
                                            </tr>
                                            <tr style = "background-color : white;">
                                            <td colspan="3"></td>
                                            </tr>
                                            <tr>
                                                <td style = "background-color:chocolate;"><?php echo $showC['prenom'].' '.$showC['nom']; ?></td>
                                                <td style = "background-color:chocolate;" colspan="2"><?php echo $showS['objet']; ?></td>
                                            </tr>
                                            <tr style = "background-color : white;">
                                                <td></td>
                                            <td align="center"><h4>Commentaires</h4></td>
                                            <td></td>
                                            </tr>
                                                <?php
                                                if($requete->rowCount() > 0){
                                                    while($showP = $requete->fetch()){
                                                        if($showP['NNI']!=NULL){
                                                            $id_C = $showP['NNI'];
                                                            $queryC = $bd->prepare('select * from professeur where NNI = ?');
                                                            $queryC->execute(array($id_C));
                                                            $showC = $queryC->fetch();
                                                        }
                                                        else{
                                                            $id_C = $showP['matricule'];
                                                            $queryC = $bd->prepare('select * from etudiant where matricule = ?');
                                                            $queryC->execute(array($id_C));
                                                            $showC = $queryC->fetch();
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $showC['prenom'].' '.$showC['nom']; ?></td>
                                                            <td><?php echo $showP['contenu']; ?></td>
                                                            <td>Posté le : <?php echo $showP['date']; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    }
                                                    else{
                                                        ?>
                                                        <tr>
                                                            <td>Aucun commentaire...</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>
                                                <tr>
                                                    <form action="poster.php" method="post">
                                                        <td colspan="2">
                                                            <textarea name="poste" id="" cols="30" rows="2" placeholder="Commenter..."  class ="form-control"></textarea>
                                                            <?php echo '<input type="hidden" name="id_sujet" value="'.$id.'">'; ?>
                                                        </td>
                                                        <td>
                                                            <input type="submit" value="Commenter" class ="btn btn-info">
                                                        </td>
                                                    </form>
                                                </tr>
                                        </table>
                                        <?php
                                    }
                                    elseif($_SESSION['id_S']!=''){
                                        $id = $_SESSION['id_S'];
                                        $_SESSION['id_sujet'] = $id;
                                        $query = $bd->prepare('select * from sujet where id = ?');
                                        $query->execute(array($id));
                                        $showS = $query->fetch();
                                        if($showS['NNI']!=NULL){
                                            $id_C = $showS['NNI'];
                                            $queryC = $bd->prepare('select * from professeur where NNI = ?');
                                            $queryC->execute(array($id_C));
                                            $showC = $queryC->fetch();
                                        }
                                        else{
                                            $id_C = $showS['matricule'];
                                            $queryC = $bd->prepare('select * from etudiant where matricule = ?');
                                            $queryC->execute(array($id_C));
                                            $showC = $queryC->fetch();
                                        }
                                        $requete = $bd->prepare('select * from postesujet where id_sujet = ?');
                                        $requete->execute(array($id));
                                        ?>
                                        <table class = "table">
                                            <tr>
                                                <td class ="text-center" colspan="3" style = "background-color:#d2d2d2;">
                                                <strong>Titre du sujet: </strong><?php echo $showS['titre']; ?>
                                                </td>
                                            </tr>
                                            <tr style = "background-color : white;">
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr>
                                                <td style = "background-color:chocolate;"><?php echo $showC['prenom'].' '.$showC['nom']; ?></td>
                                                <td style = "background-color:chocolate;" colspan="2"><?php echo $showS['objet']; ?></td>
                                            </tr>
                                            <tr style = "background-color : white;">
                                                <td></td>
                                            <td align="center"><h4>Commentaires</h4></td>
                                            <td></td>
                                            </tr>
                                                <?php
                                                if($requete->rowCount() > 0){
                                                    while($showP = $requete->fetch()){
                                                        if($showP['NNI']!=NULL){
                                                            $id_C = $showP['NNI'];
                                                            $queryC = $bd->prepare('select * from professeur where NNI = ?');
                                                            $queryC->execute(array($id_C));
                                                            $showC = $queryC->fetch();
                                                        }
                                                        else{
                                                            $id_C = $showP['matricule'];
                                                            $queryC = $bd->prepare('select * from etudiant where matricule = ?');
                                                            $queryC->execute(array($id_C));
                                                            $showC = $queryC->fetch();
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $showC['prenom'].' '.$showC['nom']; ?></td>
                                                            <td><?php echo $showP['contenu']; ?></td>
                                                            <td>Posté le : <?php echo $showP['date']; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    }
                                                    else{
                                                        ?>
                                                        <tr>
                                                            <td>Aucun commentaire...</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>
                                                <tr>
                                                    <form action="poster.php" method="post">
                                                        <td colspan="2">
                                                            <textarea name="poste" id="" cols="30" rows="2" placeholder="Commenter..."  class ="form-control" ></textarea>
                                                            <?php echo '<input type="hidden" name="id_sujet" value="'.$id.'">'; ?>
                                                        </td>
                                                        <td>
                                                            <input type="submit" value="Commenter" class ="btn btn-info">
                                                        </td>
                                                    </form>
                                                </tr>
                                        </table>
                                        <?php
                                    }
                                    else{
                                        redirectTo("forum.php");
                                    }
                                }

                                else{
                                    redirectTo("../index.php");
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
