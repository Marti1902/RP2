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




if( !isset($_GET['order_id'])||!isset($_GET['status']) )
    exit(1);

try
		{
            $db=DB::getConnection();
            $st=$db->prepare( 'UPDATE spiza_orders SET active=:val WHERE id_order=:val2' );
            $st->execute( [ 'val' => intval($_GET['status']), 'val2' => $_GET['order_id']] );
		}
        catch( PDOException $e ) { 
            $message['greska'] = 'Greška u bazi!';echo $e;
            sendJSONandExit($e);
            exit(2);
         }
    $message['rezultat'] = 'Changes commited!';
    sendJSONandExit($message);



?>