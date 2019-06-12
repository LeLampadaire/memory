<?php session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

    if(isset($_GET['idprofil']) && !empty($_GET['idprofil'])) {
        $idprofil = $_GET['idprofil'];
    }else{
        header('Location: 404.php');
    }
    
	$donnee_profil = mysqli_query($bdd, 'SELECT * FROM membres WHERE id = '.$idprofil.';');
    $donnee_profil = mysqli_fetch_array($donnee_profil, MYSQLI_ASSOC);
    
    $id = $_GET['idprofil'];
    $classe_principale = $donnee_profil['classe_principale'];
    $pseudo = $donnee_profil['pseudo'];
    $bio = utf8_encode($donnee_profil['bio']);
    $prenom = utf8_encode($donnee_profil['prenom']);
    $etude = utf8_encode($donnee_profil['etude']);
    $travail = utf8_encode($donnee_profil['travail']);
    $region = utf8_encode($donnee_profil['region']);
    $date_inscription = strftime ("%d/%m/%Y à %H:%m",strtotime($donnee_profil['date_inscription']));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite. ' - ' . $pseudo; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-profil.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require_once('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Profil de <?php echo $pseudo; ?></h1>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="card box">
                
                <div>
                    <img src="<?php echo $classe_principale; ?>" class="card-img-top logo" alt="Classe_Principale">
                </div>

                <div class="card-body">
                    <h4 class="card-title"><?php echo $pseudo; ?></h4>
                    <p class="card-text"><?php echo $bio; ?></p>
                </div>

                <ul class="list-group list-group-flush">
                    <?php if($prenom != NULL){ ?><li class="list-group-item" id="info">Prénom : <?php echo $prenom; ?></li><?php } ?>
                    <?php if($etude != NULL){ ?><li class="list-group-item" id="info">Etude : <?php echo $etude; ?></li><?php } ?>
                    <?php if($travail != NULL){ ?><li class="list-group-item" id="info">Travail : <?php echo $travail; ?></li><?php } ?>
                    <?php if($region != NULL){ ?><li class="list-group-item" id="info">Region : <?php echo $region; ?></li><?php } ?>
                </ul>

                <div class="card-body">
                    Date d'inscription : <br>
                    <a href="#" class="card-link"><?php echo $date_inscription; ?></a>
                </div>
            
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require_once('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>