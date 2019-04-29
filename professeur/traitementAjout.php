
<?php
require("../function.php");
$bd=connect();
session_start();
if(isset($_SESSION['email']) and isset($_SESSION['mdp']) and isset($_SESSION['nni'])){
    $nni = $_SESSION['nni'];
    $requete = $bd->prepare('select * from professeur where NNI = :nni');
    $requete->execute(array('nni' => $nni
                      ));
    $show = $requete->fetch();
  if($nni == $show['NNI']){
    $choix=$_POST['choix'];
    $titre=$_POST['titre'];
    if(!empty($_FILES)  )
    {


        $file_name= $_FILES['fichier']['name'];
        $file_extension= strrchr($file_name,".");

        $file_tpm_name = $_FILES['fichier']['tmp_name'];
        $file_dest = '../cours/'.$file_name;

        $extensions_autorisees= array('.pdf','.PDF');

        if(in_array( $file_extension, $extensions_autorisees))
        {
            if(move_uploaded_file($file_tpm_name,$file_dest))
            {//(titre,fichier,categories)
                $requete =$bd->prepare('insert into categories (name) values (?)');
                $requete->execute(array($choix));
                $q=$bd->prepare('select * from categories where name = ?');
                $q->execute(array($choix));
                $qs=$q->fetch();
                $req=$bd->prepare('insert into cours (id_cat,NNI,titre,fichier) values(?,?,?,?)');
                $req->execute(array($qs['id'],$nni,$titre,$file_dest));
                echo 'fichier envoyé avec succès';
                redirectTo("show.php");

            }else
            {
                echo "une erreur est survenue lors de l'envoi du fichier";
            }

        }else
        {
            echo 'seuls les fichiers PDF sont autorisés <a href="ajouterCours.php">Reésayer</a>';
        }

    }
  }
  else{
    redirectTo("../index.php");
}
}
else{
  redirectTo("../index.php");

}
   /* $requete = $bd->query('SELECT titre , fichier FROM cours ');

    while($data = $req->fetch())
    {
        echo $data['titre'].' : '.'<a href="'.$data['fichier'].'">télécharger '.$data['titre'].'</a><br';
    }*/
?>




























?>
