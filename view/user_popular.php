<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<ul>
    <?php 
    while ( max( array_column( $restaurantList, 1 )) != 0 ){
        $rat = max( array_column( $restaurantList, 1 ) );
        for( $i = 0; $i < count( $restaurantList ); $i++ ){
            if ( $restaurantList[$i][1] == $rat ){
                echo '<li>' . 
                    '<a href="index.php?rt=user/restaurant&id_restaurant=' . $restaurantList[$i][0]->id_restaurant . '">' . 
                    $restaurantList[$i][0]->name .  '</a>' . '  <small>Ocjena korisnika: '. 
                    $restaurantList[$i][1] .'</small><br></li>';
                $restaurantList[$i][1] = 0;
                break;
            }
        }
    }
    ?>
</ul>
Istraži više restorana:
<nav>   
    <ul>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/popular">Popularni</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/restaurants">Svi restorani</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/nearest">Najbliži</a></li>
        <li><a href="<?php echo __SITE_URL; ?>/index.php?rt=user/foodType">Prema vrsti hrane</a></li>
    </ul>
</nav> 

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>