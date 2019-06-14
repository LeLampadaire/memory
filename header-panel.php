<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .fondMenu{
          position: fixed;
          z-index: 3;
	        top: -35px;
          left: 0;
          background-color: rgba(0, 0, 0, 0.6);
          width: 120px;
          height: 105%;
        }

        #mySidenav a {
          position: fixed;
          left: -120px;
          z-index: 3;
          transition: 0.3s;
          padding: 15px;
          width: 180px;
          text-decoration: none;
          font-size: 20px;
          color: black;
          border-radius: 0 10px 10px 0;
        }
          
        #mySidenav a:hover {
          left: 0;
        }

        #accueil{
          top: 20px;
          background-color: rgb(255, 0, 0);
          background-image: url('icons/icons-32/dashboard.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
          
        #sondages{
          top: 85px;
          background-color: rgb(255, 115, 0);
          background-image: url('icons/icons-32/sondages.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
          
        #popcorn{
          top: 150px;
          background-color: rgb(245, 224, 35);
          background-image: url('icons/icons-32/popcorn.png');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #paris{
          top: 215px;
          background-color: rgb(51, 255, 0);
          background-image: url('icons/icons-32/paris.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
        
        #rang{
          top: 280px;
          background-color: rgb(0, 175, 102);
          background-image: url('icons/icons-32/membres.png');
          background-repeat: no-repeat;
          background-position: right; 
        }

        #site{
          bottom: 50px;
          background-color: rgb(140, 0, 255);
          background-image: url('icons/icons-32/popcorn.png');
          background-repeat: no-repeat;
          background-position: right; 
        }
    </style>
  </head>
<body>
  <div class="fondMenu">
    <div id="mySidenav" class="sidenav">
      <a href="panel.php" id="accueil">Panel</a>
      <a href="modification-sondages.php" id="sondages">Sondages</a>
      <a href="modification-popcorn.php" id="popcorn">Porcorn</a>
      <a href="modification-paris.php" id="paris">Paris</a>
      <?php if($_SESSION['id_rang'] == 3){ echo '<a href="modification-rang.php" id="rang">Rang</a>'; } ?>
      <a href="index.php" id="site">Site</a>
    </div>
  </div>
</body>
  
</html>
