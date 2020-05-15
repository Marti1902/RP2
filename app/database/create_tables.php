<?php

// Stvaramo tablice u bazi (ako već ne postoje od ranije).
require_once __DIR__ . '/db.class.php';

create_table_users();
create_table_restaurants();
create_table_food();
create_table_feedback();
create_table_orders();
create_table_deliverers();

exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->prepare( 
			'SHOW TABLES LIKE :tblname'
		);

		$st->execute( array( 'tblname' => $tblname ) );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}


function create_table_users()
{
	$db = DB::getConnection();

	if( has_table( 'spiza_users' ) )
		exit( 'Tablica spiza_users vec postoji. Obrisite ju pa probajte ponovno.' );


	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS spiza_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
			'has_registered int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create spiza_users]: " . $e->getMessage() ); }

	echo "Napravio tablicu spiza_users.<br />";
}


function create_table_restaurants()
{
	$db = DB::getConnection();

	if( has_table( 'spiza_restaurants' ) )
		exit( 'Tablica spiza_restaurants vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS spiza_restaurants (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'name varchar(50) NOT NULL,' .
			'address varchar(80) NOT NULL,' .
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
			'rating int NOT NULL,' .
			'food_type varchar(50) NOT NULL,' .
			'description varchar(50) NOT NULL,' .
			'has_registered int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create spiza_restaurants]: " . $e->getMessage() ); }

	echo "Napravio tablicu spiza_restaurants.<br />";
}


function create_table_food()
{
	$db = DB::getConnection();

	if( has_table( 'spiza_food' ) )
		exit( 'Tablica spiza_food vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS spiza_food (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'name varchar(50) NOT NULL,' .
			'food_type varchar(50) NOT NULL,' .
			'description varchar(200) NOT NULL,' .
			'waiting_time int NOT NULL,' .
			'id_restaurant int NOT NULL,' .
			'price int NOT NULL)'		
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create spiza_food]: " . $e->getMessage() ); }

	echo "Napravio tablicu spiza_food.<br />";
}

function create_table_feedback()
{
	$db = DB::getConnection();

	if( has_table( 'spiza_feedback' ) )
		exit( 'Tablica spiza_feedback vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS spiza_feedback (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_user int NOT NULL,' .
			'id_restaurant int NOT NULL,' .
			'content varchar(1000) NOT NULL,' .
			'rating int NOT NULL,' .
			'thumbs_up int NOT NULL,' .
			'thumbs_down int NOT NULL)'		
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create spiza_feedback]: " . $e->getMessage() ); }

	echo "Napravio tablicu spiza_restaurants.<br />";
}

function create_table_orders()
{
	$db = DB::getConnection();

	if( has_table( 'spiza_orders' ) )
		exit( 'Tablica spiza_orders vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS spiza_orders (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_user int NOT NULL,' .
			'id_restaurant int NOT NULL,' .
			'id_food int NOT NULL,' .
			'id_order int NOT NULL)'		
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create spiza_orders]: " . $e->getMessage() ); }

	echo "Napravio tablicu spiza_orders.<br />";
}

function create_table_deliverers()
{
	$db = DB::getConnection();

	if( has_table( 'spiza_deliverers' ) )
		exit( 'Tablica spiza_deliverers vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS spiza_deliverers (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,' .
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
			'has_registered int)'		
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create spiza_deliverers]: " . $e->getMessage() ); }

	echo "Napravio tablicu spiza_deliverers.<br />";
}



?> 
