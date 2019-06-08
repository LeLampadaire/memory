<?php 
    session_start();
    require_once 'configuration.php';
    require_once 'dbb_connexion.php'; 

    $sondages = mysqli_query($bdd, "SELECT id, titre, option1, option2, option3, date_publication FROM sondage_questions ORDER BY date_publication DESC"); 
    $numbers = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twenty-one", "twenty-two", "twenty-three", "twenty-four", "twenty-five", "twenty-six", "twenty-seven", "twenty-eight", "twenty-nine", "thirty", "thirty-one", "thirty-two", "thirty-three", "thirty-four", "thirty-five", "thirty-six", "thirty-seven", "thirty-eight", "thirty-nine", "forty", "forty-one", "forty-two", "forty-three", "forty-four", "forty-five", "forty-six", "forty-seven", "forty-eight", "forty-nine", "fifty", "fifty-one", "fifty-two", "fifty-three", "fifty-four", "fifty-five", "fifty-six", "fifty-seven", "fifty-eight", "fifty-nine", "sixty", "sixty-one", "sixty-two", "sixty-three", "sixty-four", "sixty-five", "sixty-six", "sixty-seven", "sixty-eight", "sixty-nine", "seventy", "seventy-one", "seventy-two", "seventy-three", "seventy-four", "seventy-five", "seventy-six", "seventy-seven", "seventy-eight", "seventy-nine", "eighty", "eighty-one", "eighty-two", "eighty-three", "eighty-four", "eighty-five", "eighty-six", "eighty-seven", "eighty-eight", "eighty-nine", "ninety", "ninety-one", "ninety-two", "ninety-three", "ninety-four", "ninety-five", "ninety-six", "ninety-seven", "ninety-eight", "ninety-nine", "hundred");
    $aujourdhui = new DateTime();

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
                            $dateExpi = new DateTime($donnees['date_publication']);
                            $dateExpi->add(new DateInterval('P15D'));

                            if($dateExpi->format('Y-m-d') > $aujourdhui->format('Y-m-d')){
                                echo "<span class='badge badge-danger'>New</span>";
                            }
                        ?> 
                    </a>
                </div>

                <div id="<?php echo $numbers[$donnees['id']]; ?>" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <form>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios1" value="option1" checked>
                                        <?php echo utf8_encode($donnees['option1']); ?>
                                    </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios2" value="option2">
                                        <?php echo utf8_encode($donnees['option2']); ?>
                                    </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios3" value="option3">
                                        <?php echo utf8_encode($donnees['option3']); ?>
                                    </label>
                            </div>
                            
                            <button class="btn btn-primary" type="submit" value="Submit">Envoyé !</button>
                        </form>
                    </div>
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