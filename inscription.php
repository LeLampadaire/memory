<?php 
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

    if(!empty($_POST)){
        $newprenom = $_POST['newprenom'];
        $newpseudo = $_POST['newpseudo'];
        $newmail = $_POST['newmail'];
        $newmdp = md5($_POST['mdp']);
        $newimage = $_POST['newimage'];

        $test = mysqli_query($bdd, 'INSERT INTO membres(id, id_rang, pseudo, mdp, mail, classe_principale, bio, prenom, etude, travail, region, date_inscription) VALUES(NULL, 1, "'.$newpseudo.'", "'.$newmdp.'", "'.$newmail.'", "'.$newimage.'", NULL, "'.$newprenom.'", NULL, NULL, NULL, CURRENT_TIMESTAMP());');
        if($test == true){
            $ret = mysqli_query($bdd, 'SELECT id FROM membres WHERE pseudo = "'.$newpseudo.'";');
            $ret = mysqli_fetch_array($ret, MYSQLI_ASSOC);
            $id = (int)$ret['id'];
            mysqli_query($bdd, 'INSERT INTO metiers(id, id_membre, alchimiste, bijoutier, bricoleur, bucheron, chasseur, cordomage, cordonnier, costumage, tailleur, facomage, faconneur, forgemage, forgeron, joaillomage, mineur, paysan, pecheur, sculptemage, sculpteur) VALUES(NULL, '.$id.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);');
			header('Location: connexion.php');
        }else{
            $erreur = 1;
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-inscription.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require_once('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Inscription</h1>
    
    <div class="box">
        <?php if(isset($erreur)){
            echo '<div class="alert alert-danger" role="alert">';
                echo "Erreur dans l'inscription !";
            echo '</div>';
        } ?>
        <form action="" method="POST">
            <div class="form-row">

                <div class="form-group col-md-6">
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="prenom">Prenom*</span>
                        </div>
                        <input type="text" class="form-control" aria-label="prenom" aria-describedby="prenom" name="newprenom" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="pseudo">Pseudo*</span>
                        </div>
                        <input type="text" class="form-control" aria-label="pseudo" aria-describedby="pseudo" name="newpseudo" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="mdp">Mot de passe*</span>
                        </div>
                        <input type="password" class="form-control" placeholder="Nouveau mot de passe" aria-label="mdp" aria-describedby="mdp" name="mdp" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="mail">Mail*</span>
                        </div>
                        <input type="email" class="form-control" aria-label="mail" aria-describedby="mail" name="newmail" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="image">Image de profil*</span>
                        </div>

                        <select class="form-control" name="newimage" id="image" required>
                            <option value="icons/logo/cra.png">Cra</option>
                            <option value="icons/logo/ecaflip.png">Ecaflip</option>
                            <option value="icons/logo/eliotrope.png">Eliotrope</option>
                            <option value="icons/logo/eniripsa.png">Eniripsa</option>
                            <option value="icons/logo/enutrof.png">Enutrof</option>
                            <option value="icons/logo/feca.png">Feca</option>
                            <option value="icons/logo/huppermage.png">Huppermage</option>
                            <option value="icons/logo/iop.png">Iop</option>
                            <option value="icons/logo/osamodas.png">Osamodas</option>
                            <option value="icons/logo/ouginak.png">Ouginak</option>
                            <option value="icons/logo/pandawa.png">Pandawa</option>
                            <option value="icons/logo/roublard.png">Roublard</option>
                            <option value="icons/logo/sacrieur.png">Sacrieur</option>
                            <option value="icons/logo/sadida.png">Sadida</option>
                            <option value="icons/logo/sram.png">Sram</option>
                            <option value="icons/logo/steamer.png">Steamer</option>
                            <option value="icons/logo/xelor.png">Xelor</option>
                            <option value="icons/logo/zobal.png">Zobal</option>
                        </select>
                    </div>

                </div>

            </div>
            <p class="text-muted text-left">* Champs obligatoire</p>
            <button type="submit" class="btn btn-outline-success">Création du compte</button>
        </form>
    </div>

    <!-- FOOTER -->
    <?php require_once('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>