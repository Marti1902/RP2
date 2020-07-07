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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-bottom: 50px;">
  <a class="navbar-brand" href="#">
      <img src="<?php echo __SITE_URL; ?>/css/logo.png" alt="Spiza.hr" style="width:40px;">
  </a>

  <!-- Linkovi -->
  <ul class="navbar-nav">
    <li class="nav-item">
    </li>
    <li class="nav-item">
    </li>

    <!-- Dropdown meni -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Restorani/dostavljači
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo __SITE_URL; ?>/index.php?rt=index/loginRestaurants">Login restaurants</a>
        <a class="dropdown-item" href="<?php echo __SITE_URL; ?>/index.php?rt=index/registerForward_restaurants">Register new restaurant</a>
        <a class="dropdown-item" href="<?php echo __SITE_URL; ?>//index.php?rt=index/loginDeliverers">Login dostavljač</a>
      </div>
    </li>
  </ul>
</nav> 

<!--        NOTIFICATION    4   ERROR       -->
<div style="position: relative;" >
  <div class="toast" data-autohide="false"  style="  background-color: #DCDCDC; position: absolute; top: 10; right: 10px;">
      <div class="toast-header">
        Greška!
      </div>
      <div class="toast-body">
      <?php
      if( isset($errorFlag))
          if( $errorFlag )
              echo $errorMsg . '<br>';
      ?>
      </div>
  </div>
</div>

     
<div class="container">
  <div class="row">
    <div class="col-12">

<form action="<?php echo __SITE_URL;?>/index.php?rt=index/login" method='post'>
<div class="form-group">
    <label for="text">Username:</label>
    <input type="text" class="form-control" name="username"  placeholder="Unesi username">
</div>
<div class="form-group">
    <label for="password">Password:</label>
    <input type="password" name="password" class="form-control" placeholder="Unesi password" id="password"> <br><br>
</div>
<button type="submit" class="btn btn-primary btn-block" name="log_in" value="login_user">Log in</button>
</form>

<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/registerForward" method='post'>
    <input type="submit" class="btn btn-primary btn-block" value="Register" />
</form>

<div style="height: 250px;"> </div>

<?php /*            SAMO    BACKUP
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
*/ ?>

</div>
</div>
</div>

<script>
  $( document ).ready( function()
{
  var toast =   $( 'div.toast-body');
  if( toast.html() !== '')
    $( 'div.toast' ).toast('show');
});
</script>

</body>
<footer>
<div class="jumbotron text-center" style="margin-bottom:0">

&copy; <?php echo date("Y");?>

</div>
</footer>
</html>