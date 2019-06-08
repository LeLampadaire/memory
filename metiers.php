<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

    $metiers = mysqli_query($bdd, "SELECT id, id_membre, alchimiste, bijoutier, bricoleur, bucheron, chasseur, cordomage, cordonnier, costumage, tailleur, facomage, faconneur, forgemage, forgeron, joaillomage, mineur, paysan, pecheur, sculptemage, sculpteur FROM metiers"); 

    function functionMetiers($nomMetier){
        if(isset($donnees_metiers['$nomMetier'])){
            echo $donnees_metiers['$nomMetier'];
        }else{
            echo "/";
        }
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
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Alchimiste</th>
                <th scope="col">Bijoutier</th>
                <th scope="col">Bricoleur</th>
                <th scope="col">Bucheron</th>
                <th scope="col">Chasseur</th>
                <th scope="col">Cordomage</th>
                <th scope="col">Cordonnier</th>
                <th scope="col">Costumage</th>
                <th scope="col">Tailleur</th>
                <th scope="col">Façomage</th>
                <th scope="col">Façonneur</th>
                <th scope="col">Forgemage</th>
                <th scope="col">Forgeron</th>
                <th scope="col">Joaillomage</th>
                <th scope="col">Mineur</th>
                <th scope="col">Paysan</th>
                <th scope="col">Pêcheur</th>
                <th scope="col">Sculptemage</th>
                <th scope="col">Sculpteur</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    foreach($metiers as $donnees_metiers){ 
                    $membres = $bdd->query("SELECT id, pseudo FROM membres"); ?>
                <tr>
                    <th class="border-secondary" scope="row">
                        <?php 
                            foreach($membres as $donnees_membres){
                                if($donnees_metiers['id_membre'] == $donnees_membres['id']){
                                    echo $donnees_membres['pseudo'];
                                }
                            }
                        ?>
                    </th>
                    <td class='border-left border-secondary'><?php functionMetiers("alchimiste"); ?></td>
                    <td class='border-left border-secondary'><?php functionMetiers("bijoutier"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("bricoleur"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("bucheron"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("chasseur"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("cordomage"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("cordonnier"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("costumage"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("tailleur"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("facomage"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("faconneur"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("forgemage"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("forgeron"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("joaillomage"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("mineur"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("paysan"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("pecheur"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("sculptemage"); ?></td> 
                    <td class='border-left border-secondary'><?php functionMetiers("sculpteur"); ?></td> 
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