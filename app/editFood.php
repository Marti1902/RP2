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

$polja = array();
$vrjednosti = array();
$id_food = $_GET['id'];

if( $_GET['name'] !== '' ){
    array_push($polja, 'name');
    array_push($vrjednosti, $_GET['name']);
}
if( $_GET['price'] !== '' ){
    array_push($polja, 'price');
    array_push($vrjednosti, floatval($_GET['price']) );
}
if( $_GET['description'] !== '' ){
    array_push($polja, 'description');
    array_push($vrjednosti, $_GET['description']);
}
if( $_GET['waitingTime'] !== '' ){
    array_push($polja, 'waiting_time');
    array_push($vrjednosti, intval($_GET['waitingTime']) );
}

$upit = 'UPDATE spiza_food SET ';
$val = '';
$ex = array();

for( $i = 0; $i < count($polja); ++$i)
{
    $upit .=  $polja[$i] . '=:val'. $i;
    $ex[ 'val' . $i ]= $vrjednosti[$i];
    if( $i < count($polja) - 1 )
        $upit = $upit . ', ';

}
$upit .= ' WHERE id_food=:val10';

$ex['val10'] = intval($_GET['id']);

try
		{
            $db=DB::getConnection();
            $st=$db->prepare( $upit );
            $st->execute( $ex );
		}
        catch( PDOException $e ) { 
            $message['greska'] = 'Greška u bazi!';echo $e;
            sendJSONandExit($e);
         }
    $message['rezultat'] = 'Changes commited!';
    sendJSONandExit($message);



?>