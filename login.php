<?php
session_start();
require("function.php");
$db = connect();
//recupere les donnee saisi par l'utilisateur
if( isset($_POST['email']) && isset($_POST['password']) )
{
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);


// echo $email;

//rechercher dans la table d'etudiant
$resultEtudiant = $db->query("select * from etudiant  where email = '". $email ."' and password = '". $password ."'");
$resultProfesseur = $db->query("select * from professeur  where email = '". $email ."' and password = '". $password ."'");
$resultAdmin = $db->query("select * from administrateur  where email = '". $email ."' and password = '". $password ."'");

if ($resultEtudiant->rowCount() > 0)
{
    // output data of each row
    // while($row = mysqli_fetch_assoc($result))
    // {
    //     print_r($row);
    // }
    echo "l'utilisateur exist ";
    $donnee = $resultEtudiant->fetch();
    $_SESSION['email']=$email;
    $_SESSION['mdp'] = $password;
    $_SESSION['matricule'] = $donnee['matricule'];
    $_SESSION['prenom'] = $donnee['prenom'];
    $_SESSION['nom'] = $donnee['nom'];
    redirectTo('etudiant/homeEtudiant.php');
}
elseif($resultProfesseur->rowCount() > 0)
{
    echo "le prof exist ";
    $donnee = $resultProfesseur->fetch();
    $_SESSION['email']=$email;
    $_SESSION['mdp'] = $password;
    $_SESSION['nni'] = $donnee['NNI'];
    $_SESSION['prenom'] = $donnee['prenom'];
    $_SESSION['nom'] = $donnee['nom'];
    redirectTo('professeur/homeProfesseur.php');
}
else if ($resultAdmin->rowCount() > 0)
{
    
    $donnee = $resultAdmin->fetch();
    $_SESSION['email']=$email;
    $_SESSION['mdp'] = $password;
    $_SESSION['pseudo'] = $donnee['pseudo'];
    $_SESSION['prenom']=$donnee['prenom'];
    $_SESSION['nom'] = $donnee['nom'];
    redirectTo('admin/homeAdmin.php');
}
else
{
    redirectTo('./index.php');
}

}
else
{
    redirectTo('./index.php');
}
