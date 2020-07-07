<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<div class="list_group">
    <?php 
    while ( max( array_column( $restaurantList, 1 )) != 0 ){
        $rat = max( array_column( $restaurantList, 1 ) );
        for( $i = 0; $i < count( $restaurantList ); $i++ ){
            if ( $restaurantList[$i][1] == $rat ){
                echo //'<li class="list-group-item">' . 
                    '<a href="index.php?rt=user/restaurant&id_restaurant=' . $restaurantList[$i][0]->id_restaurant . '" class="list-group-item list-group-item-action">' . 
                    $restaurantList[$i][0]->name . '  <br><small>Vaša ocjena: '. 
                    $restaurantList[$i][1] .'</small></a>';
                $restaurantList[$i][1] = 0;
                break;
            }
        }
    }
    ?>
</div>

<div style="height: 250px;"> </div>

</div>
</div>
</div>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>