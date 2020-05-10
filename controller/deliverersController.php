
<?php

class DeliverersController extends BaseController{

    public function index(){
        //$ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Deliverers index';
        //$this->registry->template->channelList = $ls->getMyChannels();
        $this->registry->template->show( 'deliverers_index' );
    }

};


//  -----------------
function error404(){        //  provjerava ako se korisnik odlogirao pa ga preusmjerava na 404
    if( !isset($_SESSION['deliverers']) ){
        header( 'Location: ' . __SITE_URL . '/index.php?rt=404' );
    }
}

function debug()
{
	echo '<pre>$_POST=';
	print_r( $_POST );
	if (session_status() !== PHP_SESSION_NONE) {
		
	echo '$_SESSION=';
	print_r( $_SESSION );
    }
	echo '</pre>';
}




?>