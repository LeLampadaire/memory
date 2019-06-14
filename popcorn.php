<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
    
    $popcorn = mysqli_query($bdd, "SELECT id, option1, option2, option3, date_film, film FROM popcorn ORDER BY id DESC"); 
    $popcorn = mysqli_fetch_array($popcorn, MYSQLI_ASSOC);

    // Date du jour
    $aujourdhui=time("Y-m-d H:i:s");

    // Ajout de 2h (Quand on prends le temps, il est 2 heures en retard)
    $aujourdhui=$aujourdhui+7200;

    // Repasse en format date
    $aujourdhui=date("Y-m-d H:i:s",$aujourdhui);
    
    $dateExpiParis = new DateTime($popcorn['date_film']);

    if($dateExpiParis->format('Y-m-d H:i') > $aujourdhui){
        $notif = 1;
    }else{
        $notif = 0;
    }

    $affichageDate = $dateExpiParis->format('d/m/Y à H:i');

    if(!empty($_POST)){
        $id = $_POST['id'];
        $option = $_POST['option'];
        mysqli_query($bdd, 'INSERT INTO popcorn_reponse (id, id_popcorn, choix, id_membres) VALUES (NULL, '.$id.', "'.$option.'", '.$idPseudo.');');
    }
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

    <h1 class="titre-page" style="color: rgb(0, 119, 255);">Popcorn</h1>

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
                    <span style="font-size: 24px; font-weight: bolder;"><?php echo $affichageDate; ?></span>
                </div>

                <div class="card-body">
                    <?php 
                        $vote = mysqli_query($bdd, 'SELECT * FROM popcorn_reponse WHERE id_popcorn = '.$popcorn['id'].' AND id_membres = '.$idPseudo.'');
                        $vote = mysqli_fetch_array($vote, MYSQLI_ASSOC);
                    ?>
                    <form action="" method="POST">
                    
                        <?php if($popcorn['option1'] != NULL){ ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="option" value="option1" checked <?php if($notif == 0 OR $vote != NULL){ echo "disabled"; }?>>
                                    <?php echo utf8_encode($popcorn['option1']); ?>
                                </label>
                            </div>
                        <?php } ?>

                        <?php if($popcorn['option2'] != NULL){ ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="option" value="option2" <?php if($notif == 0 OR $vote != NULL){ echo "disabled"; }?>>
                                    <?php echo utf8_encode($popcorn['option2']); ?>
                                </label>
                            </div>
                        <?php } ?>

                        <?php if($popcorn['option3'] != NULL){ ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="option" value="option3" <?php if($notif == 0 OR $vote != NULL){ echo "disabled"; }?>>
                                    <?php echo utf8_encode($popcorn['option3']); ?>
                                </label>
                            </div>
                        <?php } ?>

                        <br>
                        <input type="hidden" value="<?php echo $popcorn['id']; ?>" name="id">
                        <?php if($notif == 0 OR $vote != NULL){ 
                            echo '<button class="btn btn-danger" type="button" disabled>Déjà voté !</button>';
                        }else{
                            echo '<button class="btn btn-primary" type="submit">Votez !</button>';
                        } ?>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-film" role="tabpanel" aria-labelledby="nav-film-tab">
                <iframe src="<?php echo utf8_encode($popcorn['film']); ?>" height="800px" width="100%" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>