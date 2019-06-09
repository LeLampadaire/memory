﻿<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
    
    $popcorn = mysqli_query($bdd, "SELECT id, option1, option2, option3, DATE_FORMAT(date_film, '%d/%m/%Y à %Hh%i') AS date_film_fr, film FROM popcorn ORDER BY id DESC"); 
    $popcorn = mysqli_fetch_array($popcorn, MYSQLI_ASSOC);
    $aujourdhui = new DateTime();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Popcorn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-popcorn.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Popcorn</h1>

    <div class="box">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-accueil-tab" data-toggle="tab" href="#nav-accueil" role="tab" aria-controls="nav-accueil" aria-selected="true">Accueil</a>
                <a class="nav-item nav-link" id="nav-film-tab" data-toggle="tab" href="#nav-film" role="tab" aria-controls="nav-film" aria-selected="false">Film</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-accueil" role="tabpanel" aria-labelledby="nav-accueil-tab">
                <div class="card-header">
                    <span style="font-size: 24px;"> Prochain event popcorn : </span>
                    <span style="font-size: 24px; font-weight: bolder;"><?php echo $popcorn['date_film_fr']; ?></span>
                </div>

                <div class="card-body">
                    <form>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="Radios" id="Radios1" value="option1" checked>
                                <?php echo utf8_encode($popcorn['option1']); ?>
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="Radios" id="Radios2" value="option2">
                                <?php echo utf8_encode($popcorn['option2']); ?>
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="Radios" id="Radios3" value="option3">
                                <?php echo utf8_encode($popcorn['option3']); ?>
                            </label>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="submit" value="Submit">Envoyé !</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-film" role="tabpanel" aria-labelledby="nav-film-tab">
                <iframe src="<?php echo utf8_encode($popcorn['film']); ?>" height="800px" width="100%"></iframe>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>