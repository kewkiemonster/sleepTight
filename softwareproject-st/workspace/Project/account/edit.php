<?php 
    require '../includes/db.php';
    session_start();
    
    $active_page = "edit";
    
    $email = $mysqli->escape_string($_POST['email']);
    $uname = $mysqli->escape_string($_POST['uname']);
    $password = $mysqli->escape_string($_POST['password']);
    $confirmPass = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $detail = $mysqli->escape_string($_POST['detail']);
    
    $query = $mysqli->query("SELECT * FROM users WHERE uid= '".$_SESSION['uid']."'");
    $user = $query->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['update'])){
            
            //check if username already exists in the db 
            $query = $mysqli->query("SELECT * FROM users WHERE (uname = '$uname' OR email = '$email') AND uid <>'".$_SESSION['uid']. "'");
            
            if ($query->num_rows > 0){
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "Username or Email already taken";
                
                // Else -> let user change details
            } else {
                $mysqli->begin_transaction();
                  $mysqli->query("UPDATE users SET uname = '$uname', detail = '$detail', email = '$email', password = '$confirmPass' WHERE uid = '" . $_SESSION['uid'] . "'");
                  $mysqli->query("UPDATE code SET author = '$uname' WHERE codeid = '".$_SESSION['uid']."'");
                $mysqli->commit();
                
                $_SESSION['uname'] = $uname;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                
                $_SESSION['message-type'] = "success-message";
                $_SESSION['message'] = "Details updated";
                
                // Redirect to user edit profile 
                header("location: ../../Project/account/edit.php?id=".$_GET['id']."");
                exit;
            }
        }
    }
    
    if ($_SESSION['REQUEST_METHOD'] == "POST"){
        if (!isset($_POST['update'])){
            move_uploaded_file($_FILES['profile-pic'] ['tmp_name'], "../../images/".$_FILES['profile-pic'] ['name']);
            $query = $mysqli->query("UPDATE users SET image = '".$_FILES['profile-pic'] ['name']."' WHERE uid = '".$_SESSION['uid']."'");
            
            $_SESSION['message-type'] = "success-message";
            $_SESSION['message'] = "Image updated";
            header("location: ../../Project/account/edit.php?id=".$_GET['id']."");
            exit;
        }
    }
    
?>

<!DOCTYPE html>
<head>
    <title>EDIT USER PROFILE</title>
    
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
    <?php 
        if ($_SESSION['loggedin'] === true){
    ?>
    
    <!-- NAVIGATION -->
     <?php include '../includes/usernav.php'; ?>
     
    <div class="container">
        <div class="card border-info mb-3">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="/Project/account/profile.php">User</a>
                        </li>
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="/Project/account/profile.php"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
                        </li>
                    </ul> <!-- nav end -->
                </div> <!-- card header end -->
                
                <div class="container">
                    <div class="col-12">
                        <h4>Avatar</h4>
                         <div class="container" style="width: 250px; height: 250px;"> 
                            <?php
                                if ($user['image'] == ""){
                                    echo "<img width='100%' height='100%' src='/Project/images/default.png' alt='Default profile image'/> ";
                                } else{
                                    echo "<img width='100%' height='100%' src='/Project/images/".$user['image']."' alt='Profile picture'/>";
                                }
                            ?>
                        </div> 
                    </div>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form class="edit-avatar text-center" method="post" enctype="multipart/form-data">
                                <label for="file">Change your avatar</label>
                                <input id="file" type="file" name="profile-pic" onchange="this.form.submit();" style="opacity: 0; position: absolute;"/>
                            </form>
                        </div>
                    </div>
                </div>
                
               <form method="post" autocomplete="off">
                    <div class="card-body">
                        <h3 class="card-title text-info text-center">Edit Profile</h3>
                        
                        <div class="container">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="uname" autocomplete="off" value="<?php echo $_SESSION['uname']; ?>" required />
                                </div>
                            </div>
                        </div>
                        
                        <!--Details-->
                        <div class="container">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="details">Details:</label>
                                    <textarea type="text" class="form-control" name="detail" autocomplete="off" style="resize: none;"><?php echo $user['detail']; ?></textarea>
                                </div>
                            </div>
                        </div>   
                        
                        <!--Email-->
                        <div class="container">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>" autocomplete="off" required />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password -->
                        <div class="container">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" value="<?php echo $_SESSION['password']; ?>" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
                                </div>
                            </div>
                        </div>
                   </div> <!-- card body end -->
               </form> 
            </div>
        </div>
    </div> <!-- container end -->
         <?php
                // Alert if login fails
                if (isset($_SESSION['message'])){?>
                    <div class="error-message">
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
    <?php } else {
        header('location: ../../Project/account/homepage.php');
        exit;
    } ?> <!-- LOGIN SESSION END -->
</body>
</html>