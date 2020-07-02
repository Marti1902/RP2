
<?php

class UserController extends BaseController{

    // nakon logina se prikazuje popis omiljenih restorana
    public function index(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Vaši omiljeni restorani';
        $narudzbe = $ls->getOrderListByUserId( $_SESSION['user']->id );
        $restorani = [];
        foreach ( $narudzbe as $narudzba ){
            $rest = $ls->getRestaurantById( $narudzba->id_restaurant );
            if ( !in_array( $rest, array_column( $restorani, 0 ) ) ){
                $i = 0;
                $s = 0;
                foreach( $narudzbe as $nar ){
                    if( $nar->id_restaurant == $rest->id_restaurant ){
                        $s = $s + $nar->rating;
                        $i++;
                    }
                }
                $restorani[] = [$rest, $s/$i];
                echo max(array_column($restorani, 1));
            }
        }
        $this->registry->template->restaurantList = $restorani;
        
        $this->registry->template->show( 'user_index' );
    }

    // popis svih restorana
    public function restaurants(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Svi restorani';
        $this->registry->template->restaurantList = $ls->getRestaurantList();
        
        $this->registry->template->show( 'user_restaurants' );
    }

    // popis restorana prema tipu hrane --> NEDOVRŠENO
    public function restaurantsByFoodType(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Restorani prema vrsti hrane';
        $this->registry->template->restaurantList = $ls->getRestaurantListByFoodType( $_GET['id_foodType']);
        
        $this->registry->template->show( 'user_restaurants' );
    }

    public function foodType(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Restorani prema vrsti hrane';
        $this->registry->template->foodType = $ls->getFoodTypeList();
        $this->registry->template->show( 'user_foodType' );
    }

    public function orders(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = 'Moje narudžbe';
        $_SESSION['tab'] = 'User orders';
        $narudzbe = $ls->getOrderListByUserId( $_SESSION['user']->id );
        $pomocni = [];
        foreach ( $narudzbe as $narudzba ){
            $narudzba->id_restaurant = ( $ls->getRestaurantById ( $narudzba->id_restaurant ) )->name;
            $hrana = $ls->getFoodIdListByOrderId( $narudzba->id_order );
            $spiza = [];
            for ( $i=0; $i < count( $hrana ); $i++ ){
                $spiza[] = $ls->getFoodById( $hrana[$i] );
            }
            $pomocni[] = [$narudzba, $spiza];
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
        $this->registry->template->foodList = $ls->getFoodListByRestaurantId( $restaurant->id_restaurant );
        $pomocni = $ls->getOrderListByRestaurantId( $restaurant->id_restaurant );
        
        foreach ( $pomocni as $pom )
            $pom->id_user = ( $ls->getUserById( $pom->id_user ) )->username;

        $this->registry->template->orderList = $pomocni;

        $this->registry->template->show( 'user_restaurant' );
    }

    // prema preporukama drugih
    public function popular()
    {
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Popularni restorani';
        $ratingList = $ls->getRatingList();
        
        foreach($ratingList as $rat)
            echo $rat->rating . " ";
        

        $restorani = [];
        foreach ( $ratingList as $rating ){
            $rest = $ls->getRestaurantById( $rating->id_restaurant );
            if ( !in_array( $rest, array_column( $restorani, 0 ) ) ){
                $i = 0;
                $s = 0;
                foreach( $ratingList as $nar ){
                    if( $nar->id_restaurant == $rest->id_restaurant ){
                        $s = $s + $nar->rating;
                        $i++;
                    }
                }
                $restorani[] = [$rest, $s/$i];
                //echo max(array_column($restorani, 1));
            }
        }
        
        $this->registry->template->restaurantList = $restorani;
        $this->registry->template->show( 'user_popular' );
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