<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
    
    if(!empty($_POST)){
        $post = $_POST['metier'];
        if(empty($_POST['direction'])){
            $direction = "DESC";
        }else{
            $direction = $_POST['direction'];
        }
        $metiers = mysqli_query($bdd, 'SELECT membres.pseudo, '.$post.' as niveau FROM metiers INNER JOIN membres ON(metiers.id_membre = membres.id) WHERE '.$post.' IS NOT NULL ORDER BY '.$post.' '.$direction.';');
        $test = mysqli_fetch_array($metiers, MYSQLI_ASSOC);
    }else{
        $metiers = NULL;
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Métiers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-metiers.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Métiers</h1>
    
    <div class="box">
        <div class="mx-auto" style="width: 280px; padding-top: 10px;">
            <form action="" method="POST">
                <div class="input-group mb-3" style="width: 100%">
                    <select name="metier">
                        <option value="alchimiste">Alchimiste</option>
                        <option value="bijoutier">Bijoutier</option>
                        <option value="bricoleur">Bricoleur</option>
                        <option value="bucheron">Bucheron</option>
                        <option value="chasseur">Chasseur</option>
                        <option value="cordomage">Cordomage</option>
                        <option value="cordonnier">Cordonnier</option>
                        <option value="costumage">Costumage</option>
                        <option value="tailleur">Tailleur</option>
                        <option value="facomage">Façomage</option>
                        <option value="forgemage">Forgemage</option>
                        <option value="forgeron">Forgeron</option>
                        <option value="joaillomage">Joaillomage</option>
                        <option value="mineur">Mineur</option>
                        <option value="paysan">Paysan</option>
                        <option value="pecheur">Pecheur</option>
                        <option value="sculptemage">Sculptemage</option>
                        <option value="sculpteur">Sculpteur</option>
                    </select>
                    
                    <select name="direction">
                        <option value="DESC" auto>Du + au -</option>
                        <option value="ASC">Du - au +</option>
                    </select>
                    <div class="input-group-append">
                        <input class="btn btn-outline-success" type="submit" value="Recherche">
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <?php if($metiers != NULL){ ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?php echo ucfirst($_POST['metier']); ?></th>
                        <th scope="col">Niveau <?php if($direction == "ASC"){ echo '\/'; }else{ echo '/\\'; } ?></th>
                    </tr>
                </thead>

                <tbody>
                            
                    <?php 
                        if($test != NULL){
                            foreach($metiers as $donnees){
                                echo '<tr>';
                                    echo '<td class="text-left">'.$donnees['pseudo'].'</td>';
                                    echo '<td class="text-left">'.$donnees['niveau'].'</td>';
                                echo '</tr>';
                            } 
                        }else{
                            echo '<div class="alert alert-danger text-center" role="alert">';
                                echo "Il n'y a aucun membre ayant le métier : ".ucfirst($post).".";
                            echo '</div>';
                        }
                    ?>
            </table>
            
        <?php } ?>

    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->

</body>
</html>