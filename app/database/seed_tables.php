<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_restaurants();
seed_table_food();
seed_table_feedback();
seed_table_orders();
seed_table_deliverers();

exit( 0 );

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_users(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\')' );

		$st->execute( array( 'username' => 'mirko', 'password' => password_hash( 'mirkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_users]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_users.<br />";
}


// ------------------------------------------
function seed_table_restaurants()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_restaurants(username, password_hash, name, address, email, registration_sequence, rating, food_type, description, has_registered) VALUES (:username, :password, :name, :address, \'a@b.com\', \'abc\', :rating, :food_type, \'blabla\', \'1\')' );

		$st->execute( array( 'username' => 'pizzeria6', 'password' => password_hash( 'pizzeria6sifra', PASSWORD_DEFAULT ), 'name' => 'Pizzeria 6',  'address' => 'Medulićeva 6' , 'rating' => 9,'food_type' => 'pizza' ) );
		$st->execute( array( 'username' => 'bros', 'password' => password_hash( 'brossifra', PASSWORD_DEFAULT ), 'name' => 'Pizzeria Bros',  'address' => 'Trakošćanska 28', 'rating' => 8, 'food_type' => 'pizza' ) );
		$st->execute( array( 'username' => 'rocket', 'password' => password_hash( 'rocketsifra', PASSWORD_DEFAULT ), 'name' => 'Rocket Burger',  'address' => 'Tkalčićeva 50', 'rating' => 9, 'food_type' => 'burger' ) );
		$st->execute( array( 'username' => 'submarine', 'password' => password_hash( 'submarinesifra', PASSWORD_DEFAULT ), 'name' => 'Submarine',  'address' => 'Frankopanska 9', 'rating' => 8, 'food_type' => 'burger' ) );
		$st->execute( array( 'username' => 'batak', 'password' => password_hash( 'bataksifra', PASSWORD_DEFAULT ), 'name' => 'Batak Grill',  'address' => 'Radnička cesta 37b', 'rating' => 9 , 'food_type' => 'grill' ) );
		$st->execute( array( 'username' => 'kokopeli', 'password' => password_hash( 'kokopelisifra', PASSWORD_DEFAULT ), 'name' => 'Kokopeli',  'address' => 'Ukrinska 5', 'rating' => 9 , 'food_type' => 'kineska grill' ) );
		$st->execute( array( 'username' => 'ribs', 'password' => password_hash( 'ribssifra', PASSWORD_DEFAULT ), 'name' => 'R&B Food House Of Ribs',  'address' => 'Puljska 9', 'rating' => 9 , 'food_type' => 'grill' ) );
		$st->execute( array( 'username' => 'koykan', 'password' => password_hash( 'pekingsifra', PASSWORD_DEFAULT ), 'name' => 'Kineski restoran Peking',  'address' => 'Ilica 114', 'rating' => 9 , 'food_type' => 'kineska' ) );
		$st->execute( array( 'username' => 'peking', 'password' => password_hash( 'koykansifra', PASSWORD_DEFAULT ), 'name' => 'Koykan World Food - Tkalčićeva',  'address' => 'Ul. Ivana Tkalčića 13', 'rating' => 9 , 'food_type' => 'burger meksicka' ) );
		$st->execute( array( 'username' => 'zagabria', 'password' => password_hash( 'zagabriasifra', PASSWORD_DEFAULT ), 'name' => 'Pizzeria Zagabria',  'address' => 'Ilica 202', 'rating' => 9 , 'food_type' => 'grill burger' ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_restaurants]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_restaurants.<br />";
}


// ------------------------------------------
function seed_table_food()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_food(name, food_type, description, waiting_time, id_restaurant, price) VALUES (:name, :food_type, :description, :waiting_time, :id_restaurant, :price)' );

		$st->execute( array( 'name' => 'Pizza Modena', 'food_type' => 'pizza', 'description' => '(pelat, mozzarela, pršut, rikola,maslina)', 'waiting_time' => 25, 'id_restaurant' => 1, 'price' => 62) );
		$st->execute( array( 'name' => 'Pizza 6', 'food_type' => 'pizza', 'description' => '(pelat, sir, šunka, špek, šampinjoni, jaje, blagi i ljuti feferoni, maslina)', 'waiting_time' => 25, 'id_restaurant' => 1, 'price' => 58) );
		$st->execute( array( 'name' => 'Pizza Napoletana', 'food_type' => 'pizza', 'description' => '(pelat, mozzarela, inćuni, masline, cherry rajčice, bosiljak)', 'waiting_time' => 25, 'id_restaurant' => 1, 'price' => 58) );
		$st->execute( array( 'name' => 'Pizza Piccante', 'food_type' => 'pizza', 'description' => '(pelat, sir, šunka, špek, feferoni, maslina)', 'waiting_time' => 30, 'id_restaurant' => 1, 'price' => 54) );
		$st->execute( array( 'name' => 'Pizza Capriccosia', 'food_type' => 'pizza', 'description' => '(pelat, šunka, sir, šampinjoni, maslina)', 'waiting_time' => 20, 'id_restaurant' => 1, 'price' => 52) );		

		$st->execute( array( 'name' => 'Pizza Capricciosa', 'food_type' => 'pizza', 'description' => '(rajčica, Fior di Latte, Cotto šunka, šampinjoni, artičoke, masline, maslinovo ulje)', 'waiting_time' => 30, 'id_restaurant' => 2, 'price' => 68) );
		$st->execute( array( 'name' => 'Pizza Oro Nero', 'food_type' => 'pizza', 'description' => '(rajčica, Fior di Latte, Cotto šunka, tartufat, svježi bosiljak)', 'waiting_time' => 20, 'id_restaurant' => 2, 'price' => 72) );
		$st->execute( array( 'name' => 'Pizza Piccnte', 'food_type' => 'pizza', 'description' => '(rajčica, Fior di Latte, pikantna salama, svježa paprika)', 'waiting_time' => 35, 'id_restaurant' => 2, 'price' => 72) );
		$st->execute( array( 'name' => 'Pizza Ragina', 'food_type' => 'pizza', 'description' => '(rajčica, Fior di Latte, Cotto šunka, šampinjoni)', 'waiting_time' => 20, 'id_restaurant' => 2, 'price' => 55) );

		$st->execute( array( 'name' => 'Cheddar Bacon Supreme', 'food_type' => 'burger', 'description' => '(Brioche pecivo, juneća pljeskavica, salata, luk ceddar sir, slanina)', 'waiting_time' => 20, 'id_restaurant' => 3, 'price' => 60) );
		$st->execute( array( 'name' => 'Rocket Burger', 'food_type' => 'burger', 'description' => '(Brioche pecivo, juneća pljeskavica, majoneza s medom i chipotle papričicom, gauda sir, slanina, lik)', 'waiting_time' => 25, 'id_restaurant' => 3, 'price' => 55) );
		$st->execute( array( 'name' => 'Cheeseburger', 'food_type' => 'burger', 'description' => '(Brioche pecivo, juneća pljeskavica, salata, majoneza s medom i chipotle papričicom, gauda sir, svježa rajčica, luk)', 'waiting_time' => 25, 'id_restaurant' => 3, 'price' => 45) );
		//$st->execute( array( 'name' => 'Messy Fries', 'food_type' => 'burger', 'description' => '(ribani cheddar, dimljena majoneza, hrskava slanina)', 'waiting_time' => 10, 'id_restaurant' => 3, 'price' => 30) );

		$st->execute( array( 'name' => 'French', 'food_type' => 'burger', 'description' => '(govedina, brie sir, umak od bijelog tartufa)', 'waiting_time' => 25, 'id_restaurant' => 4, 'price' => 56) );
		$st->execute( array( 'name' => 'Smokehouse', 'food_type' => 'burger', 'description' => '(govedina, salata, pršut, sir, BBQ umak)', 'waiting_time' => 30, 'id_restaurant' => 4, 'price' => 48) );
		$st->execute( array( 'name' => 'Monster', 'food_type' => 'burger', 'description' => '(govedina, Submarine umak, topljeni sir, pršut, BBQ umak)', 'waiting_time' => 20, 'id_restaurant' => 4, 'price' => 68) );
		$st->execute( array( 'name' => 'Tipsy Plum', 'food_type' => 'burger', 'description' => '(govedina, crveni kupus, hrskava panceta, domaći senf i umak od meda)', 'waiting_time' => 30, 'id_restaurant' => 4, 'price' => 56) );
		$st->execute( array( 'name' => 'Avokado Veggie', 'food_type' => 'burger', 'description' => '(avokado, Submarine umak, dimljeni tofu sa curryjem, svježa rukola)', 'waiting_time' => 15, 'id_restaurant' => 4, 'price' => 50) );

		$st->execute( array( 'name' => 'Plata Batak', 'food_type' => 'grill', 'description' => '(ćevapi sa sirom, punjena vješalica, pljeskavica, kriške mladog krupmira, šampinjoni)', 'waiting_time' => 50, 'id_restaurant' => 5, 'price' => 165) );
		$st->execute( array( 'name' => 'BBQ rebarca', 'food_type' => 'grill', 'description' => '(svinjska rebarca u BBQ umaku)', 'waiting_time' => 40, 'id_restaurant' => 5, 'price' => 72) );
		$st->execute( array( 'name' => 'Punjeni lungić', 'food_type' => 'grill', 'description' => '(svinjski lungić punjen sirom)', 'waiting_time' => 30, 'id_restaurant' => 5, 'price' => 71) );
		$st->execute( array( 'name' => 'Ćevapi', 'food_type' => 'grill', 'description' => '(juneći ćevapi, 10 kom)', 'waiting_time' => 20, 'id_restaurant' => 5, 'price' => 45) );
		$st->execute( array( 'name' => 'BBQ krilca', 'food_type' => 'grill', 'description' => '(pileća krilca u BBQ umaku)', 'waiting_time' => 35, 'id_restaurant' => 5, 'price' => 42) );		
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_food]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_food.<br />";
}


//-----------------------------------------------------
function seed_table_feedback()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_feedback(id_user, id_restaurant, content, rating, thumbs_up, thumbs_down) VALUES (:id_user, :id_restaurant, :content, :rating, :thumbs_up, :thumbs_down)' );

		$st->execute( array( 'id_user' => 1, 'id_restaurant' => 3, 'content' => 'Jako sam zadovoljan hranom, a u sluga je bila brza i sve je stiglo na vrijeme i točno je kao i u opisu hrane na web stranici.', 'rating' => 9, 'thumbs_up' => 1, 'thumbs_down' => 0 ) );
		$st->execute( array( 'id_user' => 1, 'id_restaurant' => 4, 'content' => 'Hrana je u redu, ali moglo je i bolje.', 'rating' => 8, 'thumbs_up' => 0, 'thumbs_down' => 1 ) );
		$st->execute( array( 'id_user' => 2, 'id_restaurant' => 1, 'content' => 'Hrana je jako fina.', 'rating' => 9, 'thumbs_up' => 3, 'thumbs_down' => 0 ) );
		$st->execute( array( 'id_user' => 3, 'id_restaurant' => 2, 'content' => 'Fino je.', 'rating' => 8, 'thumbs_up' => 0, 'thumbs_down' => 0 ) );
		$st->execute( array( 'id_user' => 3, 'id_restaurant' => 5, 'content' => 'Jako sam zadovoljna.', 'rating' => 9, 'thumbs_up' => 2, 'thumbs_down' => 1 ) );
		$st->execute( array( 'id_user' => 4, 'id_restaurant' => 5, 'content' => 'Jako fina hrana.', 'rating' => 9, 'thumbs_up' => 4, 'thumbs_down' => 0 ) );

	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_feedback]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_feedback.<br />";
}

//-----------------------------------------------------
function seed_table_orders()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_orders(id_user, id_restaurant, id_food, id_order) VALUES (:id_user, :id_restaurant, :id_food, :id_order)' );

		$st->execute( array( 'id_user' => 1, 'id_restaurant' => 3, 'id_food' => 3, 'id_order' => 1 ) );
		$st->execute( array( 'id_user' => 1, 'id_restaurant' => 3, 'id_food' => 2, 'id_order' => 1 ) );
		$st->execute( array( 'id_user' => 2, 'id_restaurant' => 1, 'id_food' => 1, 'id_order' => 2 ) );
		$st->execute( array( 'id_user' => 3, 'id_restaurant' => 2, 'id_food' => 4, 'id_order' => 3 ) );
		$st->execute( array( 'id_user' => 3, 'id_restaurant' => 5, 'id_food' => 4, 'id_order' => 4 ) );
		$st->execute( array( 'id_user' => 4, 'id_restaurant' => 5, 'id_food' => 4, 'id_order' => 5 ) );

	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_orders]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_orders.<br />";
}

//-----------------------------------------------
function seed_table_deliverers()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_deliverers(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\')' );

		$st->execute( array( 'username' => 'petar', 'password' => password_hash( 'petrovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'ivan', 'password' => password_hash( 'ivanovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'matej', 'password' => password_hash( 'matejevasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'iva', 'password' => password_hash( 'ivinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_deliverers]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_deliverers.<br />";
}
?> 
 
 
