<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

Popis aktivnih narudžbi:
<ul>
    <?php 
    foreach( $orderList as $order ){
        if ( $order[0]->active == 1 ){
            echo '<li>' .
                'Iz ' . $order[0]->id_restaurant . ':<br>';
            foreach ( $order[1] as $food )
                echo $food->name .'<br>';
            echo '</li>';
        }
    }
    ?>
</ul>

Popis dostavljenih narudžbi:
<ul>
    <?php 
    foreach( $orderList as $order ){
        if ( $order[0]->active == 0 ){
            echo '<li>' .
                'Iz ' . $order[0]->id_restaurant . ':<br>';
            foreach ( $order[1] as $food )
                echo $food->name .'<br>';
            echo '</li>';
        }
    }
    ?>
</ul>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>