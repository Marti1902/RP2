
<?php

class DeliverersController extends BaseController{

    public function index(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Dostavljači';

        $slobodne = $ls->getAvailableOrders();

        $this->registry->template->availableOrders=$slobodne;
        $this->registry->template->show( 'deliverers_index' );
    }

    public function order()
    {
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Prihvatili ste narudžbu';


        $narudzba=$_GET['id_order'];
        echo $narudzba;

        $ls->acceptOrder($narudzba);
        $aktulna_narudzba=$ls->getCurrentOrder($narudzba);
        $this->registry->template->currentOrder=$aktulna_narudzba;
        $this->registry->template->show( 'deliverers_accepted' );
    }

    public function delivered()
    {
        $ls = new Service();
        error404();
        debug();

        if(isset($_POST['dostavljeno']))
            $ls->finish($_POST['btn_dostavljeno']);

        $this->registry->template->title = $_SESSION['tab'] = 'Dostavljači';

        $slobodne = $ls->getAvailableOrders();
    
        $this->registry->template->availableOrders=$slobodne;
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