<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 
    
	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if($_SESSION['id_rang'] == 1){
		header('Location: 404.php');
    }

    if(!empty($_POST['modification'])){
        $modification = mysqli_query($bdd, 'SELECT * FROM popcorn WHERE id='.$_POST['modification'].';');
        $modification = mysqli_fetch_array($modification, MYSQLI_ASSOC);
        $date_input = explode(" ",$modification['date_film']);
        $date_input[1] = substr($date_input[1],0,5);
        $date_input = "".$date_input[0]."T".$date_input[1]."";
    }else if(!empty($_POST['id'])){

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

        mysqli_query($bdd, 'UPDATE popcorn SET date_film = "'.$_POST['date'].'", option1 = "'.$choix1.'", option2 = "'.$choix2.'", option3 = "'.$choix3.'", film = "'.$lien.'" WHERE id='.$_POST['id'].';');

        if(empty($choix1)){
            mysqli_query($bdd, 'UPDATE popcorn SET option1 = NULL WHERE id = '.$_POST['id'].';');
        }
        if(empty($choix2)){
            mysqli_query($bdd, 'UPDATE popcorn SET option2 = NULL WHERE id = '.$_POST['id'].';');
        }
        if(empty($choix3)){
            mysqli_query($bdd, 'UPDATE popcorn SET option3 = NULL WHERE id = '.$_POST['id'].';');
        }
        if(empty($lien)){
            mysqli_query($bdd, 'UPDATE popcorn SET film = NULL WHERE id = '.$_POST['id'].';');
        }

        header('Location: modification-popcorn.php');
    }else{
        header('Location: modification-popcorn.php');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Modification du popcorn</title>
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

    <h1 class="titre-page">Modification de l'event popcorn</h1>

    <div class="box">    
    
        <form action="" method="POST">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="date">Date*</span>
                </div>
                <input type="datetime-local" class="form-control" placeholder="Date ..." value="<?php echo $date_input; ?>" aria-label="date" aria-describedby="date" name="date" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="choix1">Choix 1</span>
                </div>
                <input type="text" class="form-control" placeholder="Choix 1 ..." value="<?php echo utf8_encode($modification['option1']); ?>" aria-label="choix1" aria-describedby="choix1" name="choix1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="choix2">Choix 2</span>
                </div>
                <input type="text" class="form-control" placeholder="Choix 2 ..." value="<?php echo utf8_encode($modification['option2']); ?>" aria-label="choix2" aria-describedby="choix2" name="choix2">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="choix3">Choix 3</span>
                </div>
                <input type="text" class="form-control" placeholder="Choix 3 ..." value="<?php echo utf8_encode($modification['option3']); ?>" aria-label="choix3" aria-describedby="choix3" name="choix3">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="lien">Lien</span>
                </div>
                <input type="text" class="form-control" placeholder="Lien ..." value="<?php echo utf8_encode($modification['film']); ?>" aria-label="lien" aria-describedby="lien" name="lien">
            </div>

            <p class="text-muted text-left">* Champs obligatoire</p>
            <input type="hidden" value="<?php echo $modification['id']; ?>" name="id">
            <button class="btn btn-primary" type="submit">Modification du popcorn !</button>

        </form>
        <button type="button" onClick="document.location.href = document.referrer" class="btn btn-outline-light" id="Retour">Retour</button><br>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>