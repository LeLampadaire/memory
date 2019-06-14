<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 
    
	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if($_SESSION['id_rang'] != 3){
		header('Location: 404.php');
    }

    $membres = mysqli_query($bdd, "SELECT membres.id as id, pseudo, rang.id as id_rang, nom FROM membres INNER JOIN rang ON(membres.id_rang = rang.id) ORDER BY pseudo ASC");
    
    if(!empty($_POST)){
        $rang = $_POST['rang'];
        $id = $_POST['id'];

        mysqli_query($bdd, 'UPDATE membres SET id_rang='.$rang.' WHERE id='.$id.';');
        header('Location: modification-rang.php');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Panel</title>
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

    <h1 class="titre-page" style="color: rgb(0, 175, 102);">Rang</h1>

    <div class="box">
    <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Rang actuel</th>
                    <th scope="col">Upgrade</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($membres as $donnees){ ?>
                <tr>
                    <td><?php echo $donnees['pseudo']; ?></td>
                    <td><?php echo $donnees['nom']; ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" value="<?php echo $donnees['id']; ?>" name="id">
                            <?php if($donnees['id_rang'] == 1){ 
                                echo '<button type="submit" class="btn btn-primary" name="rang" value="2">Upgrade vers Bras droit</button>'; 
                            }else if($donnees['id_rang'] == 2){
                                echo '<button type="submit" class="btn btn-secondary" name="rang" value="1">Downgrade vers Membre</button>'; 
                            }else{
                                echo '/';
                            } ?>
                        </form>                    
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>