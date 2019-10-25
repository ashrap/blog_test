<?php



Class LoginController 

{


	protected $site = "";



	public function __construct() {

		$this->site = App::get('config')['site'];

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Show login form
* *
**
***********************/

	public function index() {

		return view('login');

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Verify and Login 
* *
**
***********************/

	public function login() {

		$result = App::get('validation')->validate([

			'login' => 'required',

			'password' => 'required'

		]);



		$user = App::get('database')

			->select('users', ['login' => $result['login'] ]);

		

		if ( ! password_verify($result['password'], $user['password']) ) {

			$error = 'This credentials do not match!';

			return redirect('login', ['verify' => $error] );

		}


		Session::verified($result['login'], $this->site, $user['id']);



		return redirect('/');

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Logout
* *
**
***********************/

	public function logout() {


		session_destroy();

	    unset($_SESSION['username']);

	    unset($_SESSION[$_SESSION[App::get('config')['site']]]);

	    return redirect('login');


	}


}