<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

Popis aktivnih narudžbi:
<ul>
    <?php 
    foreach( $orderList as $order ){
        if ( $order[0]->active != 0 ){
            echo '<li>' .
                'Iz ' . $order[0]->id_restaurant . ':<br>';
            foreach ( $order[1] as $food )
                echo $food[0]->name . ', količina: ' . $food[1] . '<br>';
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
                echo $food[0]->name . ', količina: ' . $food[1] . '<br>';
            if( $order[0]->rating != 1 && $order[0]->rating != 2 && $order[0]->rating != 3 && $order[0]->rating != 4 && $order[0]->rating != 5 && $order[0]->rating != 6 && $order[0]->rating != 7 && $order[0]->rating != 8 && $order[0]->rating != 9 && $order[0]->rating != 10)
                echo "<button class='ocijeni' id='" . $order[0]->id_order . "'>Ocijeni</button>";
            echo '</li>';
        }
    }
    ?>
</ul>

<form class="oc" hidden>
    Daj svoju recenziju: <input type="text" name="recenzija">
    Ocijeni: <input type='number' name='ocjena' required>
    <input type="submit"  value="Ocijeni"></input>`
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="<?php echo __SITE_URL; ?>/view/javascript/orders.js"></script>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>