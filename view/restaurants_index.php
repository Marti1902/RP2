<?php require_once __DIR__ . '/header&footer/_header_restaurants.php'; ?>

<h2>Pending orders</h2>

<div class="activeOrders" id_restaurant="<?php echo $_SESSION['restaurants']->id_restaurant;?>"></div>

<h3>Menu: <small>-- prebacit ću na posebnu stranicu --</small></h3>


<table class="food">
    <tr>
    <th>Food name </th>
    <th>Price </th>
    <th>Description </th>
    <th>Waiting time (in minutes) </th>
    <th>Food image </th>

    </tr>

<?php
    foreach( $FoodList as $food)
    {

            echo "<tr id=".$food->id_food.">\n";
            echo "<td>". $food->name ."</td>\n";
            echo "<td>". $food->price ."</td>\n";
            echo "<td>". $food->description ."</td>\n";
            echo "<td>". $food->waiting_time ."</td>\n";
            echo "<td>";
                if( $food->image_path !== null )
                    echo '<img src="'. __SITE_URL . $food->image_path .'"width="100" height="100">';
            echo "</td>\n";
            echo "</tr>\n";
    }
?>
</table>

<!--                EDIT       FOOD             -->
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
        <tr>
            <th>Food image: </th>
            <td><input type="file" name="imgFood_edit" disabled=true></td>
            <td><input type="checkbox"  id="che5" name="imgFood_edit" value="change"></td>
        </tr>
    </table>
    <input type="submit" value="Change food">
</form>


<!--                REMOVE       FOOD               -->
<button class="removeFood" title="Remove food">Remove food</button>

<form class="removeFood" hidden>
    <h3>Select food to remove from offering:</h3>


    <table class="removeFood">
        <tr>
            <th>Food name: </th>
            <th>Price: </th>
            <th>Description: </th>
            <th>Waiting time (in minutes): </th>
            <th>Food image: </th>
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
<button class="addFood" title="Add food">Add food</button>



<form class="addFood" method="post" enctype="multipart/form-data" restaurant="<?php echo $_SESSION['restaurants']->id_restaurant;?>" hidden>
    <h3>Add new food to offering:</h3>

    <table class="addFood">
        <tr>
            <th>Food name: </th>
            <th>Price: </th>
            <th>Description: </th>
            <th>Waiting time (in minutes): </th>
            <th>Food image: </th>
        </tr>
            <td><input type="text" name="name_input" required></td>
            <td><input type="number" name="price_input" required></td>
            <td><input type="text" name="description_input" required></td>
            <td><input type="number" name="waitingTime_input" required></td>
            <td><input type="file" name="imgFood_input" required></td>
    </table>
    <input type="submit"  value="Add new food to offerings">
</form>



<h3>Your restaurant raiting <?php echo $restaurantRating;?></h3>
Možda to prebacit u neki div
<h3>Restaurant details: </h3>
Name: <?php echo $restaurantInfo->name;?>
<br>
Description: <?php echo $restaurantInfo->description;?>
<br>
Address: <?php echo $restaurantInfo->address;?>
<br>
E-mail: <?php echo $restaurantInfo->email;?>
<hr>



<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>