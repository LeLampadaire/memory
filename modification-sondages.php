<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 
    
	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if($_SESSION['id_rang'] == 1){
		header('Location: 404.php');
    }

    $error = -1;
    
    if(!empty($_POST['question'])){
        
        $question = $_POST['question'];

        if(empty($_POST['choix1'])){
            $choix1 = NULL;
        }else{
            $choix1 = $_POST['choix1'];
        }
        
        if(empty($_POST['choix2'])){
            $choix2 = NULL;
        }else{
            $choix2 = $_POST['choix2'];
        }
        
        if(empty($_POST['choix3'])){
            $choix3 = NULL;
        }else{
            $choix3 = $_POST['choix3'];
        }

        $date = date("Y-m-d");

        if($question != NULL){
            mysqli_query($bdd, 'INSERT INTO sondage_questions (id, titre, open, option1, option2, option3, date_publication) VALUES (NULL, "'.utf8_decode($question).'", 1,  "'.utf8_decode($choix1).'", "'.utf8_decode($choix2).'", "'.utf8_decode($choix3).'",  "'.$date.'");');
            $max_id = mysqli_query($bdd, 'SELECT * FROM sondage_questions WHERE id = (SELECT MAX(id) FROM sondage_questions);');
            $max_id = mysqli_fetch_array($max_id, MYSQLI_ASSOC);

            if(empty($max_id['option1'])){
                mysqli_query($bdd, 'UPDATE sondage_questions SET option1 = NULL WHERE sondage_questions.id = '.$max_id['id'].';');
            }
            if(empty($max_id['option2'])){
                mysqli_query($bdd, 'UPDATE sondage_questions SET option2 = NULL WHERE sondage_questions.id = '.$max_id['id'].';');
            }
            if(empty($max_id['option3'])){
                mysqli_query($bdd, 'UPDATE sondage_questions SET option3 = NULL WHERE sondage_questions.id = '.$max_id['id'].';');
            }
            $error = 1;
        }else{
            $error = 0;
        }
    }else if(!empty($_POST['button'])){
        if($_POST['open'] == '1'){
            mysqli_query($bdd, 'UPDATE sondage_questions SET open = 0 WHERE id = '.(int)$_POST['id'].';');
        }else if($_POST['open'] == '0'){
            mysqli_query($bdd, 'UPDATE sondage_questions SET open = 1 WHERE id = '.(int)$_POST['id'].';');
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Sondages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-panel.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header-panel.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Ajout et modification d'un sondage</h1>

    <div class="box">
        
        <div class="form-row">
            <!-- Ajout d'un sondage -->
            <div class="form-group col-md-6">
                <form action="" method="POST">
                    <h2>Ajout :</h2>
                    <?php
                        if ($error == 0) {
                            echo "<div class='alert alert-danger' role='alert'>Erreur dans l'ajout.</div>";
                        }else if($error == 1){
                            echo "<div class='alert alert-success' role='alert'>Sondage ajouté avec succès !</div>";
                        }
                    ?>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="question">Question*</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Question ..." aria-label="question" aria-describedby="question" name="question">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="choix1">Choix 1</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Choix 1 ..." aria-label="choix1" aria-describedby="choix1" name="choix1">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="choix2">Choix 2</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Choix 2 ..." aria-label="choix2" aria-describedby="choix2" name="choix2">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="choix3">Choix 3</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Choix 3 ..." aria-label="choix3" aria-describedby="choix3" name="choix3">
                    </div>

                    <p class="text-muted text-left">* Champs obligatoire</p>
                    
                    <button class="btn btn-primary" type="submit">Création du sondage !</button>
                </form>
                
            </div>

            <!-- Affichage des sondages -->
            <div class="form-group col-md-6">
                <h2>Modification :</h2>
                <?php 
                    $affichage = mysqli_query($bdd, 'SELECT id, titre, open FROM sondage_questions ORDER BY id DESC;');

                    foreach($affichage as $donnees){ ?>

                        <div class="input-group box-affichage" id="border">
                            <div class="input-group-prepend" style="width: 385px;">
                                <span><?php echo utf8_encode($donnees['titre']); ?></span>
                            </div>
                            
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $donnees['id']; ?>" name="id">
                                <input type="hidden" value="<?php echo $donnees['open']; ?>" name="open">
                                <?php if($donnees['open'] == '1'){
                                    echo '<button type="submit" class="btn btn-success" name="button" value="1">Ouvert</button>';
                                }else{
                                    echo '<button type="submit" class="btn btn-danger" name="button" value="1">Fermé&nbsp;</button>';
                                } ?>
                            </form>
                            
                            <form action="modification-sondages-id.php" method="POST">
                                <input type="hidden" value="<?php echo $donnees['id']; ?>" name="modification">
                                <button class="btn btn-primary" type="submit">Modification</button>
                            </form>
                        </div>
                        <br>
                        
                <?php } ?>
            </div>
    
        </div>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>