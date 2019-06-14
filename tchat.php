<?php 
	session_start();
	require_once 'configuration.php';
	require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
	}
	
	$recherche_on = 0;

	if(isset($_POST['text-message']) && !empty($_POST['text-message'])){
		$message = $_POST['text-message'];
		$recepteur = $_POST['recepteur'];
		$resultat = mysqli_query($bdd,'INSERT INTO tchat(idMsg,timestampMsg,contenu,lu,idProfil_recepteur,idProfil_emetteur) VALUES(NULL, CURRENT_TIMESTAMP(), "'.$message.'", 0, '.$recepteur.', '.$idPseudo.');');
	}

	if(isset($_POST['text-message-new']) && !empty($_POST['text-message-new'])){
		$message = htmlspecialchars($_POST['text-message-new']);
		$recepteur = $_POST['id-new-message'];
		$resultat = mysqli_query($bdd,'INSERT INTO tchat(idMsg,timestampMsg,contenu,lu,idProfil_recepteur,idProfil_emetteur) VALUES(NULL, CURRENT_TIMESTAMP(), "'.$message.'", 0, '.$recepteur.', '.$idPseudo.');');
	}

	// Vérifier si il a fait une recherche et regarder si ça corresponds à l'id d'une personne dans le tchat déjà utilisé sinon afficher la page de tchat avec la personne à qui on veut parler 
	if(isset($_POST['membres-list-choice']) && !empty($_POST['membres-list-choice'])){
		$recherche_membre = $_POST['membres-list-choice']; // Récupère le nom de la personne entré dans la recherche
		$requete_recherche = mysqli_query($bdd, 'SELECT id FROM membres where pseudo ="'.$recherche_membre.'";');
		$requete_ok = mysqli_fetch_array($requete_recherche, MYSQLI_ASSOC); // Recupère l'id du joueur entré dans la recherche
		$recherche_on = 1;
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="icons/favicon.ico" />
		<title><?php echo $NomSite; ?> - Tchat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/styles-tchat.css">
</head>

<body class="bg-secondary">
	<div>
		
    <!-- HEADER -->
		<?php require_once('header.php'); ?>
    <!-- HEADER -->

		<h1 class="titre-page" style="color: rgb(0, 175, 102);">Tchat</h1>

		<!-- Contenu principale -->
		<section class="thebody text-center text-white">

			<div class="text-center">


					<div class="row">

						<div class="col-4">

							<div class="row">
								<div class="col-12">

									<form action="" method="POST"> <!-- Nouvelle discussion -->
										<div class="input-group mb-3" style="width: 100%">
											<input list="membres-list" id="membres-list-choice" name="membres-list-choice">
											<datalist id="membres-list">
												<?php 
									 				if($recherche_on == 1){
														echo '<option value="'.$recherche_membre.'">'.$recherche_membre.'</option>';
													}

													$listmembre = mysqli_query($bdd,'SELECT id, pseudo FROM membres ORDER BY pseudo');

													foreach($listmembre as $value){
														if($Pseudo != $value['pseudo']){
															echo '<option value="'.$value['pseudo'].'">'.$value['pseudo'].'</option>';
														}
													}
												?>
											</datalist>
											<div class="input-group-append">
												<input class="btn btn-primary" type="submit" value="Créez !">
											</div>
										</div>
									</form>

								</div>
							</div>

							<div class="card bg-secondary" style="max-height: 400px;">

								<div class="card-body">

									<div class="row">
										<div class="col-12">
											<div class="list-group" id="list-tab" role="tablist">

											<?php 
												
												$listetchat = mysqli_query($bdd,'SELECT DISTINCT id, pseudo FROM membres, tchat WHERE (membres.id = tchat.idProfil_recepteur OR membres.id = tchat.idProfil_emetteur) AND ('.$idPseudo.' = tchat.idProfil_recepteur OR '.$idPseudo.' = tchat.idProfil_emetteur) AND '.$idPseudo.' <> membres.id ORDER BY tchat.idMsg DESC;');
												
												foreach($listetchat as $recherche){ // Vérifie que la création de la nouvelle discussion ne soit pas déjà la
													if($recherche_on == 1 && $recherche_membre == $recherche['pseudo']){
														$recherche_on = 0;
													}
												}

												if($recherche_on == 1){
													// Remplace les caractères si dessous afin de pouvoir lier les "list"
													$nomReplaceRecherche = str_replace(" ","_",$recherche_membre);
													$nomReplaceRecherche = str_replace(".","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("°","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("?","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("'","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("\"","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("@","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("!","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("&","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace("#","_",$nomReplaceRecherche);
													$nomReplaceRecherche = str_replace(",","_",$nomReplaceRecherche);
													echo '<a class="list-group-item list-group-item-action" id="list-'.$nomReplaceRecherche.'-list" data-toggle="list" href="#list-'.$nomReplaceRecherche.'" role="tab" aria-controls="'.$nomReplaceRecherche.'">'.$recherche_membre.'</a>';
												}

												foreach($listetchat as $donnees){
													if($donnees['pseudo'] != $Pseudo){
														$nomReplaceProfil = str_replace(" ","_",$donnees['pseudo']);
														$nomReplaceProfil = str_replace(".","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("°","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("?","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("'","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("\"","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("@","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("!","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("&","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace("#","_",$nomReplaceProfil);
														$nomReplaceProfil = str_replace(",","_",$nomReplaceProfil);

														echo '<a class="list-group-item list-group-item-action" id="list-'.$nomReplaceProfil.'-list" data-toggle="list" href="#list-'.$nomReplaceProfil.'" role="tab" aria-controls="'.$nomReplaceProfil.'">'.$donnees['pseudo'].'';
															$compteur = mysqli_query($bdd,'SELECT COUNT(idMsg)-SUM(lu) as Nbr FROM `tchat` WHERE idProfil_recepteur = '.$idPseudo.' AND idProfil_emetteur = '.$donnees['id'].';');
															$cpt = mysqli_fetch_array($compteur, MYSQLI_ASSOC);
															
															if($cpt['Nbr'] != 0){
																echo '   <span class="badge badge-pill badge-success">'.$cpt['Nbr'].'</span>';
															}
														echo '</a>';
													}
												}

											?>

											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="col-8">

							<div class="card bg-secondary">

								<div id="FixScrollBottom" class="card-body tab-content text-dark" style="max-height: 415px; min-height: 415px; overflow: auto;">
											
									<?php if($recherche_on == 1){ ?>

										<div class="tab-pane fade" id="list-<?php echo $nomReplaceRecherche; ?>" role="tabpanel" aria-labelledby="list-<?php echo $nomReplaceRecherche; ?>-list" style="padding-bottom: 60px;">

											<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 80px;">
												<h2 class="text-center">Nouvelle discussion avec <?php echo $recherche_membre; ?></h2>
											</div>

											<div style="position: absolute; bottom: 0; width: 90%;">
												<form action="" method="POST">
													<div class="input-group mb-3">
														<input type="text" class="form-control" placeholder="Votre message ..." aria-label="Votre message ..." aria-describedby="button-envoyez" name="text-message-new">
														<input type="hidden" name="recepteur" value="<?php echo $recherche_membre; ?>">
														<div class="input-group-append">
															<input class="btn btn-primary" type="submit" value="Envoyez !">
														</div>
														<input type="hidden" name="id-new-message" value="<?php echo $requete_ok['id']; ?>">
													</div>
												</form>
											</div>

										</div>

									<?php	} ?>

									<?php 
										$listtchat = mysqli_query($bdd,'SELECT DISTINCT id, pseudo FROM membres, tchat WHERE (membres.id = tchat.idProfil_recepteur OR membres.id = tchat.idProfil_emetteur) AND ('.$idPseudo.' = tchat.idProfil_recepteur OR '.$idPseudo.' = tchat.idProfil_emetteur) AND '.$idPseudo.' <> membres.id ORDER BY tchat.idMsg DESC;');
										
										foreach($listtchat as $tchat_donnees){
											$nomReplace = str_replace(" ","_",$tchat_donnees['pseudo']);
											$nomReplace = str_replace(".","_",$nomReplace);
											$nomReplace = str_replace("°","_",$nomReplace);
											$nomReplace = str_replace("?","_",$nomReplace);
											$nomReplace = str_replace("'","_",$nomReplace);
											$nomReplace = str_replace("\"","_",$nomReplace);
											$nomReplace = str_replace("@","_",$nomReplace);
											$nomReplace = str_replace("!","_",$nomReplace);
											$nomReplace = str_replace("&","_",$nomReplace);
											$nomReplace = str_replace("#","_",$nomReplace);
											$nomReplace = str_replace(",","_",$nomReplace);

											$tchat_do = $tchat_donnees['id'];
										?>

										<div class="tab-pane fade" id="list-<?php echo $nomReplace; ?>" role="tabpanel" aria-labelledby="list-<?php echo $nomReplace; ?>-list" style="padding-bottom: 35px;">
											
											<?php 
											$messages = mysqli_query($bdd,'SELECT DATE_FORMAT(timestampMsg, "%d/%m/%y > %Hh%i") as dateMsg, idProfil_recepteur, idProfil_emetteur, contenu FROM tchat WHERE ('.$idPseudo.' = tchat.idProfil_emetteur AND '.$tchat_do.' = tchat.idProfil_recepteur) OR ('.$tchat_do.' = tchat.idProfil_emetteur AND '.$idPseudo.' = tchat.idProfil_recepteur)');

											foreach($messages as $donnees){ 
											$image = mysqli_query($bdd,'SELECT id, classe_principale FROM membres WHERE id = '.$donnees['idProfil_emetteur'].'');
											$imagess = mysqli_fetch_array($image, MYSQLI_ASSOC);

											$MsgLu = mysqli_query($bdd,'UPDATE tchat SET lu = 1 WHERE lu = 0 AND idProfil_recepteur = '.$idPseudo.' AND idProfil_emetteur = '.$imagess['id'].';');
											?>
											
												<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;">

													<?php if($donnees['idProfil_emetteur'] == $idPseudo){ ?>
														<div class="toast" style="position: absolute; top: 0; right: 0;" data-autohide="false"> <!--DROITE-->
															<div class="toast-header">
																<img src="<?php echo $imagess['classe_principale']; ?>" class="rounded mr-2" alt="Logo" height="20px">
																<strong class="mr-auto"><?php echo $Pseudo; ?></strong>
																<small><?php echo $donnees['dateMsg']; ?></small>
															</div>
															<div class="toast-body">
																	<?php echo htmlspecialchars(utf8_encode($donnees['contenu'])); ?>
															</div>
														</div>
													<?php }else{ ?>
														<div class="toast" style="position: absolute; top: 0; left: 0;" data-autohide="false"> <!--GAUCHE-->
															<div class="toast-header">
																<img src="<?php echo $imagess['classe_principale']; ?>" class="rounded mr-2" alt="Logo" height="20px">
																<strong class="mr-auto"><?php echo $tchat_donnees['pseudo']; ?></strong>
																<small><?php echo $donnees['dateMsg']; ?></small>
															</div>
															<div class="toast-body">
																	<?php echo htmlspecialchars(utf8_encode($donnees['contenu'])); ?>
															</div>
														</div>
													<?php } ?>

												</div>
											<?php } ?>

												<div style="position: absolute; bottom: 0; width: 90%;;">
													<form action="" method="POST">
														<div class="input-group mb-3">
															<input type="text" class="form-control" placeholder="Votre message ..." aria-label="Votre message ..." aria-describedby="button-envoyez" name="text-message">
															<input type="hidden" name="recepteur" value="<?php echo $tchat_donnees['id']; ?>">
															<div class="input-group-append">
																<input class="btn btn-primary" type="submit" value="Envoyez !">
															</div>
														</div>
													</form>
												</div>

										</div>

									<?php } ?>

								</div>

							</div>

						</div>

					</div>


			</div>

		</section>
		<!-- Footer -->
		<?php 
			require_once('footer.php'); 
			mysqli_close($bdd);
		?>

<script>
	//Affichage des Toasts
	$('.toast').toast('show');
</script>

</body>
</html>

