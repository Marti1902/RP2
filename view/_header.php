<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spiza</title>
</head>

<body>

<h1><?php echo $title; ?></h1>

<nav>   
    <ul>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=index/logout">Logout</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/orders">Moje Narudžbe</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user">Svi restorani</a></li>
    </ul>
</nav> 
     <?php
    if( isset($errorFlag))
        if( $errorFlag )
            echo $errorMsg . '<br>';
    ?>
