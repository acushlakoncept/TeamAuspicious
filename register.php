<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
        $stmt->close();
        }
         
        
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
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
  <title>Register | Team Auspicious | HNG Web Track</title>
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
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
                    <input type="password" name="password" class="form__input" value="<?php echo $password; ?>" placeholder="password">
                    <label class="form__label">Password</label>
                </div>
                
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form__group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"> 
                <div class="input-container"> 
                    <i class="fa fa-key icon"></i>               
                    <input type="password" name="confirm_password" class="form__input" value="<?php echo $confirm_password; ?>" placeholder="confirm password">
                    <label class="form__label">Confirm Password</label>
                </div>
                
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            
            <div class="form__group">
                <input type="submit" class="btn btn--blue" value="Submit">                
                <input type="reset" class="btn btn--white" value="Reset">

            </div>
            <p>Already have an account? <a class="links" href="index.php">Login here</a>.</p>
        </form>
    </div>    
            </div>
        </section>
        
        <script src="" async defer></script>
    </body>
</html>


