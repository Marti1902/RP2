<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <title>Spiza</title>
   
</head>
<body>
    <h1><?php echo $title; ?></h1>

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
<button type="submit" name="log_in" value="login_deliverers">Log in</button>
</form>





</body>
</html>