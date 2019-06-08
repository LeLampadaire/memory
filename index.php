<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

    $accueil = mysqli_query($bdd, "SELECT id, titre, contenu, auteur, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%i:%s') AS date_publication_fr FROM accueil ORDER BY date_publication DESC"); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-index.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Accueil</h1>
    
    <?php foreach($accueil as $donnees){ ?>
        <div class="box">
            <?php 
                echo "<h3>" . $donnees['titre'] . "</h3>"; 
                echo $donnees['contenu'];
            ?>
            <div class="datePublication text-muted">
                <?php echo "Posté le " .$donnees['date_publication_fr']; ?>
            </div>
        </div>
    <?php } ?>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>