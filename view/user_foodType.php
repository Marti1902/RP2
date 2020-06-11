<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<ul>
    <?php 
        foreach( $foodType as $food ){ //u css-u maknuti točkice kod liste
            echo '<div>';
            if( $food->image_path !== null )
                echo '<a href="index.php?rt=user/restaurantsByFoodType&id_foodType=' . $food->id_foodType . '"><img src="'. __SITE_URL . $food->image_path .'"width="100", height="100"></a><br>';
            echo $food->name . '<br>';
            echo '</div>';
        }
    ?>
</ul>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>