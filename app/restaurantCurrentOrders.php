<?php

require_once __DIR__ . '/database/db.class.php';

function sendJSONandExit($message)
{// Kao izlaz skripte pošalji $message u JSON formatu i
    // prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8');
    echo json_encode($message);
    flush();
    exit(0);
}

//debug();

if( !isset( $_GET['timestamp'] ) )
    sendJSONandExit( ['error' => 'Nije postavljen timestamp!'] );
elseif( !isset( $_GET['id_restaurant'] ) )
    sendJSONandExit( ['error' => 'Nije postavljen id_restaurant!'] );

$clientLastUpdate = (int) $_GET['timestamp'];
$dbLastUpdate = -1;

$db = DB::getConnection();

while( $dbLastUpdate <= $clientLastUpdate ) 
{
    try{
        $st = $db->prepare( 'SELECT MAX(lastchange_time) as maxUpdate FROM spiza_orders WHERE id_restaurant=:val AND active <> 0' );
        $st->execute( [ 'val' => $_GET['id_restaurant'] ] );

        $row = $st->fetch();

        $dbLastUpdate = strtotime( $row['maxUpdate'] );

        if( is_null($row['maxUpdate']) )
        {
            $dbLastUpdate = 0;
            sendJSONandExit( [ 'nema' => 1 ] );
        }

        echo $dbLastUpdate;
        return;
        usleep( 10000 );    //  10ms
    }
    catch( PDOException $e ) { 
        $message['greska'] = ' Getting max in database!';
        sendJSONandExit($e);
     }
}

try{
    $st = $db->prepare( 'SELECT * FROM spiza_orders WHERE id_restaurant=:val AND active <> 0' );
    $st->execute( [ 'val' => $_GET['id_restaurant'] ] );
}
catch( PDOException $e ) { 
    $message['greska'] = ' Getting order list in database!';
    sendJSONandExit($e);
}

$msg = [];
$msg['id_order'] = [];
$msg['id_user'] = [];
$msg['order_time '] = [];
$msg['price_total'] = [];
$msg['discount'] = [];
$msg['note'] = [];

while( $row = $st->fetch() )
{
    $msg['id_order'][] = $row['id_order'];
    $msg['id_user'][] = $row['id_user'];
    $msg['order_time'][] = $row['order_time'];
    $msg['price_total'][] = $row['price_total'];
    $msg['discount'][] = $row['discount'];
    $msg['note'][] = $row['note'];
}


sendJSONandExit( $msg );

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