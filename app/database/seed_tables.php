<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_restaurants();

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
		$st = $db->prepare( 'INSERT INTO spiza_restaurants(username, password_hash, name, address, email, registration_sequence, rating, description, has_registered) VALUES (:username, :password, :name, :address, \'a@b.com\', \'abc\', :rating, \'blabla\', \'1\')' );

		$st->execute( array( 'username' => 'dvojka', 'password' => password_hash( 'dvojkasifra', PASSWORD_DEFAULT ), 'name' => 'Dvojka Pizza',  'address' => 'nesto' , 'rating' => 1) );
		$st->execute( array( 'username' => 'zac', 'password' => password_hash( 'zacsifra', PASSWORD_DEFAULT ), 'name' => 'Zac Pizza',  'address' => 'nesto', 'rating' => 2 ) );
		$st->execute( array( 'username' => 'rocket', 'password' => password_hash( 'rocketsifra', PASSWORD_DEFAULT ), 'name' => 'RocketBurger',  'address' => 'nesto', 'rating' => 3) );
		$st->execute( array( 'username' => 'submarine', 'password' => password_hash( 'submarinesifra', PASSWORD_DEFAULT ), 'name' => 'Submarine',  'address' => 'nesto', 'rating' => 4 ) );
		$st->execute( array( 'username' => 'pingvin', 'password' => password_hash( 'pingvinsifra', PASSWORD_DEFAULT ), 'name' => 'Pingvin',  'address' => 'nesto', 'rating' => 5 ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_restaurants]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_restaurants.<br />";
}


// ------------------------------------------


?> 
 
 
