<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

	$Pseudo = $_SESSION['pseudo'];
	$idPseudo = $_SESSION['idprofil'];

	if(empty($_SESSION)){
		header('Location: 404.php');
    }
    
    $sondages = mysqli_query($bdd, "SELECT * FROM sondage_questions ORDER BY id DESC"); 
    $numbers = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty", "thirty-one", "thirty-two", "thirty-three", "thirty-four", "thirty-five", "thirty-six", "thirty-seven", "thirty-eight", "thirty-nine", "forty", "forty-one", "forty-two", "forty-three", "forty-four", "forty-five", "forty-six", "forty-seven", "forty-eight", "forty-nine", "fifty", "fifty-one", "fifty-two", "fifty-three", "fifty-four", "fifty-five", "fifty-six", "fifty-seven", "fifty-eight", "fifty-nine", "sixty", "sixty-one", "sixty-two", "sixty-three", "sixty-four", "sixty-five", "sixty-six", "sixty-seven", "sixty-eight", "sixty-nine", "seventy", "seventy-one", "seventy-two", "seventy-three", "seventy-four", "seventy-five", "seventy-six", "seventy-seven", "seventy-eight", "seventy-nine", "eighty", "eighty-one", "eighty-two", "eighty-three", "eighty-four", "eighty-five", "eighty-six", "eighty-seven", "eighty-eight", "eighty-nine", "ninety", "ninety-one", "ninety-two", "ninety-three", "ninety-four", "ninety-five", "ninety-six", "ninety-seven", "ninety-eight", "ninety-nine", "hundred");
    
    // Date du jour
    $aujourdhui=time("Y-m-d H:i:s");
    
    // Ajout de 2h (Quand on prends le temps, il est 2 heures en retard)
    $aujourdhui=$aujourdhui+7200;

    // Repasse en format date
    $aujourdhui=date("Y-m-d H:i:s",$aujourdhui);

    if(!empty($_POST)){
        $id = $_POST['id'];
        $option = $_POST['option'];
        mysqli_query($bdd, 'INSERT INTO sondage_reponse(id, id_questions, choix, id_membres) VALUES (NULL, '.$id.', "'.$option.'", '.$idPseudo.');');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="icons/favicon.ico" />
    <title><?php echo $NomSite; ?> - Sondages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles-sondages.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

    <!-- HEADER -->
    <?php require('header.php'); ?>
    <!-- HEADER -->

    <h1 class="titre-page">Sondages</h1>
    
    <div class="box">
        <div id="accordion">

            <?php foreach($sondages as $donnees){ ?>

            <div>
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#<?php echo $numbers[$donnees['id']]; ?>"><?php echo utf8_encode($donnees['titre']); ?>
                        <?php                             
                            $vote_sondage = mysqli_query($bdd, 'SELECT * FROM sondage_reponse WHERE id_questions='.$donnees['id'].' AND id_membres='.$_SESSION['idprofil'].';'); 
                            $vote_sondage = mysqli_fetch_array($vote_sondage, MYSQLI_ASSOC);
                            
                            $dateExpi = new DateTime($donnees['date_publication']);
                            $dateExpi->add(new DateInterval('P15D'));

                            if($vote_sondage == NULL AND $donnees['open'] == 1 AND $dateExpi->format('Y-m-d H:i') > $aujourdhui){
                                echo "<span class='badge badge-danger'>New</span>";
                            }
                        ?> 
                    </a>
                </div>

                <div id="<?php echo $numbers[$donnees['id']]; ?>" class="collapse" data-parent="#accordion">
                    <?php if($donnees['open'] == 1){ ?>

                        <div class="card-body">
                            <?php 
                                $vote = mysqli_query($bdd, 'SELECT * FROM sondage_reponse WHERE id_questions = '.$donnees['id'].' AND id_membres = '.$idPseudo.'');
                                $vote = mysqli_fetch_array($vote, MYSQLI_ASSOC);
                            ?>
                            <form action="" method="POST">

                                <?php if($donnees['option1'] != NULL){ ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="option" value="option1" checked <?php if($vote != NULL){ echo "disabled"; }?>>
                                            <?php echo utf8_encode($donnees['option1']); ?>
                                        </label>
                                    </div>
                                <?php } ?>

                                <?php if($donnees['option2'] != NULL){ ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="option" value="option2" <?php if($vote != NULL){ echo "disabled"; }?>>
                                            <?php echo utf8_encode($donnees['option2']); ?>
                                        </label>
                                    </div>
                                <?php } ?>
                                
                                <?php if($donnees['option3'] != NULL){ ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="option" value="option3" <?php if($vote != NULL){ echo "disabled"; }?>>
                                            <?php echo utf8_encode($donnees['option3']); ?>
                                        </label>
                                    </div>
                                <?php } ?>
                                <input type="hidden" value="<?php echo $donnees['id']; ?>" name="id">
                                <?php if($vote != NULL){ 
                                    echo '<button class="btn btn-danger" type="button" disabled>Déjà voté !</button>';
                                }else{
                                    echo '<button class="btn btn-primary" type="submit">Votez !</button>';
                                } ?>
                            </form>
                        </div>

                    <?php }else{
                        $choix = mysqli_query($bdd, 'SELECT id, titre, option1, option2, option3 FROM sondage_questions WHERE id = '.$donnees['id'].';');
                        $choix = mysqli_fetch_array($choix, MYSQLI_ASSOC);

                        $total1 = mysqli_query($bdd, 'SELECT COUNT(id_questions) as somme FROM sondage_reponse WHERE choix = "option1" AND id_questions = '.$donnees['id'].';');
                        $total1 = mysqli_fetch_array($total1, MYSQLI_ASSOC);
                        if($total1 == NULL){
                            $total1 = 0;
                        }else{
                            $total1 = $total1['somme'];
                        }
                        
                        $total2 = mysqli_query($bdd, 'SELECT COUNT(id_questions) as somme FROM sondage_reponse WHERE choix = "option2" AND id_questions = '.$donnees['id'].';');
                        $total2 = mysqli_fetch_array($total2, MYSQLI_ASSOC);
                        if($total2 == NULL){
                            $total2 = 0;
                        }else{
                            $total2 = $total2['somme'];
                        }
                        
                        $total3 = mysqli_query($bdd, 'SELECT COUNT(id_questions) as somme FROM sondage_reponse WHERE choix = "option3" AND id_questions = '.$donnees['id'].';');
                        $total3 = mysqli_fetch_array($total3, MYSQLI_ASSOC);
                        if($total3 == NULL){
                            $total3 = 0;
                        }else{
                            $total3 = $total3['somme'];
                        }

                        ?>
                        <div class="card-body">
                            <div class="alert alert-primary" role="alert">
                                <h6>Résultat :</h6><br>
                                <p><?php if($choix['option1'] != NULL){ echo 'Choix 1 -> '.utf8_encode($choix['option1']).' = '.$total1.' !'; } ?></p>
                                <p><?php if($choix['option2'] != NULL){ echo 'Choix 2 -> '.utf8_encode($choix['option2']).' = '.$total2.' !'; }  ?></p>
                                <p><?php if($choix['option3'] != NULL){ echo 'Choix 3 -> '.utf8_encode($choix['option3']).' = '.$total3.' !'; }  ?></p>

                            </div>
                        </div>
                    
                    <?php } ?>
                </div>
            </div>

            <?php } ?>

        </div>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php'); ?>
    <!-- FOOTER -->
    
</body>
</html>