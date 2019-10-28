<?php

Class RegisterController 

{


	public function index() {

		if ( Session::status() ) {

			return redirect('/');

		}

		return view('register');

	}



	public function store() {


		if ( Session::status() ) {

			return redirect('/');

		}
		

		$result = App::get('validation')->validate([

			'login' => 'required',

			'password' => 'required',

			'confirm_password' => 'required'

		]);


		$users = App::get('database')->all('users', '', 'assoc');

		foreach($users as $user) {

			if ( mb_strtolower($user['login'], 'utf-8') === mb_strtolower($result['login'], 'utf-8') ) {

				$error = 'Login ' . $result['login'] . ' already exist!';

				return redirect('register', ['login' => $error]);

			}

		}

		//dd($users);


		$password_hash = password_hash($result['password'], PASSWORD_DEFAULT);


		if ( ! password_verify($result['confirm_password'], $password_hash) ) {

			$error = 'Passwords do not match!';

			return redirect ('register',  ['confirm_password' => $error]);

		}


		$user_info = [

			'login' => $result['login'],

			'password' => $password_hash

		];


		App::get('database')->create('users', $user_info);


		return redirect('login', [], ['message' => "Success! You can login!"]);
		

	}


}