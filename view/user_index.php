<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<ul>
    <?php 
    foreach( $restaurantList as $restaurant ){
        echo '<li>';
        echo '<a href="index.php?rt=user/restaurant&id_restaurant=' . $restaurant->id . '">' . $restaurant->name . '</a>' .
        '  <small>Rating: '. $restaurant->rating.'</small><br>';
        echo $restaurant->description .'<br>';
        #echo '<button name="iChose" type="submit" value="' . $restaurant->id . '">Try this one</button>';   //  Treba dodat jošlinkove za neke akcije
        echo '</li>';
    }
    ?>
</ul>



<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>