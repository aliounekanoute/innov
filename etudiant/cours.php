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
            
                <div class="col-xs-2 sidenav compte">
                    <div class = "panel panel-default panel-design">
                        <h2 style = "position : relative;left:10px;"> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'];?>  </h2>
                        <br><br><br>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="../forum/forum.php">Forum</a></li>
                            <li><a href="../deconnexion.php">Se deconnecter</a></li>
                        </ul><br>
                </div>      
             </div>
            <div class ="row content2">
                <div class = "col-xs-2">

                </div>
                
                <div class = "container content2">
                    <div class = "col-xs-10">
                        <div class = "panel panel-info panel-design">
                                <div class = "panel-heading">
                                    <h3> Formations</h3>
                                </div>
                                <div class = "panel-body">
                                    <div class = "row content1">
                                        <div class = "col-xs-1"></div>
                                        <div class = "col-xs-4">
                                            <form method="POST" action = "show.php">
                                                    <input type = "submit" name="demande" class = "btn btn-info boutton" value = "Reseaux et maintenance">
                                            </form>
                                        </div>
                                        <div class = "col-xs-2"></div>
                                        <div class = "col-xs-4">
                                            <form method="POST" action = "show.php">
                                                <input type = "submit" name="demande" class = "btn btn-danger boutton" value = "Initiation a l'informatique">
                                            </form>
                                        </div>
                                        
                                    </div><br><br>


                                    <div class = "row content2">
                                        <div class = "col-xs-1"></div>
                                            <div class = "col-xs-4">
                                                <form method="post" action = "show.php">
                                                    <input type = "submit" name="demande" class = "btn btn-secondary boutton" value ="Bureautique">
                                                </form>
                                            </div>
                                            <div class = "col-xs-2"></div>
                                            <div class = "col-xs-4">
                                                <form method="POST" action = "show.php">
                                                    <input type = "submit" name="demande" class = "btn btn-primary boutton" value = "Multimedia">
                                                </form>
                                            </div>
                                            <div class = "col-xs-1"></div>
                                        </div>
                                        <br><br>


                                        <div class = "row content3">
                                            <div class = "col-xs-1"></div>
                                            <div class = "col-xs-4">
                                                <form method="POST" action = "">
                                                    <input type = "submit" class = "btn btn-success boutton" value ="Developpement web">
                                                </form>
                                            </div>
                                            <div class = "col-xs-2"></div>
                                            <div class = "col-xs-4">
                                                <form method="POST" action = "">
                                                    <input type = "submit" class = "btn btn-warning boutton" value = "Automatisme ou demotique et electronic">
                                                </form>
                                            </div>
                                            <div class = "col-xs-1"></div>
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
 ?>
<?php   include("../footer.php");?>
