<!DOCTYPE html>

<?php require 'configuration.php' ?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .footerBottom{
            position: fixed;
            z-index: 2;
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
    <div class="card-footer text-center footerBottom" style="color: white;">
        <?php echo $Footer; ?>
    </div>
</body>
</html>