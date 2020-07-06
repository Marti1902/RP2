<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <title>Spiza</title>
    <link rel="icon" href="<?php echo __SITE_URL; ?>/css/logo.png" />

        <!--        BOOTSTRAP           -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>

<div class="jumbotron text-center" style="margin-bottom: 0px;">
    <h1>Spiza.hr</h1>
    <h2><?php echo $title; ?></h2>
</div>


     <?php
    if( isset($errorFlag))
        if( $errorFlag )
            echo $errorMsg . '<br>';
    ?>
     

<form action="<?php echo __SITE_URL;?>/index.php?rt=index/login" method='post'>
Username:
<input type="text" name="username">
<br>
Password:
<input type="password" name="password"> <br><br>
<button type="submit" name="log_in" value="login_user">Log in</button>
</form>
<p>ili</p> 
<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/registerForward" method='post'>
    <input type="submit" value="Register" />
</form>

<hr>
<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/loginRestaurants" method='post'>
    <input type="submit" value="Login for restaurants" />
</form>
<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/registerForward_restaurants" method='post'>
    <input type="submit" value="Register new restaurant" />
</form>
<hr>
<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/loginDeliverers" method='post'>
    <input type="submit" value="Login for deliverers" />
</form>




</body>
<footer>
<div class="jumbotron text-center" style="margin-bottom:0">

&copy; <?php echo date("Y");?>

</div>
</footer>
</html>