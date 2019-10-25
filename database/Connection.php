<?php

class Connection 

{


	public static function make($config) {


		try {			

			return new PDO (

				$config['connection'] 

					. ':host=' . $config['host']

					. ';dbname=' . $config['dbname'],

				$config['user_name'],

				$config['password'],

				$config['options'] 

			);

		} catch( PDOException $e) {

			die($e->getMessage());

		}


	}


}