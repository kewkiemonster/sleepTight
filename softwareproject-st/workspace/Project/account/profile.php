<?php
    require '../includes/db.php';
    session_start();
    
   $active_page = "profile";
    
    
?>

<!DOCTYPE html>
<head>
    <title>Profile</title>
        
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        <!-- Style -->
        <link rel="stylesheet" href="/Project/css/style.css"/>
</head>
    
<body>
      
     <!--NAVIGATION-->
     <?php include '../includes/usernav.php'; ?>
     
     <?php 
        // if ID is not null, get ID and show profile
        if ($_SESSION['uid'] !== ""){ 
     ?>
     
     <div class="container">
         <div class="card text-center">
            <?php
                // Get user profile based on ID of row
                $query = $mysqli->query("SELECT * FROM users WHERE uid = '" .$_SESSION['uid']."'");
                $user = $query->fetch_assoc();
            ?>
            
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link">User</a>
                    </li>
                    <li class="nav-item" style="padding-left: 15px; padding-top: 5px;">
                        <?php 
                            if($_SESSION['uid'] == $_GET['id']){ ?>
                                <a href="/Project/account/edit.php?id=<?php echo $_GET['id']; ?>"> Edit</a>
                            <?php }
                        ?>
                    </li>
                </ul> <!-- nav end -->
            </div>
            
            <div class="container">
                <div class="col-12">
                    <?php 
                        // If user -> no pic, use default
                        if($user['image'] == ""){ ?>
                            <img src='/Project/images/default.png' alt='Default picture' style="width: 250px; height: 250px;"/>
                        <?php } else { //use uploaded img ?>
                            <img src ='Project/images/<?php echo $user['image'] ?>' alt='Profile picture'/>
                        <?php }
                    ?>
                </div>
            </div>
            
            
            <!--NAME + INFO-->
            <div class="container" style="padding-bottom: 15px;">
                <h2><?php echo $user['uname']; ?></h2>
                
                <?php
                    if ($user['detail'] == ""){ ?>
                        <div class="col-12">[No Desc]</div></br>
                    <?php } else { // present user description ?>  
                        <div class="col-12"><?php echo $user['detail']; ?></div></br>
                    <?php }
                ?>
                
                <i class="fa fa-envelope fa-2x" style="padding-bottom: 15px;"></i> <a href="mailto:<?php echo $user['email']; ?>"> <?php echo $user['email']; ?></a> 
             </div>
         </div> <!-- card end -->
     </div> <!-- container end -->
     
     <?php 
        if (isset($_SESSION['message'])){ ?>
            <div class="<?php echo $_SESSION['message-type']; ?>">
                <div class="message-content">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                </div>
            </div> 
       <?php } else{
           //display nothing 
       }
     ?>
     
      <?php } //$_GET end 
        else {
          header('location: ../account/homepage.php');
        }
      ?>
</body>
</html>