<?php 
// 
require_once 'connect.php';
// vérification de connexion
if (!estConnecte()) {/* Si la personne ne remplit pas les conditions de la fonction estConnecte() alors on va la renvoyer vers la page connexion.php */
  header('location:connexion.php');
}

// 3 - Déconnexion

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){ /* si ds l'URL je récupère action = déconnexion */
  unset($_SESSION['membres']);
  $contenu .= "<div class=\"alert alert-success\">Vous avez bien été déconnecté</div>";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - Profil personnel</title>
  <!-- BOOTSWATCH CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css" integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>

<?php if(!estConnecte()) {
  echo  
  '<div class=\"alert alert-success\">
  Vous n\'êtes pas connecté, merci de bien vouloir vous rendre sur la page <a href=\"connection.php\"</a> pour accéder à votre profil. </div>';
} else{ ?>

  <div class="p-5 bg-primary">
      <div class="container">
          <h1 class="display-3 text-white">Profil de <?php echo $_SESSION['membres']['prenom'] . ' ' . $_SESSION['membres']['nom']; ?></h1>
          <!-- à partir du moment où un membre est connecté, ses infos sont passées dans la superglobale $_SESSION et on peut donc y accéder à n'importe quel moment et endroit du site -->
          <p class="lead text-white">Bienvenue sur votre profil
              <?php if (estAdmin()) {
                  echo "<small>-- Vous êtes admin</small>";
              } else {
                  echo "<small>-- Vous êtes connecté";
                  if ($_SESSION['membres']['civilite'] == 'f') {
                      echo "e";
                  }
                  echo " !</small>";
              } ?>
          </p>
      </div>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-8 mx-auto">
              <?php echo $contenu; ?>

              <div class="card">
                <div class="card-body">
                  <p class="card-text">Civilité : 
                    <?php if($_SESSION['membres']['civilite'] == 'm'){
                    echo "Homme";
                  }else {
                    echo "Femme";
                  } ?> </p>
                  
                  <address class="card-text fst-italic">Adresse<?php echo $_SESSION['membres']['adresse'] . '<br>' . $_SESSION['membres']['code_postal'] . ' ' . $_SESSION['membres']['ville']; ?></address>

                  <p class="card-text">Pseudo : <?php echo $_SESSION['membres']['pseudo']; ?></p>

                  <p class="card-text">E-mail : <?php echo $_SESSION['membres']['email']; ?></p>

                </div>
                <div class="card-footer text-muted">
                 <a href="profil.php?action=deconnexion" class="btn btn-sm  btn-outline-primary">Se déconnecter</a>
                </div>
              </div>

          </div>
      </div>
  </div>
  <?php }?>


  <!-- BOOTSWATCH JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>