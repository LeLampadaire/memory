<?php 
if(isset($_SESSION['idprofil'])){
  // Date du jour
  $aujourdhui = new DateTime();

  //News -> Messagerie

  $message = mysqli_query($bdd, 'SELECT COUNT(idMsg) AS Msg FROM tchat WHERE idProfil_recepteur = '.$_SESSION['idprofil'].' AND lu = 0;');
  $message = mysqli_fetch_array($message, MYSQLI_ASSOC);
  
  if($message['Msg'] != 0){
    $img_messagerie = "icons/icons-32/messagerie-new.png";
  }else{
    $img_messagerie = "icons/icons-32/messagerie.png";
  }

  //News -> Sondage

  $header_sondage = mysqli_query($bdd, "SELECT id, date_publication FROM sondage_questions ORDER BY date_publication DESC"); 
  $header_sondage = mysqli_fetch_array($header_sondage, MYSQLI_ASSOC);

  $dateExpiSondage = new DateTime($header_sondage['date_publication']);
  $dateExpiSondage->add(new DateInterval('P15D'));

  if($dateExpiSondage->format('Y-m-d') > $aujourdhui->format('Y-m-d')){
    $img_sondage = "icons/icons-32/sondages-new.png";
  }else{
    $img_sondage = "icons/icons-32/sondages.png";
  }

  //News -> Popcorn

  $header_popcorn = mysqli_query($bdd, "SELECT id, date_film FROM popcorn ORDER BY id DESC"); 
  $header_popcorn = mysqli_fetch_array($header_popcorn, MYSQLI_ASSOC);

  $dateExpiPopcorn = new DateTime($header_popcorn['date_film']);
  $dateExpiPopcorn->add(new DateInterval('P7D'));

  if($dateExpiPopcorn->format('Y-m-d') > $aujourdhui->format('Y-m-d')){
    $img_popcorn = "icons/icons-32/popcorn-new.png";
  }else{
    $img_popcorn = "icons/icons-32/popcorn.png";
  }

  //News -> Paris
  $header_paris = mysqli_query($bdd, "SELECT id, date_fin FROM paris ORDER BY id DESC"); 
  $header_paris = mysqli_fetch_array($header_paris, MYSQLI_ASSOC);

  $dateExpiParis = new DateTime($header_paris['date_fin']);

  if($dateExpiParis->format('Y-m-d') > $aujourdhui->format('Y-m-d')){
    $img_paris = "icons/icons-32/paris-new.png";
  }else{
    $img_paris = "icons/icons-32/paris.png";
  }

  //Panel
  $panel = mysqli_query($bdd, 'SELECT id_rang FROM membres WHERE id='.$_SESSION['idprofil'].';');
  $panel = mysqli_fetch_array($panel, MYSQLI_ASSOC);
  $connexion = 1;

}else{
  $connexion = 0;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .fondMenu{
          position: fixed;
          z-index: 3;
	        top: -35px;
          left: 0;
          background-color: rgba(0, 0, 0, 0.6);
          width: 120px;
          height: 105%;
        }

        #mySidenav a {
          position: fixed;
          left: -120px;
          z-index: 3;
          transition: 0.3s;
          padding: 15px;
          width: 180px;
          text-decoration: none;
          font-size: 20px;
          color: black;
          border-radius: 0 10px 10px 0;
        }
          
        #mySidenav a:hover {
          left: 0;
        }

        #accueil{
          top: 20px;
          background-color: rgb(255, 0, 0);
          background-image: url('icons/icons-32/dashboard.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
          
        #membres{
          top: 85px;
          background-color: rgb(255, 115, 0);
          background-image: url('icons/icons-32/membres.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
          
        #statistiques{
          top: 150px;
          background-color: rgb(245, 224, 35);
          background-image: url('icons/icons-32/statistique.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
          
        #metiers{
          top: 215px;
          background-color: rgb(51, 255, 0);
          background-image: url('icons/icons-32/metiers.png');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #messagerie{
          top: 280px;
          background-color: rgb(0, 175, 102);
          background-image: url('<?php echo $img_messagerie ?>');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #sondages{
          top: 345px;
          background-color: rgb(0, 238, 255);
          background-image: url('<?php echo $img_sondage ?>');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #popcorn{
          top: 410px;
          background-color: rgb(0, 119, 255);
          background-image: url('<?php echo $img_popcorn ?>');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #paris{
          top: 475px;
          background-color: rgb(35, 38, 245);
          background-image: url('<?php echo $img_paris ?>');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #panel{
          bottom: 50px;
          background-color: rgb(140, 0, 255);
          background-image: url('icons/icons-32/panel.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
    </style>
  </head>
<body>
  <div class="fondMenu">
    <div id="mySidenav" class="sidenav">
      <a href="index.php" id="accueil">Accueil</a>
        <?php if($connexion == 1){ 
          echo '<a href="membres.php" id="membres">Membres</a>';
          echo '<a href="statistiques.php" id="statistiques">Statistiques</a>';
          echo '<a href="metiers.php" id="metiers">Métiers</a>';
          echo '<a href="tchat.php" id="messagerie">Messagerie</a>';
          echo '<a href="sondages.php" id="sondages">Sondages</a>';
          echo '<a href="popcorn.php" id="popcorn">Porcorn</a>';
          echo '<a href="paris.php" id="paris">Paris</a>'; 
          
          if($panel['id_rang'] != 1){
            echo '<a href="panel.php" id="panel">Panel</a>';
          }
        }else{
          echo '<a href="connexion.php" id="membres">Connexion</a>';
        } ?>
    </div>
  </div>
</body>
  
</html>
