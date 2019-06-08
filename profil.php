<?php session_start();
    
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }

    if(!empty($_POST)){
        $newpseudo = $_POST['newpseudo'];
        $newmail = $_POST['newmail'];

        if($_POST['mdp'] != NULL){
            $newmdp = md5($_POST['mdp']);
            mysqli_query($bdd, 'UPDATE membres SET mail = "'.utf8_decode($newmail).'", password = "'.$newmdp.'" WHERE idProfil = '.$idPseudo.' ;');
        }else{
            mysqli_query($bdd, 'UPDATE membres SET mail = "'.utf8_decode($newmail).'" WHERE idProfil = '.$idPseudo.' ;');
        }

        mysqli_query($bdd, 'UPDATE membres SET prenom = "'.utf8_decode($_POST['newprenom']).'" WHERE id = '.$idPseudo.';');
        
        if(!empty($_POST['newetude'])){
            mysqli_query($bdd, 'UPDATE membres SET etude = "'.utf8_decode($_POST['newetude']).'" WHERE id = '.$idPseudo.';');
        }
        
        if(!empty($_POST['newtravail'])){
            mysqli_query($bdd, 'UPDATE membres SET travail = "'.utf8_decode($_POST['newtravail']).'" WHERE id = '.$idPseudo.';');
        }

        if(!empty($_POST['newregion'])){
            mysqli_query($bdd, 'UPDATE membres SET region = "'.utf8_decode($_POST['newregion']).'" WHERE id = '.$idPseudo.';');
        }

        if(!empty($_POST['newbio'])){
            mysqli_query($bdd, 'UPDATE membres SET bio = "'.utf8_decode($_POST['newbio']).'" WHERE id = '.$idPseudo.';');
        }

    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles-profil.css">
</head>
<body>

    <!-- HEADER -->
    <?php require_once('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Profil</h1>

    <section class="box text-center text-white principale">
        <div class="text-center">
            <?php 
                $profil = mysqli_query($bdd, 'SELECT pseudo, mail, bio, prenom, etude, travail, region FROM membres WHERE id = '.$idPseudo.';');
                $profil = mysqli_fetch_array($profil, MYSQLI_ASSOC);            
            ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="prenom">Prenom</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo utf8_encode($profil['prenom']); ?>" aria-label="prenom" aria-describedby="prenom" name="newprenom">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="etude">Etude</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo utf8_encode($profil['etude']); ?>" aria-label="etude" aria-describedby="etude" name="newetude">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="travail">Travail</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo utf8_encode($profil['travail']); ?>" aria-label="travail" aria-describedby="travail" name="newtravail">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="region">Region</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo utf8_encode($profil['region']); ?>" aria-label="region" aria-describedby="region" name="newregion">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="bio">Biographie</span>
                                </div>
                                <textarea id="bio" rows="3" cols="56" name="newbio"><?php echo utf8_encode($profil['bio']); ?></textarea>
                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="pseudo">Pseudo</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $profil['pseudo']; ?>" aria-label="pseudo" aria-describedby="pseudo" name="newpseudo">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mdp">Mot de passe</span>
                                </div>
                                <input type="password" class="form-control" placeholder="Nouveau mot de passe" aria-label="mdp" aria-describedby="mdp" name="mdp">
                            </div>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mail">Mail</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo utf8_encode($profil['mail']); ?>" aria-label="mail" aria-describedby="mail" name="newmail">
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-outline-success">Mettre à jour</button>
                </form>
        
        </div>
    </section>

    <!-- FOOTER -->
    <?php require_once('footer.php'); 
    mysqli_close($bdd); ?>
    <!-- FOOTER -->

</body>
</html>