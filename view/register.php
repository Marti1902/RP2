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

<h2>Trenutno samo za korisnike omogućeno, ne i za restorane!</h2>

<p>After registration you will receive an e-mail confirmation and link to activate your account!</p>

<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/register" method='post'>
    Chose username:
    <input type="text" name="username"><br>
    Chose password:
    <input type="password" name="password"><br>
    Input e-mail:
    <input type="email" name="email">
    <br><br>
    <input type="submit" value="Register">
</form>


</body>
</html>