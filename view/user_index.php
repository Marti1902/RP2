<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<ul>
    <?php 
    /*foreach( $restaurantList as $restaurant ){
        echo '<li>';
        echo '<a href="index.php?rt=user/restaurant&id_restaurant=' . $restaurant->id . '">' . $restaurant->name . '</a>' .
        '  <small>Rating: '. $restaurant->rating.'</small><br>';
        echo $restaurant->description .'<br>';
        #echo '<button name="iChose" type="submit" value="' . $restaurant->id . '">Try this one</button>';   //  Treba dodat jošlinkove za neke akcije
        echo '</li>';
    }*/
    while ( max( array_column( $restaurantList, 1 )) != 0 ){
        $rat = max( array_column( $restaurantList, 1 ) );
        for( $i = 0; $i < count( $restaurantList ); $i++ ){
            if ( $restaurantList[$i][1] == $rat ){
                echo '<li>' . 
                    '<a href="index.php?rt=user/restaurant&id_restaurant=' . $restaurantList[$i][0]->id_restaurant . '">' . 
                    $restaurantList[$i][0]->name .  '</a>' . '  <small>Vaša ocjena: '. 
                    $restaurantList[$i][1] .'</small><br></li>';
                $restaurantList[$i][1] = 0;
                break;
            }
        }
    }
    ?>
</ul>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>