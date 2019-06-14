<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-index.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require_once('header-profil.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page" style="color: rgb(255, 0, 0);">Panel profil</h1>

    <div class="box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <iframe src="https://discordapp.com/widget?id=245615623374110720&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
                </div>

                <div class="col-8">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require_once('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>