<?php 
    require 'includes/db.php';
    session_start();
    
    $active_page = "about";
?>

<!DOCTYPE html>
<head>
    <title>ABOUT PAGE</title>
    
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        <!-- Style -->
        <link rel="stylesheet" href="css/style.css"/>
        <!--Animation-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
        
</head>

<body>
    
    <!--NAVIGATION-->
    <?php include 'includes/navbar.php'; ?>
    
    <!--CARD DECK-->
    <div class="container">
        <div class="card-deck">
            <div class="card animated zoomIn text-center" style="width: 30rem;">
              <div class="card-header"><span class="fa fa-bed fa-5x"></span></div>
              <div class="card-block">
                <h2 class="card-title">Sleep</h2>
                <p class="card-text">Get comfortable while we track your surroundings using GrovePi sensors.</p>
              </div>
            </div>
            
            <div class="card animated zoomIn text-center" style="width: 30rem;">
              <div class="card-header"><span class="fa fa-line-chart fa-5x"></span></div>
              <div class="card-block">
                <h2 class="card-title">Track</h2>
                <p class="card-text"></p>Using our hardware, let RaspberryPi 3 model-B along with GrovePi+ and sensors track your sleeping environtment<p>
              </div>
            </div>
            
            <div class="card animated zoomIn text-center" style="width: 30rem;">
              <div class="card-header"><span class="fa fa-gear fa-spin fa-5x"></span></div>
              <div class="card-block">
                <h2 class="card-title">Analyse</h2>
                <p class="card-text">Study the data readings gathered from the GrovePi sensors so you can make adjustments in your sleeping habits or start a good sleeping habit.</p>
              </div>
            </div>
        
        </div> <!-- Deck end -->
    </div> <!-- Container end -->

    <div class="container">
      <div class="card-body text-center">
        <h5 class="card-title">Sleep-Right, Sleep-Tight </h5>
        <p class="card-text">Getting a good night's sleep helps boost your mood and makes you feel better. </p>
        <p class="card-text">Having an adequate amount of sleep is a key to a healthy lifestyle that can benefit your overall physical and mental health. </p>
      </div>
            
    </div>

</body>
</html>