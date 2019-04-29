<?php
    include("nav.php");
    require("../function.php");
    if(isset($_SESSION['nni']) or isset($_SESSION['matricule'])){
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
            <?php
                $bd=connect();
                $query = $bd->query('select * from categories');
                if($query->rowCount() > 0){
            ?>

            <div class="row content">
            
                <div class="col-xs-2 sidenav compte">
                    <div class = "panel panel-default panel-design">
                        <h2 style = "position : relative;left:10px;"> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>  </h2>
                        <br><br><br>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="sujet.php">Afficher tous les sujets</a></li>
                            <li><a href="afficherSujet.php">Afficher vos sujets</a></li>
                            <li><a href="creerSujet.php">Créer un sujet</a></li>
                            <li><a href="../deconnexion.php">Se deconnecter</a></li>
                        </ul><br>
                </div>      
            </div>

            <div class ="container">
                <div class ="row">
                    
                    <div class = 'col-xs-10'>
                        <div class = "panel panel-info">
                            <div class = "panel-heading">
                                <h2 class = "text-center">Forum</h2>
                            </div>
                            <div class ="panel-body">
                                <table>
                            
                                    <?php
                                        while($show = $query->fetch()){
                                    ?>

                                    <tr>
                                        <td>
                                        <?php echo $show['name'];?>
                                        </td>
                                        <td>
                                        <?php
                                        echo '<form action="sujet.php" method="post"><input type="hidden" name="demande" value="'.$show['id'].'"><input type="submit"  value="Afficher les sujets" class = "btn btn-info" style ="position : relative;left:50px;"></form>';
                                        ?>
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
                                        <h4>Aucun sujet dans le forum....</h4>
                                        <?php
                                    }
                        
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class = 'col-xs-2'>
                </div>
            </div>
        </body>
    </html> 
    <?php  
        }
        else{
            redirectTo("../index.php");
            }
    ?>