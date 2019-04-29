<?php
session_start();
if(isset($_SESSION['matricule'])){
  $dest= 'homeEtudiant.php';
}
elseif (isset($_SESSION['nni'])) {
  $dest = 'homeProfesseur.php';
}
else {
  $dest = 'homeAdmin.php';
}
 ?>

        <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../dist/css/mystyle.css">
		<script type="text/javascript" src="../dist/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="../dist/css/style.css">

    <div class="container navigation">
                    <div class="row navigation ">
                        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" > <!-- creation dee la barre de navigation -->
                            <div class="navbar-header" ><!-- titre pour le div de la barre de navigation  -->
                                <?php echo '<a class="navbar-brand" href="'.$dest.'">INNOV-RIM</a>' ?><!--titre de la page  -->
                            </div>
                            <div class="navbar-collapse collapse navbar-right"><!--pour mettre le menu a droite -->
                                <ul class="nav navbar-nav">
                                    <li>
                                                                        
                                    </li>


                                </ul>

                            </div>

                        </nav>

                    </div>  <!--fin navigation row  -->
    </div> <!--fin navigation container  -->
