<!DOCTYPE html>

<?php require 'configuration.php' ?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .footerBottom{
            position: fixed;
            z-index: 3;
            bottom: 0;
            margin-left: 120px;
            font-size: 16px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }
    </style>
  </head>
<body>
    <br><br>
    <div class="card-footer footerBottom" style="color: white;">
        <div class="text-center" style="margin-left: -150px;"><?php echo $Footer; ?></div>
        <?php if(!empty($_SESSION)){ ?>
          <div style="position: fixed; bottom:5px; left:5px;">
            <form action="deconnexion.php" method="POST">
              <button type="submit" class="btn btn-outline-warning">Déconnexion</button>
            </form>
          </div>
        <?php }else{ ?>
          <div style="position: fixed; bottom:5px; left:5px;">
            <form action="connexion.php" method="POST">
              <button type="submit" class="btn btn-outline-warning">Connexion</button>
            </form>
          </div>
        <?php } ?>
    </div>
    
</body>
</html>