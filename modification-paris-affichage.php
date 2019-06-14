<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 
    
	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if($_SESSION['id_rang'] == 1){
		header('Location: 404.php');
    }
    
    $paris = mysqli_query($bdd, 'SELECT id, titre, mise, choix1, choix2 FROM paris WHERE id='.$_POST['affichage'].' ORDER BY id DESC'); 
    $paris = mysqli_fetch_array($paris, MYSQLI_ASSOC);
    
    /* Participation totale */
    $paris_participationTotal = mysqli_query($bdd, "SELECT id, id_paris, id_membre, membre_choix FROM paris_participation ORDER BY id ASC");

    $ParticipantTotal = 0;
    foreach($paris_participationTotal as $donnees_participationTotal){
        if($donnees_participationTotal['id_paris'] == $paris['id']){
            $ParticipantTotal++;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Affichage du paris</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-paris.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-panel.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header-panel.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Affichage du paris</h1>

    <div class="box">    

        <!-- PARIS -->
        <div class="row">
            <div class="container text-center">
                <div class="offset-4 col-4 offset-4 rounded-top card-header bg-success">
                    <h3>Paris en cours :</h3>
                </div>
                <div class="offset-4 col-4 offset-4 rounded-bottom card-text bg-secondary">
                    <table class="width-100">
                        <tbody>
                            <tr>
                                <td><?php echo utf8_encode($paris['titre']); ?></td>
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
                        <h3><?php echo utf8_encode($paris['choix1']); ?></h3>
                    </div>
                    <div class="offset-2 col-4 offset-1 rounded-top card-header bg-danger">
                        <h3><?php echo utf8_encode($paris['choix2']); ?></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-1 col-4 rounded-bottom card-text bg-secondary">
                        <table class="width-100">
                            <tbody>
                                <?php
                                    $affichageChoix1 = $bdd->query("SELECT id, id_paris, id_membre, membre_choix FROM paris_participation WHERE id_paris=".$_POST['affichage']." ORDER BY id ASC"); 
                                
                                    foreach($affichageChoix1 as $donnees_affichageChoix1){ 
                                    $affichageMembreParticipantChoix1 = $bdd->query("SELECT id, pseudo FROM membres"); ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                foreach($affichageMembreParticipantChoix1 as $donnees_affichageMembreParticipantChoix1){
                                                    if($donnees_affichageChoix1['id_membre'] == $donnees_affichageMembreParticipantChoix1['id'] AND $donnees_affichageChoix1['membre_choix'] == "choix1" AND $paris['id'] == $donnees_affichageChoix1['id_paris']){
                                                        echo utf8_encode($donnees_affichageMembreParticipantChoix1['pseudo']);
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
                                    $affichageChoix2 = $bdd->query("SELECT id, id_paris, id_membre, membre_choix FROM paris_participation WHERE id_paris=".$_POST['affichage']." ORDER BY id ASC"); 
                                
                                    foreach($affichageChoix2 as $donnees_affichageChoix2){ 
                                    $affichageMembreParticipantChoix2 = $bdd->query("SELECT id, pseudo FROM membres"); ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                foreach($affichageMembreParticipantChoix2 as $donnees_affichageMembreParticipantChoix2){
                                                    if($donnees_affichageChoix2['id_membre'] == $donnees_affichageMembreParticipantChoix2['id'] AND $donnees_affichageChoix2['membre_choix'] == "choix2" AND $paris['id'] == $donnees_affichageChoix2['id_paris']){
                                                        echo utf8_encode($donnees_affichageMembreParticipantChoix2['pseudo']);
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
                                            $affichageParticipant1 = $bdd->query("SELECT id, id_paris, id_membre, membre_choix FROM paris_participation WHERE id_paris=".$_POST['affichage']." ORDER BY id ASC"); 

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
                                            $affichageParticipant2 = $bdd->query("SELECT id, id_paris, id_membre, membre_choix FROM paris_participation WHERE id_paris=".$_POST['affichage']." ORDER BY id ASC");

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

        <button type="button" onClick="document.location.href = document.referrer" class="btn btn-outline-light" id="Retour">Retour</button><br>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>