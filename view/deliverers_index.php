<?php require_once __DIR__ . '/header&footer/_header_deliverers.php'; ?>

<ul>
    <?php 
    //echo sizeof($availableOrders);
    echo '<h4>Slobodne narudžbe</h4>';
    foreach( $availableOrders as $order ){
        echo '<li>';
        echo '<a href="index.php?rt=deliverers/order&id_order=' . $order[0]->id_order . '">' . 
            'Broj narudžbe: ' . $order[0]->id_order . '</a><br>';
        echo 'Korisnik: ' . $order[1] . '<br>';
        echo 'Popust: ' . $order[0]->discount .'<br>';
        echo 'Napomena: ' . $order[0]->note .'<br>';

        echo 'Restoran: ' . $order[2] .'<br>';
        echo 'Sadržaj narudžbe: ';
        
        foreach($order[3] as $hrana)
            echo '<ul>' . $hrana . '</ul>';
        
        //echo '<button name="narudzba" type="submit" value="' . $order[0]->id_order . '">Prihvaćam narudžbu</button>';   //  Treba dodat jošlinkove za neke akcije
        echo '</li>';
    }
    ?>
</ul>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>