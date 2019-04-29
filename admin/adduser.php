<?php
  include("../nav.php");
  require("../function.php");
  $bd = connect();
  if(isset($_SESSION['email']) and isset($_SESSION['mdp']) and isset($_SESSION['pseudo'])){
  $pseudo = $_SESSION['pseudo'];
  $requete = $bd ->prepare('select * from admin where email = :mail ');
  $requete->execute(array(
    'mail'=> $pseudo
  ));
  $show = $requete->fetch();
    if($pseudo == $_SESSION['pseudo']){
      ?>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Ajouter un nouveau compte</title>
        </head>
        <body>
        <div class="container-fluid">
    <div class="row content">
      <div class="col-xs-3 sidenav">
        <div class ="panel panel-default panel-design">
          <h1 style = "position : relative;left:10px;"><?php echo $_SESSION['prenom'];?></h1>
          <br><br><br>
          
          <div class ="row">
            <div class = "col-xs-1"></div>
            <div class = "col-xs-9">
              <form method="post" action="result.php">
                <div class="input-group">
                  <input type="text" name="recherche" class="form-control" placeholder="rechercher un compte" style = "position : relative;right:15px;">
                    <span class="input-group-btn"><input class="btn btn-success" type="submit" value = "?" style = "position : relative;right:13.75px;"> 
                    </span>
                </div>
              </form>
            </div>
          </div>  

          <ul class="nav nav-pills nav-stacked">
            <li><a href="compte.php">Afficher tous les comptes</a></li>
            <li ><a href="../deconnexion.php">Se deconnecter</a></li>
          </ul><br>
        </div> 
      </div>
          <div class = "container">
            <div class = "row">
              <div class = "col-xs-2"></div>
              <div class = "col-xs-8">
                <div class="panel panel-info">
                  <div class ="panel-heading">
                    <h2 class = "text-center"> Ajouter un compte </h2>
                  </div>   
                  <div class = "panel-body">   
                    <form class="" action="../controlleur/adduser.php" method="post" onchange="check(this)">
                      <table class = "table">
                        <tr>
                          <td> <label for="choix">Type de compte:</label></td>
                          <td>
                              <select  name="choix" id="compte" class = "form-control">
                                <option value="professeur">Professeur</option>
                                <option value="etudiant">Etudiant</option>
                              </select>
                            </td>
                        </tr>
                        <tr>
                          <td><label for="nni"> NNI seulement pour le compte professeur:</label></td>
                          <td><input id="nni" type="text" name="nni" placeholder="Numero nationale d'identification*" class = "form-control"  /></td>
                        </tr>
                        <tr>
                          <td><label for="nom">Nom:</label></td>
                          <td><input id="nom" type="text" name="nom" placeholder="Nom*" class = "form-control" required/></td>
                        </tr>
                        <tr>
                          <td><label for="prenom">Prenom:</label></td>
                          <td><input type="text" name="prenom" placeholder="Prenom*" id="prenom" class = "form-control" required/></td>
                        </tr>
                        <tr>
                          <td><label for="mail">Mail:</label></td>
                          <td><input type="email" name="mail" placeholder="Email*" id="mail" class = "form-control" required/></td>
                        </tr>
                        <tr>
                          <td><label for="mdp">Mot de passe:</label></td>
                          <td><input type="password" name="mdp" placeholder="Mot de passe*" id="mdp" class = "form-control" required/></td>
                        </tr>
                          <td></td><br>
                          <td align="center"><input id="create" type="submit"  value="Creer le compte" class ="btn btn-info"></td>
                        </tr>
                      </table>
                    </form>
                  </div>  
                </div>        
              </div> 
              <div class = "col-xs-2"></div> 
            </div>
          </div>
        </div>
        </div>
        </body>
<?php include("../footer.php");?>
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
    <script>

      function check(form)
      {
          var create = document.getElementById('create');
          var tel = parseInt(form.nni.value);
          if(form.choix.value=='professeur'){

            if((isNaN(tel)!=true)&&(form.nni.value.length==10)) {
                create.disabled = false;
            }
            else
            {
                alert("Le numero nationale d'identification doit etre compose de chiffres et doit etre de longueur 10");
                create.disabled = true;
            }
          }
          else{
            create.disabled = false;
          }
      }
  </script>