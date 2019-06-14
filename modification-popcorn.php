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

    if(!empty($_POST['date'])){
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

        if(empty($_POST['lien'])){
            $lien = NULL;
        }else{
            $lien = $_POST['lien'];
        }

        mysqli_query($bdd, 'INSERT INTO popcorn(id, date_film, option1, option2, option3, film) VALUES(NULL, "'.$_POST['date'].'", "'.$choix1.'", "'.$choix2.'", "'.$choix3.'", "'.$lien.'");');
        
        $max_id = mysqli_query($bdd, 'SELECT * FROM popcorn WHERE id = (SELECT MAX(id) FROM popcorn);');
        $max_id = mysqli_fetch_array($max_id, MYSQLI_ASSOC);

        if(!empty($max_id)){
            if(empty($max_id['option1'])){
                mysqli_query($bdd, 'UPDATE popcorn SET option1 = NULL WHERE id = '.$max_id['id'].';');
            }
            if(empty($max_id['option2'])){
                mysqli_query($bdd, 'UPDATE popcorn SET option2 = NULL WHERE id = '.$max_id['id'].';');
            }
            if(empty($max_id['option3'])){
                mysqli_query($bdd, 'UPDATE popcorn SET option3 = NULL WHERE id = '.$max_id['id'].';');
            }
            if(empty($max_id['film'])){
                mysqli_query($bdd, 'UPDATE popcorn SET film = NULL WHERE id = '.$max_id['id'].';');
            }
            $error = 1;
        }else{
            $error = 0;
        }
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-panel.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header-panel.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page" style="color: rgb(245, 224, 35);">Ajout et modification d'un event popcorn</h1>

    <div class="box">
        <form action="" method="POST">

            <div class="form-row">
                <!-- Ajout d'un event popcorn -->
                <div class="form-group col-md-6">
                    <h2>Ajout :</h2>
                    <?php
                        if ($error == 0) {
                            echo "<div class='alert alert-danger' role='alert'>Erreur dans l'ajout.</div>";
                        }else if($error == 1){
                            echo "<div class='alert alert-success' role='alert'>Event popcorn ajouté avec succès !</div>";
                        }
                    ?>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="date">Date*</span>
                        </div>
                        <input type="datetime-local" class="form-control" placeholder="Date ..." aria-label="date" aria-describedby="date" name="date" required>
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

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="lien">Lien</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Lien ..." aria-label="lien" aria-describedby="lien" name="lien">
                    </div>
                
                    <p class="text-muted text-left">* Champs obligatoire</p>

                    <button class="btn btn-primary" type="submit">Création de l'event Popcorn !</button>
                </div>
            </form>

            <!-- Affichage des event popcorn -->
            <div class="form-group col-md-6">
                <h2>Modification :</h2>
                <?php 
                    $affichage = mysqli_query($bdd, 'SELECT id, DATE_FORMAT(date_film, "%d/%m/%Y à %Hh%i") AS date_film FROM popcorn ORDER BY id DESC;');

                    foreach($affichage as $donnees){ ?>

                        <div class="input-group box-affichage" id="border">
                            <div class="input-group-prepend" style="width: 455px;">
                                <span><?php echo $donnees['date_film']; ?></span>
                            </div>
                            
                            <form action="modification-popcorn-id.php" method="POST">
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