<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
        $stmt->close();
        }
        
        
    }
    
    // Close connection
    $mysqli->close();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        

        <!-- Primary Meta Tags -->
  <title>Team Auspicious | HNG Web Track</title>
  <meta name="title"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers">
  <meta name="description"
    content="An NGO where the parents / a proxy can apply for funding (scholarship) for less privileged children. BlessFlame focus on scholarships for the less privileged to attend primary, secondary and university.">
  <meta name="keywords"
    content="Team Auspicious, HNG Task, Web Track, Backend, FrontEnd ">
  <meta name="robots" content="index, follow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="English">
  <meta name="revisit-after" content="1 days">
  <meta name="author" content="Team Moscow HNG Intenship">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://teamauspicious.acushlakoncept.com/">
  <meta property="og:title"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers">
  <meta property="og:description"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers">
  <meta property="og:image"
    content="https://res.cloudinary.com/acushlakoncepts/image/upload/v1568972180/team_auspicious_cfs0ld.jpg">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="http://teamauspicious.acushlakoncept.com/">
  <meta property="twitter:title"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers">
  <meta property="twitter:description"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers.">
  <meta property="twitter:image"
    content="https://res.cloudinary.com/acushlakoncepts/image/upload/v1568972180/team_auspicious_cfs0ld.jpg">



        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <section class="container">
            <div class="heading-primary">
                <h1>Team <br />Auspicious</h1>
            </div>
            <div class="login__container">
                <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <div class="form__group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">  
                <div class="input-container"> 
                    <i class="fa fa-user icon"></i>             
                    <input type="text" name="username" class="form__input" value="<?php echo $username; ?>" placeholder="username">
                    <label class="form__label">Username</label>
                </div>
                
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  

            <div class="form__group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"> 
                <div class="input-container"> 
                    <i class="fa fa-key icon"></i>               
                    <input type="password" name="password" class="form__input" placeholder="password">
                    <label class="form__label">Password</label>
                </div>
                
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form__group">
                <input type="submit" class="btn btn--blue" value="Login">
            </div>
            <p>Don't have an account? <a class="links" href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
            </div>
        </section>
        
        <script src="" async defer></script>
    </body>
</html>