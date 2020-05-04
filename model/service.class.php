<?php 

require_once __DIR__ . '/../app/database/db.class.php';

class Service{
    /*          P   R   I   M   J   E   R   I       F   U   N   K   C   I   J   A
    public function getMyChannels(){
        
        $channels =[];

        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM dz2_channels WHERE id_user=:user');
        $st->execute( ['user'=>$_SESSION['user']->id] );

        while( $row = $st->fetch() )
            $channels[] = new Channel($row['id'], $row['id_user'], $row['name']);
        return $channels;
    }


    public function sendMessege()
    {
        $messege = $_POST['poruka'];
        date_default_timezone_set("Europe/Zagreb");
        
        $db = DB::getConnection();
        $st = $db->prepare( 'INSERT INTO dz2_messages (id_user, id_channel, content, thumbs_up, date) VALUES (:val1,:val2,:val3,:val4,:val5)');
        $st->execute(['val1'=> $_SESSION['user']->id, 'val2'=> $_SESSION['current_channel']->id, 'val3'=>$messege, 'val4'=>0, 'val5'=>date("Y-m-d h:i:s")]);
    }*/

    //                      F-je    za  LOGIN
    function userExsists($databaseName, $username)
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM '.$databaseName.' WHERE username=:user');
        $st->execute(['user'=>$username]);
        if( $st->rowCount() !== 0)
            return True;
        else
            return False;
    }

    function emailConfirmed($databaseName, $username )
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT has_registered FROM '.$databaseName.' WHERE username=:user');
        $st->execute(['user'=>$username]);
        $st = $st->fetch();
        if( $st[0] )
            return True;
        else
            return False;
    }

    function loginToDatabase( $databaseName )    //  username i password primamo preko $_POST-a
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM '.$databaseName.' WHERE username=:user');
        $st->execute(['user'=>$_POST['username']]);

        if( $st->rowCount() !== 1)	// korisnik ne postoji ili ih je više -- ispisat grrešku
            return False;
        
        $row = $st->fetch();
        $password_hash = $row['password_hash'];

        if( password_verify( $_POST['password'], $password_hash) )
        {
            if( $_POST['log_in'] === 'login_user')
                $_SESSION['user'] = new User($row['id'], $row['username'], ' ',$row['email'], $row['registration_sequence'], $row['has_registered'] );
            else 
                $_SESSION['restaurants'] = new Restaurants($row['id'], $row['username'], ' ', $row['name'], $row['address'], $row['email'], $row['registration_sequence'], $row['rating'], $row['description'], $row['has_registered'] );
            return True;
        }
        else
            return False;
    }

    //                      F-je    za  REGISTER
    function registerUser($databaseName)
    {
        $reg_seq = '';
        for( $i = 0; $i < 20; ++$i )
            $reg_seq .= chr( rand(0, 25) + ord( 'a' ) );

        $db = DB::getConnection();
        $st = $db->prepare( 'INSERT INTO '.$databaseName.' (username, password_hash, email, registration_sequence, has_registered) VALUES (:val1,:val2,:val3,:val4,:val5)');
        $st->execute(['val1'=> $_POST['username'],'val2'=> password_hash( $_POST['password'], PASSWORD_DEFAULT ), 
                    'val3'=> $_POST['email'],'val4'=> $reg_seq,'val5'=> 0]);

        $to       = $_POST['email'];
        $subject  = 'Registracijski mail';
        $message  = 'Poštovani ' . $_POST['username'] . "!\nZa dovršetak registracije kliknite na sljedeći link: ";
        $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/register.php?niz=' . $reg_seq . "\n";
        $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
                    'Reply-To: rp2@studenti.math.hr' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        $isOK = mail($to, $subject, $message, $headers);

        if( !$isOK )
            exit( 'Greška: ne mogu poslati mail. (Pokrenite na rp2 serveru.)' );
        
    }

    //                      F-je za prikaz restorana
    
    function getRestaurantListByRating()
    {
        $restaurants =[];

        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM spiza_restaurants ORDER BY rating');
        $st->execute( );

        while( $row = $st->fetch() )
            $restaurants[] = new Restaurants($row['id'], '', '', $row['name'], $row['address'], $row['email'], '', $row['rating'], $row['description'], 1 );
        return $restaurants;
    }


};

//  -------------------------------------------------------------


function editContent( $userList, $content){
    foreach( $userList as $user )
        if( strpos($content, '@'.$user) !== False )
            $content = str_replace('@'.$user,'<a href="'. __SITE_URL . '/index.php?rt=messeges/userMesseges/?name='.$user.'">@' . $user . '</a>', $content);
    return $content;
}
function stringToColorCode($str) {
    $code = dechex(crc32($str));
    $code = substr($code, 0, 6);
    return $code;
  }
?>