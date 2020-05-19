<?php

require_once __DIR__ . '/database/db.class.php';


function sendJSONandExit($message)
{
    header( 'Content-type:application/json;charset=utf-8');
    echo json_encode($message);
    flush();
    exit(0);
}
debug();

$message=[];

if( !isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['description']) ||
    !isset($_POST['waitingTime']) || !isset($_POST['id_restaurant']) )
{
    echo 'ERROR: Parameters missing!';
    exit(1);
}

//           Priprema za spremanje slike
/*
$filename = $_FILES['file']['name'];
$tmp = explode( '.', $filename);

// Ime slike će biti [id_food].jpg/.jpeg/.png
$location = 'images/food/' . $_POST['id_food']. '.'.end($tmp);
$uploadOk = 1;
$imgType = pathinfo( $location, PATHINFO_EXTENSION );

$valid_extesnsions = array( "jpg", "jpeg", "png" );
if( !in_array( strtolower($imgType) , $valid_extesnsions ) )
    $uploadOk = 0;

if( $uploadOk === 0)
    echo 'ERROR: upload!';
else{
    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
        echo $location;
     }else{
        echo 'ERROR moveing image!';
    }
}

*/ 
try{
        $db=DB::getConnection();
        $st=$db->prepare( 'INSERT INTO spiza_food(name, description, waiting_time, id_restaurant, price, in_offering) VALUES (:name, :description, :waiting_time, :id_restaurant, :price, :in_offering); SELECT LAST_INSERT_ID();' );

        $test = $st->execute( array( 'name' => $_POST['name'],  'description' => $_POST['description'], 'waiting_time' => intval( $_POST['waitingTime'] ), 'id_restaurant' => intval( $_POST['id_restaurant'] ), 'price' => intval( $_POST['price'] ), 'in_offering' => 1) );		

    }
    catch( PDOException $e ) { 
        $message['greska'] = 'Greška u bazi!';echo $e;
        sendJSONandExit($e);
        exit(2);
        }
//$message['rezultat'] = 'Added food ' . $_POST['name'] . '!';
print_r($test);

function debug()
{
    echo '<pre>';
    if( isset( $_POST ) )
    {
        echo '$_POST=';
        print_r( $_POST );
    }
    if( isset( $_GET ) )
    {
        echo '$_GET=';
        print_r( $_GET );
    }
    if( isset( $_FILES ) )
    {
        echo '$_FILES=';
        print_r( $_FILES );
    }

    echo '</pre>';
}


?>