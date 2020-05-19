<?php

require_once __DIR__ . '/database/db.class.php';


function sendJSONandExit($message)
{
    header( 'Content-type:application/json;charset=utf-8');
    echo json_encode($message);
    flush();
    exit(0);
}


$message=[];




if( !isset($_GET['name']) || !isset($_GET['price']) || !isset($_GET['description']) ||
    !isset($_GET['waitingTime']) || !isset($_GET['id_restaurant']) )
{
    $message['greska'] = 'Parameters missing!';
    sendJSONandExit($message);
    exit(1);
}

try
		{
            $db=DB::getConnection();
            $st=$db->prepare( 'INSERT INTO spiza_food(name, description, waiting_time, id_restaurant, price, in_offering) VALUES (:name, :description, :waiting_time, :id_restaurant, :price, :in_offering)' );
            $st->execute( array( 'name' => $_GET['name'],  'description' => $_GET['description'], 'waiting_time' => intval( $_GET['waitingTime'] ), 'id_restaurant' => intval( $_GET['id_restaurant'] ), 'price' => intval( $_GET['price'] ), 'in_offering' => 1) );		
        }
        catch( PDOException $e ) { 
            $message['greska'] = 'Greška u bazi!';echo $e;
            sendJSONandExit($e);
            exit(2);
         }
    $message['rezultat'] = 'Added food ' . $_GET['name'] . '!';
    sendJSONandExit($message);



?>