<?php require_once __DIR__ . '/header&footer/_header_restaurants.php'; ?>

<h2>Trenutne naruđbe</h2>
<p>To do ... (preko javascripta vjv)</p>

<h3>Popis svih jela: </h3>


<table class="food">
    <tr>
        <th>Naziv jela</th>
        <th>Cijena</th>
        <th>Opis jela</th>
        <th>Vrijeme čekanja</th>
    </tr>
<?php
    foreach( $FoodList as $food)
    {

            echo "<tr id=".$food->id_food.">\n";
            echo "<td>". $food->name ."</td>\n";
            echo "<td>". $food->price ."</td>\n";
            echo "<td>". $food->description ."</td>\n";
            echo "<td>". $food->waiting_time ."</td>\n";
            echo "</tr>\n";
    }
?>
</table>

<button class="editFood" title="Edit food" target="<?php echo __SITE_URL;?>/index.php?rt=restaurants/editFood">Edit food</button>

<form class="editFood" target="<?php echo __SITE_URL;?>/app/editFood.php" hidden>
<h3>Select food to change:</h3>
<select class="editFood">
        <?php
                foreach( $FoodList as $food)
                {
                    echo "<option value='".$food->id_food."'>".$food->name."</option>\n";
                }
        ?>
</select>

<table class="editFood" >

<tr>
    <th> Food name: </th>
    <td><input type="text" name="foodName" disabled=true></td>
    <td><input type="checkbox" id="che1" name="foodName" value="change"></td>
</tr>
<tr>
    <th>Food price: </th>
    <td><input type="number" name="foodPrice" disabled=true></td>
    <td><input type="checkbox" id="che2" name="foodPrice" value="change"></td>
</tr>
<tr>
    <th>Food description: </th>
    <td><input type="text" name="foodDescription" disabled=true></td>
    <td><input type="checkbox"  id="che3" name="foodDescription" value="change"></td>
</tr>
<tr>
    <th>Food Waiting time: </th>
    <td><input type="number" name="foodWaitingTime" disabled=true></td>
    <td><input type="checkbox"  id="che4" name="foodWaitingTime" value="change"></td>
</tr>
</table>
<input type="submit" value="Change food">
</form>


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



<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>