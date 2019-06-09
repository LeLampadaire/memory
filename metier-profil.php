<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
    $idPseudo = $_SESSION['idprofil'];
    
	if(empty($_SESSION)){
		header('Location: 404.php');
    }

    $metiers = mysqli_query($bdd, 'SELECT * FROM metiers WHERE id_membre = '.$idPseudo.';');
    $metiers = mysqli_fetch_array($metiers, MYSQLI_ASSOC);

    
    if(!empty($_POST)){
        if(empty($_POST['alchimiste']) OR (int)$_POST['alchimiste'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET alchimiste = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $alchimiste = (int)$_POST['alchimiste'];
            if($alchimiste > 200){
                $alchimiste = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET alchimiste = '.$alchimiste.' WHERE id_membre = '.$idPseudo.';');
        }
        
        if(empty($_POST['bijoutier']) OR $_POST['bijoutier'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET bijoutier = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $bijoutier = (int)$_POST['bijoutier'];
            if($bijoutier > 200){
                $bijoutier = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET bijoutier = '.$bijoutier.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['bricoleur']) OR $_POST['bricoleur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET bricoleur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $bricoleur = (int)$_POST['bricoleur'];
            if($bricoleur > 200){
                $bricoleur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET bricoleur = '.$bricoleur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['bucheron']) OR $_POST['bucheron'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET bucheron = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $bucheron = (int)$_POST['bucheron'];
            if($bucheron > 200){
                $bucheron = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET bucheron = '.$bucheron.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['chasseur']) OR $_POST['chasseur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET chasseur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $chasseur = (int)$_POST['chasseur'];
            if($chasseur > 200){
                $chasseur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET chasseur = '.$chasseur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['cordomage']) OR $_POST['cordomage'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET cordomage = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $cordomage = (int)$_POST['cordomage'];
            if($cordomage > 200){
                $cordomage = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET cordomage = '.$cordomage.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['cordonnier']) OR $_POST['cordonnier'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET cordonnier = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $cordonnier = (int)$_POST['cordonnier'];
            if($cordonnier > 200){
                $cordonnier = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET cordonnier = '.$cordonnier.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['costumage']) OR $_POST['costumage'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET costumage = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $costumage = (int)$_POST['costumage'];
            if($costumage > 200){
                $costumage = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET costumage = '.$costumage.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['tailleur']) OR $_POST['tailleur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET tailleur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $tailleur = (int)$_POST['tailleur'];
            if($tailleur > 200){
                $tailleur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET tailleur = '.$tailleur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['facomage']) OR $_POST['facomage'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET facomage = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $facomage = (int)$_POST['facomage'];
            if($facomage > 200){
                $facomage = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET faconneur = '.$faconneur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['faconneur']) OR $_POST['faconneur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET faconneur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $faconneur = (int)$_POST['faconneur'];
            if($faconneur > 200){
                $faconneur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET faconneur = '.$faconneur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['forgemage']) OR $_POST['forgemage'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET forgemage = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $forgemage = (int)$_POST['forgemage'];
            if($forgemage > 200){
                $forgemage = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET forgemage = '.$forgemage.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['forgeron']) OR $_POST['forgeron'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET forgeron = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $forgeron = (int)$_POST['forgeron'];
            if($forgeron > 200){
                $forgeron = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET forgeron = '.$forgeron.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['joaillomage']) OR $_POST['joaillomage'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET joaillomage = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $joaillomage = (int)$_POST['joaillomage'];
            if($joaillomage > 200){
                $joaillomage = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET joaillomage = '.$joaillomage.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['mineur']) OR $_POST['mineur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET mineur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $mineur = (int)$_POST['mineur'];
            if($mineur > 200){
                $mineur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET mineur = '.$mineur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['paysan']) OR $_POST['paysan'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET paysan = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $paysan = (int)$_POST['paysan'];
            if($paysan > 200){
                $paysan = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET paysan = '.$paysan.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['pecheur']) OR $_POST['pecheur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET pecheur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $pecheur = (int)$_POST['pecheur'];
            if($pecheur > 200){
                $pecheur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET pecheur = '.$pecheur.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['sculptemage']) OR $_POST['sculptemage'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET sculptemage = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $sculptemage = (int)$_POST['sculptemage'];
            if($sculptemage > 200){
                $sculptemage = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET sculptemage = '.$sculptemage.' WHERE id_membre = '.$idPseudo.';');
        }

        if(empty($_POST['sculpteur']) OR $_POST['sculpteur'] <= 0){
            mysqli_query($bdd, 'UPDATE metiers SET sculpteur = NULL WHERE id_membre = '.$idPseudo.';');
        }else{
            $sculpteur = (int)$_POST['sculpteur'];
            if($sculpteur > 200){
                $sculpteur = 200;
            }
            mysqli_query($bdd, 'UPDATE metiers SET sculpteur = '.$sculpteur.' WHERE id_membre = '.$idPseudo.';');
        }

		header('Location: metier-profil.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Modification métiers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-index.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require_once('header-profil.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Modification des métiers</h1>

    <div class="box">
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Alchimiste">Alchimiste</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['alchimiste'] == NULL){ echo "0"; }else{ echo $metiers['alchimiste']; } ?>" name="alchimiste" aria-describedby="Alchimiste">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Bijoutier">Bijoutier</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['bijoutier'] == NULL){ echo "0"; }else{ echo $metiers['bijoutier']; } ?>" name="bijoutier" aria-describedby="Bijoutier">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Bricoleur">Bricoleur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['bricoleur'] == NULL){ echo "0"; }else{ echo $metiers['bricoleur']; } ?>" name="bricoleur" aria-describedby="Bricoleur">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Bucheron">Bucheron</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['bucheron'] == NULL){ echo "0"; }else{ echo $metiers['bucheron']; } ?>" name="bucheron" aria-describedby="Bucheron">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Chasseur">Chasseur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['chasseur'] == NULL){ echo "0"; }else{ echo $metiers['chasseur']; } ?>" name="chasseur" aria-describedby="Chasseur">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Cordomage">Cordomage</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['cordomage'] == NULL){ echo "0"; }else{ echo $metiers['cordomage']; } ?>" name="cordomage" aria-describedby="Cordomage">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Cordonnier">Cordonnier</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['cordonnier'] == NULL){ echo "0"; }else{ echo $metiers['cordonnier']; } ?>" name="cordonnier" aria-describedby="Cordonnier">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Costumage">Costumage</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['costumage'] == NULL){ echo "0"; }else{ echo $metiers['costumage']; } ?>" name="costumage" aria-describedby="Costumage">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Tailleur">Tailleur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['tailleur'] == NULL){ echo "0"; }else{ echo $metiers['tailleur']; } ?>" name="tailleur" aria-describedby="Tailleur">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Facomage">Façomage</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['facomage'] == NULL){ echo "0"; }else{ echo $metiers['facomage']; } ?>" name="facomage" aria-describedby="Facomage">
                    </div>

                </div>
                
                <div class="form-group col-md-6">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Faconneur">Façonneur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['faconneur'] == NULL){ echo "0"; }else{ echo $metiers['faconneur']; } ?>" name="faconneur" aria-describedby="Faconneur">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Forgemage">Forgemage</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['forgemage'] == NULL){ echo "0"; }else{ echo $metiers['forgemage']; } ?>" name="forgemage" aria-describedby="Forgemage">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Forgeron">Forgeron</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['forgeron'] == NULL){ echo "0"; }else{ echo $metiers['forgeron']; } ?>" name="forgeron" aria-describedby="Forgeron">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Joaillomage">Joaillomage</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['joaillomage'] == NULL){ echo "0"; }else{ echo $metiers['joaillomage']; } ?>" name="joaillomage" aria-describedby="Joaillomage">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Mineur">Mineur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['mineur'] == NULL){ echo "0"; }else{ echo $metiers['mineur']; } ?>" name="mineur" aria-describedby="Mineur">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Paysan">Paysan</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['paysan'] == NULL){ echo "0"; }else{ echo $metiers['paysan']; } ?>" name="paysan" aria-describedby="Paysan">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Pecheur">Pecheur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['pecheur'] == NULL){ echo "0"; }else{ echo $metiers['pecheur']; } ?>" name="pecheur" aria-describedby="Pecheur">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Sculptemage">Sculptemage</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['sculptemage'] == NULL){ echo "0"; }else{ echo $metiers['sculptemage']; } ?>" name="sculptemage" aria-describedby="Sculptemage">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Sculpteur">Sculpteur</span>
                        </div>

                        <input type="text" class="form-control" placeholder="Niveau" value="<?php if($metiers['sculpteur'] == NULL){ echo "0"; }else{ echo $metiers['sculpteur']; } ?>" name="sculpteur" aria-describedby="Sculpteur">
                    </div>

                </div>
            </div>

            <button class="btn btn-success" type="submit">Modifiez !</button>
        </form>
    </div>

    <!-- FOOTER -->
    <?php require_once('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>