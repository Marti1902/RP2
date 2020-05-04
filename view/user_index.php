<?php require_once __DIR__ . '/_header.php'; ?>

Popis po ocijenama:
<ul>
    <?php 
    foreach( $restaurantList as $restaurant ){
        echo '<li>';
        echo $restaurant->name .'  <small>Rating: '. $restaurant->rating.'</small><br>';
        echo $restaurant->description .'<br>';
        echo '<button name="iChose" type="submit" value="' . $restaurant->id . '">Try this one</button>';   //  Treba dodat jošlinkove za neke akcije
        echo '</li>';
    }
    ?>
</ul>



<?php require_once __DIR__ . '/_footer.php'; ?>