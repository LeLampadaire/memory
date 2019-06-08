<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

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

    <h1 class="titre-page">Membres</h1>
    
    <div class="box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Classe principale</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Étude</th>
                    <th scope="col">Travail</th>
                    <th scope="col">Région</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($membres as $donnees){ ?>
                <tr>
                    <td class="logo"><img class="logo-membre" src="<?php echo utf8_encode($donnees['classe_principale']);?>" alt="Logo"></td>
                    <?php echo "<td>" . utf8_encode($donnees['pseudo']) . "</td>"; ?>
                    <?php echo "<td>" . utf8_encode($donnees['prenom']) . "</td>"; ?>
                    <?php   if(isset($donnees['etude'])){
                                echo "<td>" . utf8_encode($donnees['etude']) . "</td>"; 
                            }else{
                                echo "<td>/</td>";
                            } ?>
                    <?php   if(isset($donnees['travail'])){
                                echo "<td>" . utf8_encode($donnees['travail']) . "</td>"; 
                            }else{
                                echo "<td>/</td>";
                            } ?>
                    <?php   if(isset($donnees['region'])){
                                echo "<td>" . utf8_encode($donnees['region']) . "</td>";
                            }else{
                                echo "<td>/</td>";
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