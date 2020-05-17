<?php require_once __DIR__ . '/header&footer/_header_restaurants.php'; ?>

<h2>Trenutne naruđbe</h2>
<p>To do ... (preko javascripta vjv)</p>

<h3>Popis svih jela: </h3>


<table>
    <tr>
        <th>Naziv jela</th>
        <th>Cijena</th>
        <th>Opis jela</th>
        <th>Vrijeme čekanja</th>
    </tr>
<?php
    foreach( $FoodList as $food)
    {

            echo "<tr>\n";
            echo "<td>". $food->name ."</td>\n";
            echo "<td>". $food->price ."</td>\n";
            echo "<td>". $food->description ."</td>\n";
            echo "<td>". $food->waiting_time ."</td>\n";
            echo "</tr>\n";
    }
?>

</table>
<h3>Trenutna ocjena restorana je <?php echo $restaurantRating;?></h3>
Možda to prebacit u neki div
<h3>Informacije o restoranu: </h3>
Ime restorana: <?php echo $restaurantInfo->name;?>
<br>
Description: <?php echo $restaurantInfo->description;?>
<br>
Adresa: <?php echo $restaurantInfo->address;?>
<br>
E-mail: <?php echo $restaurantInfo->email;?>
<hr>

Promjena cijene 



<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>