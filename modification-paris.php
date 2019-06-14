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
   
    if(!empty($_POST['titre'])){
        
        $titre = $_POST['titre'];

        if(empty($_POST['mise'])){
            $error = 0;
        }else{
            $mise = $_POST['mise'];
        }
        
        if(empty($_POST['choix1'])){
            $error = 0;
        }else{
            $choix1 = $_POST['choix1'];
        }
        
        if(empty($_POST['choix2'])){
            $error = 0;
        }else{
            $choix2 = $_POST['choix2'];
        }

        $date = date("Y-m-d H:i:s"); // RECUPERER DATE POUR DIRE QUE C'EST LA DATE DE FIN

        if($error != 0){
            mysqli_query($bdd, 'INSERT INTO paris (id, titre, mise, choix1, choix2, date_fin) VALUES (NULL, "'.$titre.'", '.$mise.', "'.$choix1.'", "'.$choix2.'", "'.$date.'");');
            $max_id = mysqli_query($bdd, 'SELECT * FROM paris WHERE id = (SELECT MAX(id) FROM paris);');
            $max_id = mysqli_fetch_array($max_id, MYSQLI_ASSOC);

            if(empty($max_id['choix1'])){
                mysqli_query($bdd, 'UPDATE paris SET choix1 = NULL WHERE id = '.$max_id['id'].';');
            }
            if(empty($max_id['choix2'])){
                mysqli_query($bdd, 'UPDATE paris SET choix2 = NULL WHERE id = '.$max_id['id'].';');
            }
            
            $error = 1;
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

    <h1 class="titre-page" style="color: rgb(51, 255, 0);">Ajout et modification d'un paris</h1>

    <div class="box">
        

            <div class="form-row">
                <!-- Ajout d'un paris -->

                <div class="form-group col-md-6">
                    <form action="" method="POST">
                        <h2>Ajout :</h2>
                        <?php
                            if ($error == 0) {
                                echo "<div class='alert alert-danger' role='alert'>Erreur dans l'ajout.</div>";
                            }else if($error == 1){
                                echo "<div class='alert alert-success' role='alert'>Paris ajouté avec succès !</div>";
                            }
                        ?>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="titre">Titre*</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Titre ..." aria-label="titre" aria-describedby="titre" name="titre" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="mise">Mise*</span>
                            </div>
                            <input type="number" class="form-control" placeholder="Mise ..." aria-label="mise" aria-describedby="mise" name="mise" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="choix1">Choix 1*</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Choix 1 ..." aria-label="choix1" aria-describedby="choix1" name="choix1" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="choix2">Choix 2*</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Choix 2 ..." aria-label="choix2" aria-describedby="choix2" name="choix2" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="date">Date de fin*</span>
                            </div>
                            <input type="datetime-local" class="form-control" placeholder="Date ..." aria-label="date" aria-describedby="date" name="date" required>
                        </div>

                        <p class="text-muted text-left">* Champs obligatoire</p>
                        
                        <button class="btn btn-primary" type="submit">Création du paris !</button>
                    </form>
                </div>

                <!-- Affichage et modification des paris -->
                <div class="form-group col-md-6">
                    <h2>Modification :</h2>
                    <?php 
                        $affichage = mysqli_query($bdd, 'SELECT id, titre FROM paris ORDER BY id DESC;');

                        foreach($affichage as $donnees){ ?>

                            <div class="input-group box-affichage" id="border">
                                <div class="input-group-prepend" style="width: 365px;">
                                    <span><?php echo utf8_encode($donnees['titre']); ?></span>
                                </div>
                                
                                <form action="modification-paris-affichage.php" method="POST">
                                    <input type="hidden" value="<?php echo $donnees['id']; ?>" name="affichage">
                                    <button class="btn btn-success" type="submit">Affichage</button>
                                </form>

                                <form action="modification-paris-id.php" method="POST">
                                    <input type="hidden" value="<?php echo $donnees['id']; ?>" name="modification">
                                    <button class="btn btn-primary" type="submit">Modification</button>
                                </form>
                            </div>
                            <br>
                            
                        <?php } ?>
                </div>
                
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>