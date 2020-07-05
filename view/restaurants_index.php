<?php require_once __DIR__ . '/header&footer/_header_restaurants.php'; ?>

<div class="col-12">
<h2>Trenutne narudžbe</h2>

<div class="activeOrders" id_restaurant="<?php echo $_SESSION['restaurants']->id_restaurant;?>"></div>

<h3>Menu: <small>-- prebacit ću na posebnu stranicu --</small></h3>


<table class="table table" name="food" >
    <thead>
    <tr>
        <th>Jelo </th>
        <th>Cijena </th>
        <th>Opis </th>
        <th>Čekanje (u minutama) </th>
        <th>Slika </th>
    </tr>
    </thead>
    <tbody>

<?php
    foreach( $FoodList as $food)
    {

            echo "<tr id=".$food->id_food.">\n";
            echo "<td>". $food->name ."</td>\n";
            echo "<td>". $food->price . ' kn ' . "</td>\n";
            echo "<td>". $food->description ."</td>\n";
            echo "<td>". $food->waiting_time . "'" . "</td>\n";
            echo "<td>";
                if( $food->image_path !== null )
                    echo '<img src="'. __SITE_URL . $food->image_path .'" width="100" height="100" name="' .$food->name. '">';
            echo "</td>\n";
            echo "</tr>\n";
    }
?>
    </tbody>
</table>

<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Uredi jelovnik
    </button>
    <div class="dropdown-menu">
        <button class="dropdown-item" name="editFood" title="Uredi jelo iz ponude" target="<?php echo __SITE_URL;?>/index.php?rt=restaurants/editFood">Uredi jelo</button>
        <button class="dropdown-item" name="addFood" title="Dodaj jelo">Dodaj jelo</button>
        <button class="dropdown-item" name="removeFood" title="Uredi ponudu">Ukloni jelo</button>
    </div>
</div>




<!--                EDIT       FOOD             -->
<form class="editFood" target="<?php echo __SITE_URL;?>/app/editFood.php" hidden>
    <h3>Odaberite hranu koju želite promijeniti:</h3>
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
            <th> Ime jela: </th>
            <td><input type="text" name="foodName" disabled=true></td>
            <td><input type="checkbox" id="che1" name="foodName" value="change"></td>
        </tr>
        <tr>
            <th>Cijena: </th>
            <td><input type="number" name="foodPrice" disabled=true></td>
            <td><input type="checkbox" id="che2" name="foodPrice" value="change"></td>
        </tr>
        <tr>
            <th>Opis jela: </th>
            <td><input type="text" name="foodDescription" disabled=true></td>
            <td><input type="checkbox"  id="che3" name="foodDescription" value="change"></td>
        </tr>
        <tr>
            <th>Trajanje pripreme: </th>
            <td><input type="number" name="foodWaitingTime" disabled=true></td>
            <td><input type="checkbox"  id="che4" name="foodWaitingTime" value="change"></td>
        </tr>
        <tr>
            <th>Slika hrane: </th>
            <td><input type="file" name="imgFood_edit" disabled=true></td>
            <td><input type="checkbox"  id="che5" name="imgFood_edit" value="change"></td>
        </tr>
    </table>
    <input type="submit" value="Change food">
</form>


<!--                REMOVE       FOOD               -->
<form class="removeFood" hidden>
    <h3>Odaberite hranu koju želite maknuti iz ponude:</h3>


    <table class="removeFood">
        <tr>
            <th></th>
            <th>Jelo: </th>
            <th>Cijena: </th>
            <th>Opis: </th>
            <th>Čekanje (u minutama): </th>
        </tr>
        <?php
            foreach( $FoodList as $food)
            {
                        echo "<tr>\n";
                        echo '<td><input type="checkbox"  class="removeFood" value="'.$food->id_food.'"></td>';
                        echo "\n<td>". $food->name ."</td>\n";
                        echo "<td>". $food->price ."</td>\n";
                        echo "<td>". $food->description ."</td>\n";
                        echo "<td>". $food->waiting_time ."</td>\n";
                        echo "</tr>\n";
            }
        ?>
    </table>
    <input type="submit"  value="Remove selected food" disabled>
</form>


<!--                ADD       FOOD               -->

<form class="addFood" method="post" enctype="multipart/form-data" restaurant="<?php echo $_SESSION['restaurants']->id_restaurant;?>" hidden>
    <h3>Dodaj novu hranu u ponudu:</h3>

    <table class="addFood">
        <tr>
            <th>Jelo: </th>
            <td><input type="text" name="name_input" required></td>
        </tr>
        <tr>
            <th>Cijena: </th>
            <td><input type="number" name="price_input" required></td>
        </tr>
        <tr>
            <th>Opis: </th>
            <td><input type="text" name="description_input" required></td>
        </tr>
        <tr>
            <th>Čekanje (u minutama): </th>
            <td><input type="number" name="waitingTime_input" required></td>
        </tr>
        <tr>
            <th>Slika: </th>
            <td><input type="file" name="imgFood_input" required></td>
        </tr>
    </table>
    <input type="submit"  value="Dodaj jelo u meni">
</form>



<h3>Ocjena Vašeg restorana <?php echo $restaurantRating;?></h3>
Možda to prebacit u neki div
<h3>Detalji o restoranu: </h3>
Ime: <?php echo $restaurantInfo->name;?>
<br>
Opis: <?php echo $restaurantInfo->description;?>
<br>
Adresa: <?php echo $restaurantInfo->address;?>
<br>
E-mail: <?php echo $restaurantInfo->email;?>
<br>

<!--                PROMIN DETALJE              -->
<button class="btn btn-primary" name="changeDetails" title="changeDetails">Promijeni detalje</button>
<form class="changeDetails" method="post" restaurant="<?php echo $_SESSION['restaurants']->id_restaurant;?>" hidden>
    <h3>Promijeni detalje svog restorana:</h3>

    <table class="changeDetails">
        <tr>
            <th>Ime: </th>
            <th>Opis: </th>
            <th>Adresa: </th>
        </tr>
            <td><input type="text" name="name_change"></td>
            <td><input type="text" name="desc_change"></td>
            <td><input type="text" name="address_change"></td>
    </table>
    <input type="submit"  value="Promijeni">
</form>


</div>
</div>
</div>

<hr>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>