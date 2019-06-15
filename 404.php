<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Erreur 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-erreur.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require_once('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Erreur 404</h1>
    
    <div class="box">
        <p class="badge badge-pill badge-danger" style="font-size: 25px;">Vous êtes sur une page d'erreur !</p>

            <div class="form-group col-md-12">
                <form action="index.php" method="POST">
                    <button type="submit" class="btn btn-outline-danger">Acceuil</button>
                </form>
            </div>

            <?php if(!empty($_SESSION)){ ?>

            <div class="form-group col-md-12">
                <form action="index-profil.php" method="POST">
                    <button type="submit" class="btn btn-outline-light">Profil</button>
                </form>
            </div>
            
            <?php }else{ ?>

            <div class="form-group col-md-12">
                <form action="connexion.php" method="POST">
                    <button type="submit" class="btn btn-outline-warning">Connexion</button>
                </form>
            </div>
    
            <?php } ?>

    </div>

    <!-- FOOTER -->
    <?php require_once('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>