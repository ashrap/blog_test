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

	public static function generateToken() {

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

}