<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<div class="list-group">
    <?php 
        if( $foodType != [] ){
            foreach( $foodType as $food ){ //u css-u maknuti točkice kod liste
                echo '<a class="list-group-item list-group-item-action" href="index.php?rt=user/restaurantsByFoodType&id_foodType=' . $food->id_foodType . '">';
                echo ucfirst( $food->name );
                if( $food->image_path !== null )
                    echo '<img src="'. __SITE_URL . $food->image_path .'"width="100", height="100">';
                echo '</a>';
            }
        }
        else echo '<div class="list-group-item">Trenutno nema raspoloživih vrsta hrane</div>';
    ?>
</div>

<div style="height: 250px;"> </div>

</div>
</div>
</div>

<!-- <div style="height: 250px;"> </div> -->

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>