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
        mysqli_query($bdd, 'UPDATE membres SET classe_principale = "'.utf8_decode($_POST['newimage']).'" WHERE id = '.$idPseudo.';');
        
        if(!empty($_POST['newetude'])){
            mysqli_query($bdd, 'UPDATE membres SET etude = "'.utf8_decode($_POST['newetude']).'" WHERE id = '.$idPseudo.';');
        }else{
            mysqli_query($bdd, 'UPDATE membres SET etude = NULL WHERE id = '.$idPseudo.';');
        }
        
        if(!empty($_POST['newtravail'])){
            mysqli_query($bdd, 'UPDATE membres SET travail = "'.utf8_decode($_POST['newtravail']).'" WHERE id = '.$idPseudo.';');
        }else{
            mysqli_query($bdd, 'UPDATE membres SET travail = NULL WHERE id = '.$idPseudo.';');
        }

        if(!empty($_POST['newregion'])){
            mysqli_query($bdd, 'UPDATE membres SET region = "'.utf8_decode($_POST['newregion']).'" WHERE id = '.$idPseudo.';');
        }else{
            mysqli_query($bdd, 'UPDATE membres SET region = NULL WHERE id = '.$idPseudo.';');
        }

        if(!empty($_POST['newbio'])){
            mysqli_query($bdd, 'UPDATE membres SET bio = "'.utf8_decode($_POST['newbio']).'" WHERE id = '.$idPseudo.';');
        }else{
            mysqli_query($bdd, 'UPDATE membres SET bio = NULL WHERE id = '.$idPseudo.';');
        }

    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Modification profil</title>
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
    <?php require_once('header-profil.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Modification</h1>

    <section class="box text-center text-white principale">
        <div class="text-center">
            <?php 
                $profil = mysqli_query($bdd, 'SELECT pseudo, mail, bio, classe_principale, prenom, etude, travail, region FROM membres WHERE id = '.$idPseudo.';');
                $profil = mysqli_fetch_array($profil, MYSQLI_ASSOC);            
            ?>

                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <h2>Informations :</h2>
                            
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
                                <textarea id="bio" rows="3" cols="62" name="newbio"><?php echo utf8_encode($profil['bio']); ?></textarea>
                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            
                            <h2>Compte :</h2>

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

                            <div class="input-group mb-3">
                                <img src="<?php echo $profil['classe_principale']; ?>" alt="Image" width="38px" height="38px">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="image">Image de profil</span>
                                </div>

                                <select class="form-control" name="newimage" id="image" required>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/cra.png"){ echo '<option value="icons/logo/cra.png" selected>Cra</option>';}else{ echo '<option value="icons/logo/cra.png">Cra</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/ecaflip.png"){ echo '<option value="icons/logo/ecaflip.png" selected>Ecaflip</option>';}else{ echo '<option value="icons/logo/ecaflip.png">Ecaflip</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/eliotrope.png"){ echo '<option value="icons/logo/eliotrope.png" selected>Eliotrope</option>';}else{ echo '<option value="icons/logo/eliotrope.png">Eliotrope</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/eniripsa.png"){ echo '<option value="icons/logo/eniripsa.png" selected>Eniripsa</option>';}else{ echo '<option value="icons/logo/eniripsa.png">Eniripsa</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/enutrof.png"){ echo '<option value="icons/logo/enutrof.png" selected>Enutrof</option>';}else{ echo '<option value="icons/logo/enutrof.png">Enutrof</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/feca.png"){ echo '<option value="icons/logo/feca.png" selected>Feca</option>';}else{ echo '<option value="icons/logo/feca.png">Feca</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/huppermage.png"){ echo '<option value="icons/logo/huppermage.png" selected>Huppermage</option>';}else{ echo '<option value="icons/logo/huppermage.png">Huppermage</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/iop.png"){ echo '<option value="icons/logo/iop.png" selected>Iop</option>';}else{ echo '<option value="icons/logo/iop.png">Iop</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/osamodas.png"){ echo '<option value="icons/logo/osamodas.png" selected>Osamodas</option>';}else{ echo '<option value="icons/logo/osamodas.png">Osamodas</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/ouginak.png"){ echo '<option value="icons/logo/ouginak.png" selected>Ouginak</option>';}else{ echo '<option value="icons/logo/ouginak.png">Ouginak</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/pandawa.png"){ echo '<option value="icons/logo/pandawa.png" selected>Pandawa</option>';}else{ echo '<option value="icons/logo/pandawa.png">Pandawa</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/roublard.png"){ echo '<option value="icons/logo/roublard.png" selected>Roublard</option>';}else{ echo '<option value="icons/logo/roublard.png">Roublard</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/sacrieur.png"){ echo '<option value="icons/logo/sacrieur.png" selected>Sacrieur</option>';}else{ echo '<option value="icons/logo/sacrieur.png">Sacrieur</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/sadida.png"){ echo '<option value="icons/logo/sadida.png" selected>Sadida</option>';}else{ echo '<option value="icons/logo/sadida.png">Sadida</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/sram.png"){ echo '<option value="icons/logo/sram.png" selected>Sram</option>';}else{ echo '<option value="icons/logo/sram.png">Sram</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/steamer.png"){ echo '<option value="icons/logo/steamer.png" selected>Steamer</option>';}else{ echo '<option value="icons/logo/steamer.png">Steamer</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/xelor.png"){ echo '<option value="icons/logo/xelor.png" selected>Xelor</option>';}else{ echo '<option value="icons/logo/xelor.png">Xelor</option>'; } ?>
                                    <?php if(utf8_encode($profil['classe_principale']) == "icons/logo/zobal.png"){ echo '<option value="icons/logo/zobal.png" selected>Zobal</option>';}else{ echo '<option value="icons/logo/zobal.png">Zobal</option>'; } ?>
								</select>
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