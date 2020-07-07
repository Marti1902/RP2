<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<div class="list-group">
    <?php 
    while ( max( array_column( $restaurantList, 1 )) != 0 ){
        $rat = max( array_column( $restaurantList, 1 ) );
        for( $i = 0; $i < count( $restaurantList ); $i++ ){
            if ( $restaurantList[$i][1] == $rat ){
                echo '<a class="list-group-item list-group-item-action" href="index.php?rt=user/restaurant&id_restaurant=' . $restaurantList[$i][0]->id_restaurant . '">' . 
                    $restaurantList[$i][0]->name . '<br><small>Ocjena korisnika: '. 
                    $restaurantList[$i][1] .'</small></a>';
                $restaurantList[$i][1] = 0;
                break;
            }
        }
    }
    ?>
</div>

<div style="height: 50px;"> </div>
<!-- Istraži više restorana: -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">   
    <ul class="nav navbar-nav">
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/popular">Popularni</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/restaurants">Svi restorani</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/neighborhood">U kvartu</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/foodType">Prema vrsti hrane</a></li>
    </ul>
</nav> 

<!-- <div style="height: 250px;"> </div> -->

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>