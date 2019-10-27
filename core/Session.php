<?php

class Session

{

	public static function start() {

		session_start();

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Give verified status after successfull login
* *
**
***********************/

	public static function verified($login, $site, $user_id) {

		$key = $site;

		$_SESSION[$key] = true;

		$_SESSION['user_id'] = $user_id;

	    $_SESSION['username'] = $login;

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Get status true ? false loggedin : not loggedin
* *
**
***********************/

	public static function status() {

		if ( $_SESSION[App::get('config')['site']]  && $_SESSION['username'] ) {

			return true;

		} else {

			return false;

		}

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Generate CSRF token
* *
**
***********************/

	public static function generateToken($uri, $requestType) {		

		$_SESSION['request'] = $requestType;

		
		if ( ! Session::checkRequest($uri, $requestType) ) return;


		$_SESSION['previous_uri'] = $uri;

		$_SESSION['previous_request_type'] = $requestType;
	

		
		$_SESSION['previous_token'] = $_SESSION['token'];

		
		$_SESSION['token'] = bin2hex(random_bytes(32));



	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Put errors to session
* *
**
***********************/

	public static function errors($errors) {

		$_SESSION['errors'] = $errors;

	} 

/*****************************************************************************************************/


	

/***********************
**
* *
*  Put data to session
* *
**
***********************/

	public static function data($data) {

		$_SESSION['data'] = $data;

	} 

/*****************************************************************************************************/


	

/***********************
**
* *
*  Unset data and errors from session
* *
**
***********************/

	public static function clear() {

		unset($_SESSION['errors']);

		unset($_SESSION['data']);

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Check request
* *
**
***********************/

	public static function checkRequest($uri, $requestType) {

		if ( ! isset ( $_SESSION['previous_uri'] ) && ! isset ( $_SESSION['previous_request_type'] ) ) {

			return true;

		} 


		if ( $_SESSION['previous_uri'] === $uri && $_SESSION['previous_request_type'] === $requestType ) {

			return false;

		}

		return true;

	}

}