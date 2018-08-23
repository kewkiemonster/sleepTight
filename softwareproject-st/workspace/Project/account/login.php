<?php 
    require '../includes/db.php';
    session_start();
    
    $active_page = "login";
    
    //Login session 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['login'])){
          
            //escape string -> SQL injection
            $email = $mysqli->escape_string($_POST['email']);
            $password = $mysqli->escape_string($_POST['password']);
            
            //If user has an account -> get their email
            $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
            
            //If user does not exist
            if ($result->num_rows == 0){
              $_SESSION['message-type'] = "error-message";
              $_SESSION['message'] = "User does not exist";
            }
            else { //else fetch all associated detail to that user ID 
              $user = $result->fetch_assoc();
              
              if (password_verify($_POST['password'], $user['password'])){
                //Session Variables 
                $_SESSION['email'] = $user['email'];
                $_SESSION['uname'] = $user['uname'];
                $_SESSION['uid'] = $user['uid'];
                
                // If user is logged in
                $_SESSION['loggedin'] = true;
                
                // logged in successfully
                $_SESSION['message-type'] = "success-message";
                $_SESSION['message'] = "Logged in";
                
                // redirect user to homepage
                header('location: ../../Project/account/homepage.php');
                
              }else {
                // incorrecct password 
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "Incorrect Password";
              }
            }
        }
        
    }

?>

<!DOCTYPE html>
<head>
    <title>LOGIN PAGE</title>
    
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
  <?php 
    if ($_SESSION['loggedin'] === true){
        header('location: ../../Project/account/homepage.php');
        exit;
    }else {  ?>

    <!--NAVIGATION-->
    <?php include '../includes/navbar.php'; ?>
  
    <!--Login Form-->
    <div class="container">
     <div class="row justify-content-md-center">
        
        
        <!--Login Icon-->
      <div class="col-md-12">
          <h1 class="icon text-center"><i class="fa fa-user-circle fa-3x"></i></h1>
          <h2 class="icon font-content text-center">Login</h2>
        </div>
      </div> <!-- Row end-->
      
      <form method="post" autocomplete="off">
      <div class="container">
          <div class="form-group">
              <div class="col-md-6">
                <label for="inputmail">Email address:</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" autocomplete="off" required >
              </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-6">
              <label for="inputPassword">Password:</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off" required >
            </div>
          </div>
          
          <!--submit button-->
          <div class="container">
              <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 5%;">
                    <input type="submit" name="login" class="btn btn-primary" value="Login"/>
                  </div>
              </div>
          </div>
      </form>
      </div> <!-- Container end -->
  </div> <!-- Login-form end -->

      <?php
      // Alert if registration fails
      if (isset($_SESSION['message'])){?>
          <div class="<?php echo $_SESSION['message-type']; ?>">
            <div class="message-content">
                <?php 
                  echo $_SESSION['message']; 
                  unset($_SESSION['message']);
                ?>
              </div>
          </div>
            <?php }else { // Display nothing
                     
                  }
            ?>
        <?php } ?> 
      ?>
</body>
</html> 