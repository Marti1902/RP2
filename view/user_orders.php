<?php require_once __DIR__ . '/_header.php'; ?>

Popis narudžbi:
<ul>
    <?php 
    foreach( $orderList as $order ){
        echo '<li>' .
             'Iz ' . $order->id_restaurant . ':<br>' .
             $order->id_food .'<br>' .
            '</li>';
    }
    ?>
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>