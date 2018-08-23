<?php
    require '../includes/db.php';
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>HOMEPAGE</title>
    
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
        <link rel="stylesheet" href="/Project/css/style.css"/>
         <!--Animation-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
</head>

<body>
    
  <!--NAVIGATION    -->
  <?php include '../includes/usernav.php' ?>
    
    <!--LINKS TO OTHER PAGES-->
        <div class="container animated fadeInLeft">
            <div class="card text-center" style="background: #00aab7;">
                <div class="card-header">User Profile</div>
                  <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><i class="fa fa-user fa-3x"></i></p>
                        <p>View and Edit your profile here</p>
                    <a href="/Project/account/edit.php" class="btn btn-light">Profile</a>
                  </div>
                  <div class="card-footer text-muted">
                  </div>
             </div>
        </div>
    
        <div class="container animated fadeInRight">
            <div class="card text-center" style="background: #f0cacf;">
                <div class="card-header">Data</div>
                  <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><i class="fa fa-area-chart fa-3x"></i></p>
                        <p>View your sensor readings here</p>
                    <a href="/Project/account/data.php" class="btn btn-light">Data</a>
                  </div>
                  <div class="card-footer text-muted">
                  </div>
             </div>
        </div>
    
        <div class="container animated fadeInLeft" style="padding-bottom: 25px;">
            <div class="card text-center" style="background: #d6e4ba;">
                <div class="card-header">Help</div>
                  <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><i class="fa fa-star fa-3x"></i></p>
                        <p>Want to know how to get a good quality sleep? Here are some applications and sites as well as tips into getting a good night's rest</p>
                    <a href="/Project/account/link.php" class="btn btn-light">Links</a>
                  </div>
                  <div class="card-footer text-muted">
                  </div>
             </div>
         </div> 

</body>
</html>