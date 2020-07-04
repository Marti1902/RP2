<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<ul>
    <?php 
    //echo sizeof($restaurantList);
    foreach( $restaurantList as $restaurant ){
        echo '<li>';
        echo '<a href="index.php?rt=user/restaurant&id_restaurant=' . $restaurant->id_restaurant . '">' . 
            $restaurant->name . '</a><br>';
        echo $restaurant->description .'<br>';
        #echo '<button name="iChose" type="submit" value="' . $restaurant->id . '">Try this one</button>';   //  Treba dodat jošlinkove za neke akcije
        echo '</li>';
    }
    ?>
</ul>
Istraži više restorana:
<nav>   
    <ul>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/popular">Popularni</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/restaurants">Svi restorani</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/neighborhood">U kvartu</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/foodType">Prema vrsti hrane</a></li>
    </ul>
</nav> 

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>