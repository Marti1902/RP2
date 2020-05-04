<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spiza</title>
</head>

<body>

<h1><?php echo $title; ?></h1>


<nav>   
        <a href="<?php echo __SITE_URL; ?>/index.php?rt=index/logout">Logout</a>
</nav> 
     <?php
    if( isset($errorFlag))
        if( $errorFlag )
            echo $errorMsg . '<br>';
    ?>
