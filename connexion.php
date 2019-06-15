<?php 
  session_start();
	require_once 'configuration.php';
	require_once 'dbb_connexion.php';

	$error = 0;
	if(!empty($_POST)){
		$mdp = md5($_POST['mdp']);
		$pseudo = $_POST['pseudo'];
		$ret = mysqli_query($bdd, 'SELECT id, id_rang, pseudo FROM membres WHERE pseudo LIKE("'.$pseudo.'") AND mdp LIKE("'.$mdp.'");');
		$ret = mysqli_fetch_array($ret, MYSQLI_ASSOC);

		if($ret == NULL){
			$error = 1;
		}else{
			$error = 0;
			session_unset();
			$_SESSION['idprofil'] = (int)$ret['id'];
			$_SESSION['id_rang'] = (int)$ret['id_rang'];
			$_SESSION['pseudo'] = $ret['pseudo'];
			header('Location: index.php');
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-connexion.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page text-warning">Connexion</h1>

		<section class="text-center text-white">
			
			<div class="box text-center">
			
					<form method="POST">
						<?php
							if ($error == 1) {
								echo '<div class="alert alert-danger" role="alert">Pseudo ou mot de passe incorrect.</div>';
							}	
						?>
						<label>Nom de compte<br><input required type="text" name="pseudo"><br></label>
						<label>Mot de passe<br><input required type="password" name="mdp"><br></label>

						<button type="submit" class="btn btn-outline-light">Se connecter</button>
					</form>
						
					<hr>

					<a href="inscription.php"><button class="btn btn-outline-light">Créer un compte ?</button></a>
			</div>
		</section>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
</body>
</html>