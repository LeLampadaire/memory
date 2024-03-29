﻿<?php
if(isset($_SESSION['idprofil'])){

  // Date du jour
  $aujourdhui=time("Y-m-d H:i:s");
  
  // Ajout de 2h (Quand on prends le temps, il est 2 heures en retard)
  $aujourdhui=$aujourdhui+7200;

  // Repasse en format date
  $aujourdhui=date("Y-m-d H:i:s",$aujourdhui);

  //News -> Messagerie
  $message = mysqli_query($bdd, 'SELECT COUNT(idMsg) AS Msg FROM tchat WHERE idProfil_recepteur = '.$_SESSION['idprofil'].' AND lu = 0;');
  $message = mysqli_fetch_array($message, MYSQLI_ASSOC);
  
  if($message['Msg'] != 0){
    $img_tchat = "icons/icons-32/tchat-new.png";
  }else{
    $img_tchat = "icons/icons-32/tchat.png";
  }

  //News -> Sondage
  $header_sondage = mysqli_query($bdd, "SELECT id, open, date_publication FROM sondage_questions ORDER BY date_publication DESC"); 
  $header_sondage = mysqli_fetch_array($header_sondage, MYSQLI_ASSOC);

  $vote_sondage = mysqli_query($bdd, 'SELECT * FROM sondage_reponse WHERE id_questions='.$header_sondage['id'].' AND id_membres='.$_SESSION['idprofil'].';'); 
  $vote_sondage = mysqli_fetch_array($vote_sondage, MYSQLI_ASSOC);

  $dateExpiSondage = new DateTime($header_sondage['date_publication']);
  $dateExpiSondage->add(new DateInterval('P15D'));
  
  if($vote_sondage == NULL AND $header_sondage['open'] == 1 AND $dateExpiSondage->format('Y-m-d H:i') > $aujourdhui){
    $img_sondage = "icons/icons-32/sondages-new.png";
  }else{
    $img_sondage = "icons/icons-32/sondages.png";
  }

  //News -> Popcorn
  $header_popcorn = mysqli_query($bdd, "SELECT id, date_film FROM popcorn ORDER BY id DESC"); 
  $header_popcorn = mysqli_fetch_array($header_popcorn, MYSQLI_ASSOC);

  $vote_popcorn = mysqli_query($bdd, 'SELECT * FROM popcorn_reponse WHERE id_popcorn='.$header_popcorn['id'].' AND id_membres='.$_SESSION['idprofil'].';'); 
  $vote_popcorn = mysqli_fetch_array($vote_popcorn, MYSQLI_ASSOC);

  $dateExpiPopcorn = new DateTime($header_popcorn['date_film']);

  if($vote_popcorn == NULL AND $dateExpiPopcorn->format('Y-m-d H:i') > $aujourdhui){
    $img_popcorn = "icons/icons-32/popcorn-new.png";
  }else{
    $img_popcorn = "icons/icons-32/popcorn.png";
  }

  //News -> Paris
  $header_paris = mysqli_query($bdd, "SELECT id, date_fin FROM paris ORDER BY id DESC"); 
  $header_paris = mysqli_fetch_array($header_paris, MYSQLI_ASSOC);

  $vote_paris = mysqli_query($bdd, 'SELECT * FROM paris_participation WHERE id_paris='.$header_paris['id'].' AND id_membres='.$_SESSION['idprofil'].';'); 
  $vote_paris = mysqli_fetch_array($vote_paris, MYSQLI_ASSOC);

  $dateExpiParis = new DateTime($header_paris['date_fin']);

  if($vote_paris == NULL AND $dateExpiParis->format('Y-m-d H:i') > $aujourdhui){
    $img_paris = "icons/icons-32/paris-new.png";
  }else{
    $img_paris = "icons/icons-32/paris.png";
  }

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

        #tchat{
          top: 280px;
          background-color: rgb(0, 175, 102);
          background-image: url('<?php echo $img_tchat ?>');
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
          background-color: rgb(23, 162, 184);
          background-image: url('<?php echo $img_paris ?>');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #profil{
          bottom: 115px;
          background-color: rgb(255,255,255);
          background-image: url('icons/icons-32/profil.png');
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
        
        #no-profil{
          bottom: 50px;
          background-color: rgb(255,255,255);
          background-image: url('icons/icons-32/profil.png');
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
          echo '<a href="tchat.php" id="tchat">Tchat</a>';
          echo '<a href="sondages.php" id="sondages">Sondages</a>';
          echo '<a href="popcorn.php" id="popcorn">Porcorn</a>';
          echo '<a href="paris.php" id="paris">Paris</a>'; 
          
          if($_SESSION['id_rang'] != 1){
            echo '<a href="index-profil.php" id="profil">Profil</a>'; 
            echo '<a href="panel.php" id="panel">Panel</a>';
          }else{
            echo '<a href="index-profil.php" id="no-profil">Profil</a>'; 
          }
        } ?>
    </div>
  </div>
</body>
  
</html>
