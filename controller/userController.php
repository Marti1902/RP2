
<?php

class UserController extends BaseController{

    public function index(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'User index';
        $this->registry->template->restaurantList = $ls->getRestaurantListByRating();
        
        $this->registry->template->show( 'user_index' );
    }

    public function orders(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = 'Moje narudžbe';
        $_SESSION['tab'] = 'User orders';
        $pomocni = $ls->getOrdersByUserId( $_SESSION['user']->id );
        #$i=0;
        foreach ( $pomocni as $pom ){
            #$rest = $ls->getRestaurantById ( $pom->id_restaurant );
            #$hrana = $ls->getFoodById ( $pom->id_food );
            #$pomocni[$i]->id_restaurant = $rest->name;
            #$pomocni[$i]->id_food = $hrana->name;
            #$i++;
            $pom->id_restaurant = ( $ls->getRestaurantById ( $pom->id_restaurant ) )->name;
            $pom->id_food = ( $ls->getFoodById ( $pom->id_food ) )->name;
        }
        $this->registry->template->orderList = $pomocni;

        $this->registry->template->show( 'user_orders' );
    }

    public function restaurant(){
        $ls = new Service();
        error404();
        debug();

        $restaurant = $ls->getRestaurantById ( $_GET['id_restaurant'] );
        $this->registry->template->title = $restaurant->name;
        $_SESSION['tab'] = 'User restaurant';
        $this->registry->template->foodList = $ls->getFoodListByRestaurantId( $restaurant->id );
        $pomocni = $ls->getFeedbackListByRestaurantId( $restaurant->id );
        
        foreach ( $pomocni as $pom )
            $pom->id_user = ( $ls->getUserById( $pom->id_user ) )->username;

        $this->registry->template->feedbackList = $pomocni;

        $this->registry->template->show( 'user_restaurant' );
    }

};


//  -----------------
function error404(){        //  provjerava ako se korisnik odlogirao pa ga preusmjerava na 404
    if( !isset($_SESSION['user']) ){
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