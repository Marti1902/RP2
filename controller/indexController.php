<?php 
class IndexController extends BaseController
{
	public function index() 
	{
		debug();

		$this->registry->template->title = 'Log in';

		$this->registry->template->show( 'index_login');
	}
	
	public function logout()
	{
		session_destroy();
		header( 'Location: ' . __SITE_URL . '/index.php');
	}

	public function login()
	{	
		$ls = new Service();
		
		if( !isset( $_POST['username']) || !isset( $_POST['password'] ) || !isset( $_POST['log_in'] ) 
			/*|| preg_match()*/)	//	username ili pasword pogrešno uneseni ++++	dodati pregmatch da izbazi ako je maliciozan unos
		{	//	ispisat grešku pri login-u
			$this->registry->template->errorFlag = True;
			$this->registry->template->errorMsg = 'Poreška pri unosu!';
			$this->index();
			return;
		}

		if( $_POST['log_in'] === 'login_user')
			$database = 'spiza_users';		//preko posta odlucit na koju se bazu spaja i tj je li restoran, korisnik ili dostavljac
		else if($_POST['log_in'] === 'login_restaurants')
			$database = 'spiza_restaurants';
		else
			$database = 'spiza_deliverers';			
echo $database;
		if( !$ls->userExsists( $database, $_POST['username']) )
		{
			$this->registry->template->errorFlag = True;
			$this->registry->template->errorMsg = 'User does not exsist!';
			$this->index();
			return;
		}
		elseif( !$ls->emailConfirmed( $database, $_POST['username']) ){
			$this->registry->template->errorFlag = True;
			$this->registry->template->errorMsg = 'Registration not confirmed!';
			$this->index();
			return;
		}
		else{
			if( $ls->loginToDatabase( $database ) ){
				if( $database === 'spiza_users')
					header( 'Location: ' . __SITE_URL . '/index.php?rt=user' );
				else if($database === 'spiza_restaurants')
					header( 'Location: ' . __SITE_URL . '/index.php?rt=restaurants' );
				else
					header( 'Location: ' . __SITE_URL . '/index.php?rt=deliverers' );
			}
			else{
				$this->registry->template->errorFlag = True;
				$this->registry->template->errorMsg = 'Username of password incorrect!';
				$this->index();
				return;
			}
		}
		
	}

	public function registerForward()
	{
		$this->registry->template->title = 'Register';
		$this->registry->template->show( 'register');
	}

	public function register()			//		Trenutno SAMO za KORISNIKE - NE i za restorane
	{
		$ls = new Service();
		
		$database = 'spiza_users';

		if( !isset( $_POST['username']) || !isset( $_POST['password'] ) || !isset( $_POST['email'] )  )	//nisu postavljeni
		{
			$this->registry->template->errorFlag = True;
			$this->registry->template->errorMsg = 'Wrong input!';
			$this->registerForward();
		}
		elseif( $ls->userExsists( $database, $_POST['username']) )
		{
			$this->registry->template->errorFlag = True;
			$this->registry->template->errorMsg = 'Username taken!';
			$this->registerForward();
		}
		else
		{
			$ls->registerUser($database);			
			$this->index();
		}
	}

	function loginRestaurants()
	{
		debug();
		$this->registry->template->title = 'Log in for restaurants';
		$this->registry->template->show( 'index_loginRestaurants');

	}

	function loginDeliverers()
	{
		debug();
		$this->registry->template->title = 'Log in for deliverers';
		$this->registry->template->show( 'index_loginDeliverers');

	}
}; 




// ------



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
