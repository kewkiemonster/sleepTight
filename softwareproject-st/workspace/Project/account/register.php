<?php 
    require '../includes/db.php';
    session_start();
    
    $active_page = "register";
    
    // Register
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['register'])){
            // Session variables
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['uname'] = $_POST['uname'];
            
            // Protect against SQL Injection
            $email = $mysqli->escape_string($_POST['email']);
            $uname = $mysqli->escape_string($_POST['uname']);
            $password = $mysqli->escape_string($_POST['password']);
            $confirmPass = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
            $uid = uniqid();
            
            // Check that passwords match
            if ($_POST['password'] == $_POST['confirmPass']){
                
                // Check if user already exists (email & username)
                $result = $mysqli->query("SELECT * FROM users WHERE email = '$email' OR uname = '$uname'");
                
                // User already exists
                if ($result->num_rows > 0) {
                    $_SESSION['message-type'] = "error-message";
                    $_SESSION['message'] = "Email is already registered";
                    
                    header('location: ../index.php');
                    
                }else { // Continue registration
                    $sql = "INSERT INTO users (email, uname, password, uid)
                    VALUES ('$email', '$uname', '$confirmPass', '$uid')";
                    
                    // Register user
                    if ($mysqli->query($sql)) {
                        $_SESSION['loggedin'] = true;
                        
                        //Unhashed password (for details.php)
                        $_SESSION['password'] = $password;
                        
                        // User ID
                        $_SESSION['uid'] = $uid;
                        
                        // Success message
                        $_SESSION['message-type'] = "success-message";
                        $_SESSION['message'] = "Account registered.";
                        
                        header('location: ../../Project/account/homepage.php');
                        exit;
                        
                    }else { // Could not register user
                        $_SESSION['message-type'] = "error-message";
                        $_SESSION['message'] = "Could not register user";  
                    }
                }  
            }else { // Passwords do not match
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "The passwords do not match";
            }
        }
    }
?>

<!DOCTYPE html>
<head>
    <title>REGISTER PAGE</title>
        
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
         <!--Bootstrap -->
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css"/>
         <!--Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
         <!--Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
         <!--Style -->
        <link rel="stylesheet" href="/Project/css/style.css"/>
        <!--Animation-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
        
</head>
<body>
    <?php 
        if ($_SESSION['loggedin'] === true) {
           header('location: ../../Project/account/homepage.php');
           exit;
      }else {?>
    
    
    <?php include '../includes/navbar.php'; ?>
    
    <!--Register Form-->
    <div class="container">
        <div class="row justify-content-md-center">
            
            <!--Login Icon-->
            <div class="col-md-12">
              <h1 class="icon text-center"><i class="fa fa-user-plus fa-3x"></i></h1>
              <h2 class="icon font-content text-center">Register</h2>
            </div>
          </div> <!-- Row end-->
          
      
        <div class="container">
          <form method="post" autocomplete="off">
          <div class="form-group">
              <div class="col-md-6">
                <label for="inputCreateEmail">Email address:</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" autocomplete="off" required >
              </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-6">
              <label for="uname">Name:</label>
              <input type="uname" class="form-control" name="uname" placeholder="Enter Name" autocomplete="off" required >
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-6">
              <label for="password">Password:</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off" required >
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-6">
              <label for="connfirmPass">Confirm Password:</label>
              <input type="password" class="form-control" name="confirmPass" placeholder="Confirm Password" autocomplete="off" required >
            </div>
          </div>
          
          <!--Register button -->
          <div class="container">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 5%;">
                   <input type="submit" name="register" class="btn btn-primary" value="Register"/>
                </div>
            </div>
        </div>
      </form>
    </div>
  </div> <!-- Container end -->
    
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
</body>
</html> 



