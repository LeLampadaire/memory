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

    if(!empty($_POST['modification'])){
        $modification = mysqli_query($bdd, 'SELECT * FROM paris WHERE id='.$_POST['modification'].';');
        $modification = mysqli_fetch_array($modification, MYSQLI_ASSOC);
        $date_input = explode(" ",$modification['date_fin']);
        $date_input[1] = substr($date_input[1],0,5);
        $date_input = "".$date_input[0]."T".$date_input[1]."";
    }else if(!empty($_POST['titre'])){        
        mysqli_query($bdd, 'UPDATE paris SET titre="'.$_POST['titre'].'", mise='.$_POST['mise'].', choix1="'.$_POST['choix1'].'", choix2="'.$_POST['choix2'].'", date_fin="'.$_POST['date'].'" WHERE id='.$_POST['id'].';');

        header('Location: modification-paris.php');
    }else{
        header('Location: modification-paris.php');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Modification du paris</title>
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

    <h1 class="titre-page">Modification du paris</h1>

    <div class="box">    
    
        <form action="" method="POST">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="titre">Titre*</span>
                </div>
                <input type="text" class="form-control" placeholder="Titre ..." value="<?php echo utf8_encode($modification['titre']); ?>" aria-label="titre" aria-describedby="titre" name="titre" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="mise">Mise*</span>
                </div>
                <input type="number" class="form-control" placeholder="Mise ..." value="<?php echo $modification['mise']; ?>" aria-label="mise" aria-describedby="mise" name="mise" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="choix1">Choix 1*</span>
                </div>
                <input type="text" class="form-control" placeholder="Choix 1 ..." value="<?php echo utf8_encode($modification['choix1']); ?>" aria-label="choix1" aria-describedby="choix1" name="choix1" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="choix2">Choix 2*</span>
                </div>
                <input type="text" class="form-control" placeholder="Choix 2 ..." value="<?php echo utf8_encode($modification['choix2']); ?>" aria-label="choix2" aria-describedby="choix2" name="choix2" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="date">Date de fin*</span>
                </div>
                <input type="datetime-local" class="form-control" placeholder="Date ..." value="<?php echo $date_input; ?>" aria-label="date" aria-describedby="date" name="date" required>
            </div>

            <p class="text-muted text-left">* Champs obligatoire</p>
            <input type="hidden" value="<?php echo $modification['id']; ?>" name="id">
            <button class="btn btn-primary" type="submit">Modification du paris !</button>
        </form>

        <button type="button" onClick="document.location.href = document.referrer" class="btn btn-outline-light" id="Retour">Retour</button><br>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>