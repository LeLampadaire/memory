<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
    
    $paris = mysqli_query($bdd, "SELECT id, titre, mise, choix1, choix2, date_fin FROM paris ORDER BY id DESC"); 
    $paris = mysqli_fetch_array($paris, MYSQLI_ASSOC);

    /* Participation totale */
    $paris_participationTotal = mysqli_query($bdd, "SELECT id, id_paris, id_membres, membre_choix FROM paris_participation ORDER BY id ASC");

    $ParticipantTotal = 0;
    foreach($paris_participationTotal as $donnees_participationTotal){
        if($donnees_participationTotal['id_paris'] == $paris['id']){
            $ParticipantTotal++;
        }
    }

    // Date du jour
    $aujourdhui=time("Y-m-d H:i:s");
    
    // Ajout de 2h (Quand on prends le temps, il est 2 heures en retard)
    $aujourdhui=$aujourdhui+7200;

    // Repasse en format date
    $aujourdhui=date("Y-m-d H:i:s",$aujourdhui);
    
    $dateExpiParis = new DateTime($paris['date_fin']);

    if($dateExpiParis->format('Y-m-d H:i') > $aujourdhui){
        $notif = 1;
    }else{
        $notif = 0;
    }

    if(!empty($_POST)){
        $id = $_POST['id'];
        $choix = $_POST['choix'];
        mysqli_query($bdd, 'INSERT INTO paris_participation (id, id_paris, id_membres, membre_choix) VALUES (NULL, '.$id.', '.$idPseudo.', "'.$choix.'");');
        header('Location: paris.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo "$NomSite"; ?> - Paris</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-paris.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Paris</h1>

    <div class="box">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-accueil-tab" data-toggle="tab" href="#nav-accueil" role="tab" aria-controls="nav-accueil" aria-selected="true">Paris</a>
                <a class="nav-item nav-link" id="nav-film-tab" data-toggle="tab" href="#nav-film" role="tab" aria-controls="nav-film" aria-selected="false">Participation</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-accueil" role="tabpanel" aria-labelledby="nav-accueil-tab">

                <div class="container">
                    <br>
                        <!-- PARIS EN COURS -->
                        <div class="row">
                            <div class="container text-center">
                                <div class="offset-4 col-4 offset-4 rounded-top card-header bg-success">
                                    <h3>Paris en cours :</h3>
                                </div>
                                <div class="offset-4 col-4 offset-4 rounded-bottom card-text bg-secondary">
                                    <table class="width-100">
                                        <tbody>
                                            <tr>
                                                <td><?php echo $paris['titre'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br>
                        <!-- MISE & CAGNOTTE -->
                        <div class="row">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="offset-1 col-4 rounded-top card-header bg-info">
                                        <h3>Mise</h3>
                                    </div>
                                    <div class="offset-2 col-4 offset-1 rounded-top card-header bg-info">
                                        <h3>Cagnotte</h3>
                                        <div style="text-decoration: none underline; font-size: 10px; margin-top: -6px;">Divisé par le nombre de gagnant</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="offset-1 col-4 rounded-bottom card-text bg-secondary">
                                        <table class="width-100">
                                            <tbody>
                                                <tr>
                                                    <td><?php echo number_format($paris['mise'], 0, ',', ' '); ?> K</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="offset-2 col-4 offset-1 rounded-bottom card-text bg-secondary">
                                        <table class="width-100">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                        $Cagnotte = $ParticipantTotal * $paris['mise']; 
                                                        echo number_format($Cagnotte, 0, ',', ' ') ." K";
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <!-- XXXXXXX VS YYYYYYYY -->
                        <div class="row">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="offset-1 col-4 rounded-top card-header bg-danger">
                                        <h3><?php echo $paris['choix1'] ?></h3>
                                    </div>
                                    <div class="offset-2 col-4 offset-1 rounded-top card-header bg-danger">
                                        <h3><?php echo $paris['choix2'] ?></h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="offset-1 col-4 rounded-bottom card-text bg-secondary">
                                        <table class="width-100">
                                            <tbody>
                                                <?php
                                                    $affichageChoix1 = $bdd->query("SELECT id, id_paris, id_membres, membre_choix FROM paris_participation ORDER BY id ASC"); 
                                                
                                                    foreach($affichageChoix1 as $donnees_affichageChoix1){ 
                                                    $affichageMembreParticipantChoix1 = $bdd->query("SELECT id, pseudo FROM membres"); ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                foreach($affichageMembreParticipantChoix1 as $donnees_affichageMembreParticipantChoix1){
                                                                    if($donnees_affichageChoix1['id_membres'] == $donnees_affichageMembreParticipantChoix1['id'] AND $donnees_affichageChoix1['membre_choix'] == "choix1" AND $paris['id'] == $donnees_affichageChoix1['id_paris']){
                                                                        echo $donnees_affichageMembreParticipantChoix1['pseudo'];
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="offset-2 col-4 offset-1 rounded-bottom card-text bg-secondary">
                                        <table class="width-100">
                                            <tbody>
                                                <?php 
                                                    $affichageChoix2 = $bdd->query("SELECT id, id_paris, id_membres, membre_choix FROM paris_participation ORDER BY id ASC"); 
                                                
                                                    foreach($affichageChoix2 as $donnees_affichageChoix2){ 
                                                    $affichageMembreParticipantChoix2 = $bdd->query("SELECT id, pseudo FROM membres"); ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                foreach($affichageMembreParticipantChoix2 as $donnees_affichageMembreParticipantChoix2){
                                                                    if($donnees_affichageChoix2['id_membres'] == $donnees_affichageMembreParticipantChoix2['id'] AND $donnees_affichageChoix2['membre_choix'] == "choix2" AND $paris['id'] == $donnees_affichageChoix2['id_paris']){
                                                                        echo $donnees_affichageMembreParticipantChoix2['pseudo'];
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <!-- PARTICIPANTS & PARTICIPANTS -->
                        <div class="row">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="offset-1 col-4 rounded-top card-header bg-primary">
                                        <h3>Participants</h3>
                                    </div>
                                    <div class="offset-2 col-4 offset-1 rounded-top card-header bg-primary">
                                        <h3>Participants</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="offset-1 col-4 rounded-bottom card-text bg-secondary">
                                        <table class="width-100">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                            $affichageParticipant1 = $bdd->query("SELECT id, id_paris, id_membres, membre_choix FROM paris_participation ORDER BY id ASC"); 

                                                            $Participant1 = 0;
                                                            foreach($affichageParticipant1 as $donnees_affichageParticipant1){
                                                                if($donnees_affichageParticipant1['id_paris'] == $paris['id'] AND $donnees_affichageParticipant1['membre_choix'] == "choix1"){
                                                                    $Participant1++;
                                                                }
                                                            }
                                                            echo $Participant1;
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="offset-2 col-4 offset-1 rounded-bottom card-text bg-secondary">
                                        <table class="width-100">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                            $affichageParticipant2 = $bdd->query("SELECT id, id_paris, id_membres, membre_choix FROM paris_participation ORDER BY id ASC");

                                                            $Participant2 = 0;
                                                            foreach($affichageParticipant2 as $donnees_affichageParticipant2){
                                                                if($donnees_affichageParticipant2['id_paris'] == $paris['id'] AND $donnees_affichageParticipant2['membre_choix'] == "choix2"){
                                                                    $Participant2++;
                                                                }
                                                            }
                                                            echo $Participant2;
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <!-- PARTICIPATION TOTAL -->
                        <div class="row">
                            <div class="container text-center">
                                <div class="offset-4 col-4 offset-4 rounded-top card-header bg-warning">
                                    <h3>Participants total :</h3>
                                </div>
                                <div class="offset-4 col-4 offset-4 rounded-bottom card-text bg-secondary">
                                    <table class="width-100">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $ParticipantTotal; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

            <div class="tab-pane fade text-center" id="nav-film" role="tabpanel" aria-labelledby="nav-film-tab">
		    <br>
                <?php 
                    $vote = mysqli_query($bdd, 'SELECT * FROM paris_participation WHERE id_paris = '.$paris['id'].' AND id_membres = '.$idPseudo.'');
                    $vote = mysqli_fetch_array($vote, MYSQLI_ASSOC);
                ?>

                <form action="" method="POST">
                    <p><a href="paris.php" class="badge badge-danger tailleBadge">Paris en cours : "<?php echo $paris['titre'] ?>"</a></p>
                    <p>La mise est de : <span class="badge badge-warning">"<?php echo number_format($paris['mise'], 0, ',', ' '); ?> K"</span></p>
                    <p>Pour le moment la cagnotte est de : <span class="badge badge-warning">"<?php echo number_format($Cagnotte, 0, ',', ' '); ?> K"</span></p>
                    <p>Pour l'instant il y a <span class="badge badge-info">"<?php echo $ParticipantTotal; ?>"</span> participants.</p>
                    
                    <br>
                    <hr>
                    
                    <p>Si vous participez, vous réservez la somme de <span class="badge badge-warning">"<?php echo number_format($paris['mise'], 0, ',', ' '); ?> K"</span> pour participer au paris !</p>
                    <div class="row">
                        <div class="offset-5 col-1 bg-secondary border">
                            <label class="form-check-label" for="choix1" style="color: white;">
                                <input class="form-check-input" type="radio" name="choix" id="choix1" value="choix1" checked <?php if($notif == 0 OR $vote != NULL){ echo "disabled"; }?>>
                                <?php echo $paris['choix1']; ?>
                            </label>
                        </div>

                        <div class="col-1 bg-secondary border">
                            <label class="form-check-label" for="choix2" style="color: white;">
                                <input class="form-check-input" type="radio" name="choix" id="choix2" value="choix2" <?php if($notif == 0 OR $vote != NULL){ echo "disabled"; }?>>
                                <?php echo $paris['choix2']; ?>
                            </label>
                        </div>
                    </div>

                    <br>

                    <input type="hidden" value="<?php echo $paris['id']; ?>" name="id">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="checkKama" required><label class="form-check-label" for="checkKama"><strong>Confirmez votre participation !</strong></label></div>
                    <br>
                    <?php if($notif == 0 OR $vote != NULL){ 
                        echo '<button class="btn btn-danger" type="button" disabled>Déjà participez !</button>';
                    }else{
                        echo '<button class="btn btn-primary" type="submit">Participez !</button>';
                    } ?>
                </form>
                <br>
            </div>
        </div>
    </div>

    <br>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>