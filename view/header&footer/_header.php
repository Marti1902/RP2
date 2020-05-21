<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spiza</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <link rel="icon" href="<?php echo __SITE_URL; ?>/css/logo.png" />
</head>

<body>

<h1>Spiza.hr</h1>

<nav>   
    <ul>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=index/logout">Logout</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/orders">Moje Narudžbe</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user">Vaši omiljeni restorani</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/restaurants">Svi restorani</a></li>
    </ul>
</nav> 
     <?php
    if( isset($errorFlag))
        if( $errorFlag )
            echo $errorMsg . '<br>';
    ?>

<h2><?php echo $title; ?></h2>
