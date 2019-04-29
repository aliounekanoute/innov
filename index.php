<?php
session_start();
require("function.php");
if(isset($_SESSION['nni'])){
    redirectTo("professeur/homeProfesseur.php");
}
elseif(isset($_SESSION['matricule'])){
    redirectTo("etudiant/homeEtudiant.php");
} 
elseif(isset($_SESSION['pseudo'])){
    redirectTo("admin/homeAdmin.php");
}
else{
    ?>
    <!DOCTYPE html>
<html>
	<head>
        <title>INOV-RIM e-learning</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="dist/css/mystyle.css">
		<script type="text/javascript" src="dist/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="dist/css/style.css">
	</head>
	<body>
            <div class="container navigation">
                    <div class="row navigation ">
                        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" > <!-- creation dee la barre de navigation -->
                            <div class="navbar-header" ><!-- titre pour le div de la barre de navigation  -->
                                <a class="navbar-brand" href="index.php">INNOV-RIM</a><!--titre de la page  -->
                            </div>
                            <div class="navbar-collapse collapse navbar-right"><!--pour mettre le menu a droite -->

                            </div>

                        </nav>

                    </div>  <!--fin navigation row  -->
                </div> <!--fin navigation container  -->



        <div class="container container1">
            <div class="row container1">
                <div class="col-lg-9">
                    <div class="jumbotron">
                        <h1 class="display-4 title">Bienvenue dans l'espace INNOV-RIM</h1>
                        <p class="lead">Cet espace a été créer pour vous facilitez l'accés aux cours dispenser au niveau de l'association INNOV-RIM,
                             cependant vous ne pourriez accéder aux cours qui si vous etes membre du site pour cela,
                             il va vous falloir un compte d'utilisateur pour plus d'informations veuillez vous renseignez au niveau de l'association.<br>
                             Dans ce site vous auriez acces aux formations disponibles dans l'association  ainsi que toutes les notifications et publications
                        </p>
                    </div>
                </div><!--fin col container1 -->
                <div class = "col-xs-3">
                        <form method="post" action="login.php">
                            <div class="panel panel-info panel-design">
                                <div class="panel-heading">
                                    <h4 style = "font-weigth:bold">connectez-vous</h4>
                                </div>

                                <div class="form-group panel-connection">
                                    <label for="exampleInputEmail1" class = "label-index">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                                </div>
                                <div class="form-group panel-connection">
                                    <label for="exampleInputPassword1"  class = "label-index">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <button type="submit" class="btn btn-primary panel-button">Se connecter</button>
                            </div>
                        </form>
                </div>
            </div><!--fin row container1 -->
        </div> <!--fin container1 -->
			 <div class = "container content2">
                    <div class ="row content3">
                        <div class = "col-xs-9">
                            <div class = "panel panel-info panel-design">
                                <div class = "panel-heading">
                                    <h2>Formations</h2>
                                </div>
                                <div class = "panel-body">
                                        <div class = "row content1">
					                            <div class = "col-xs-1"></div>
                                                <div class = "col-xs-4">
                                                    <form method="POST" action = "" >
                                                        <input type = "button" class = "btn btn-info boutton" value = "Reseaux et maintenance">
                                                    </form>
                                                </div>
                                                <div class = "col-xs-2"></div>
                                                <div class = "col-xs-4">
                                                    <form method="POST" action = "">
                                                        <input type = "button" class = "btn btn-danger boutton" value = "Initiation a l'informatique">
                                                    </form>
                                                </div>
                                                <div class = "col-xs-1"></div>
                                            </div><br><br>


                                            <div class = "row content2">
                                                <div class = "col-xs-1"></div>
                                                <div class = "col-xs-4">
                                                    <form method="POST" action = "">
                                                        <input type = "button" class = "btn btn-secondary boutton" value ="Bureautique">
                                                    </form>
                                                </div>
                                                <div class = "col-xs-2"></div>
                                                <div class = "col-xs-4">
                                                    <form method="POST" action = "">
                                                        <input type = "button" class = "btn btn-primary boutton" value = "Multimedia">
                                                    </form>
                                                </div>
                                                <div class = "col-xs-1"></div>
                                            </div>
                                            <br><br>


                                            <div class = "row content3">
                                                <div class = "col-xs-1"></div>
                                                <div class = "col-xs-4">
                                                    <form method="POST" action = "">
                                                        <input type = "button" class = "btn btn-success boutton" value ="Developpement web">
                                                    </form>
                                                </div>
                                                <div class = "col-xs-2"></div>
                                                <div class = "col-xs-4">
                                                    <form method="POST" action = "">
                                                        <input type = "button" class = "btn btn-warning boutton" value = "Automatisme ou demotique et electronic">
                                                    </form>
                                                </div>
                                                <div class = "col-xs-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>



		<footer class="footer-side footer-default">
			<div class = "container">
				<div class = "row">
					<div class = "bottom-footer">
						<div class ="col-xs-5">
							<p class = "text-left"><small>@2018INNOV-RIM</small></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>
<?php
}
?>

