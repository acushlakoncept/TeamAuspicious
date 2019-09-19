<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
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
    content="https://res.cloudinary.com/acushlakoncepts/image/upload/v1568902589/team_auspicious_lqphoy.png">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="http://teamauspicious.acushlakoncept.com/">
  <meta property="twitter:title"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers">
  <meta property="twitter:description"
    content="Web developers with successful track records of web team from HNG web track comprising of UI/UX Designers, FrontEnd and BackEnd Developers.">
  <meta property="twitter:image"
    content="https://res.cloudinary.com/acushlakoncepts/image/upload/v1568902589/team_auspicious_lqphoy.png">
        
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

            <div class="heading-welcome">
                <h1>Hi,  <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>  
                    <br />Welcome to Team Auspicious</h1>
                    <a href="reset-password.php" class="btn btn--blue">Reset Your Password</a>
                    <a href="logout.php" class="btn btn--blue">Sign Out of Your Account</a>
            </div>
            
            
            
        </section>
        
        <script src="" async defer></script>
    </body>
</html>