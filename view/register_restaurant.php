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

<h2>Treba testirat!</h2>

<p>After registration you will receive an e-mail confirmation and link to activate your account and complite your sign in form!</p>

<form action="<?php echo __SITE_URL; ?>/index.php?rt=index/register" method='post'>
    Chose username:
    <input type="text" name="username"><br>
    Chose password:
    <input type="password" name="password"><br>
    Input e-mail:
    <input type="email" name="email"><br>
    Enter your restaurant name:
    <input type="text" name="name"><br>
    Enter your restaurant address:
    <input type="text" name="address"><br>
    Enter your restaurant description:
    <input type="text" name="description">
    <br><br>
    <input type="submit" name="Register restaurant" value="Register restaurant">
</form>


</body>
</html>