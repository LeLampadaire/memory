<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
    
    $membres = mysqli_query($bdd, "SELECT id, classe_principale, pseudo, prenom, etude, travail, region FROM membres ORDER BY pseudo ASC"); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Membres</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="js/bootstrap.min.js" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-membres.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page" style="color: rgb(255, 115, 0);">Membres</h1>
    
    <div class="box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Classe principale</th>
                    <th scope="col">Rang</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Étude</th>
                    <th scope="col">Travail</th>
                    <th scope="col">Région</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($membres as $donnees){ 
                        $role = mysqli_query($bdd, 'SELECT rang.id as id, nom FROM membres INNER JOIN rang ON(membres.id_rang = rang.id) WHERE membres.id = '.$donnees['id'].';');
                        $role = mysqli_fetch_array($role, MYSQLI_ASSOC); ?>
                <tr>
                    <td class="logo"><img src="<?php echo utf8_encode($donnees['classe_principale']);?>" alt="Logo" width="80"></td>
                    <?php if($role['id'] == 1){ 
                        echo '<td><br><span class="badge badge-primary">'.utf8_encode($role['nom']).'</span></td>';
                    }else if($role['id'] == 2){
                        echo '<td><br><span class="badge badge-warning">'.utf8_encode($role['nom']).'</span></td>';
                    }else if($role['id'] == 3){
                        echo '<td><br><span class="badge badge-danger">'.utf8_encode($role['nom']).'</span></td>';
                    } ?>
                    <?php echo "<td><br><a href='profil.php?idprofil=".$donnees['id']."' alt='Page de profil' style='color: white; text-decoration: underline;'>" . utf8_encode($donnees['pseudo']) . "</a></td>"; ?>
                    <?php echo "<td><br>" . utf8_encode($donnees['prenom']) . "</td>"; ?>
                    <?php   if(isset($donnees['etude'])){
                                echo "<td><br>" . utf8_encode($donnees['etude']) . "</td>"; 
                            }else{
                                echo "<td><br>/</td>";
                            } ?>
                    <?php   if(isset($donnees['travail'])){
                                echo "<td><br>" . utf8_encode($donnees['travail']) . "</td>"; 
                            }else{
                                echo "<td><br>/</td>";
                            } ?>
                    <?php   if(isset($donnees['region'])){
                                echo "<td><br>" . utf8_encode($donnees['region']) . "</td>";
                            }else{
                                echo "<td><br>/</td>";
                            } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <br>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->

</body>
</html>