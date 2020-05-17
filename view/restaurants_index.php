<?php require_once __DIR__ . '/header&footer/_header_restaurants.php'; ?>

<h2>Trenutne naruđbe</h2>
<p>To do ...</p>

<h3>Popis svih jela: </h3>

FoodList

<h3>Informacije o restoranu: </h3>
Ime restorana: <?php echo $restaurantInfo->name;?>
<br>
Description: <?php echo $restaurantInfo->description;?>
<br>
Username: <?php echo $restaurantInfo->Username;?>
<br>
Adresa: <?php echo $restaurantInfo->address;?>
<br>
E-mail: <?php echo $restaurantInfo->email;?>



<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>