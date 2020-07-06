<?php require_once __DIR__ . '/header&footer/_header_deliverers.php'; ?>

<ul>
    <?php 
    echo '<h4>Dostava u tijeku</h4>';        
    
    echo 'Broj narudžbe: ' . $currentOrder[0]->id_order . '<br>';
    echo 'Korisnik: ' . $currentOrder[1] . '<br>';
    echo 'Adresa: ' . $order[0]->address . '<br>';
    echo 'Popust: ' . $currentOrder[0]->discount .'<br>';
    echo 'Napomena: ' . $currentOrder[0]->note .'<br>';

    echo 'Restoran: ' . $currentOrder[2] .'<br>';
    echo 'Sadržaj narudžbe: ';
    foreach($currentOrder[3] as $hrana)
        echo '<ul>' . $hrana[0] . ' (količina: ' . $hrana[1] .  ')</ul>';

    ?>
    <form action="<?php echo __SITE_URL;?>/index.php?rt=deliverers/delivered" method="post">
    <input type="checkbox" name="dostavljeno" id="dostavljeno"  value="dostavljeno" /> Dostavljeno<br> 
    <button type="submit" name="btn_dostavljeno" value=" <?php echo $currentOrder[0]->id_order;  ?>">Dostavljeno</button><br>
    </form>
 
</ul>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>