<?php


require '../model/Post.php';


class QueryBuilder 

{

	

	protected $pdo;



	public function __construct(PDO $pdo) {

		$this->pdo = $pdo;

	}

/*****************************************************************************************************/




/***********************
**
* *
*  Get all records from the table
* *
**
***********************/

	public function all($table, $order = '', $option = 'class' ) {

		$sql = "select * from " . $table . " order by created_at " . $order;

		//dd($sql);

		//dd($option);

		try {

		$statement = $this->pdo->prepare($sql);

		$statement->execute();

		} catch (PDOException $e) {

			die($e->getMessage());

		}

		if ( $option === 'assoc') {	

			return $statement->fetchAll(PDO::FETCH_ASSOC);

		} else if ( $option === 'class' ) {

			$className = mb_substr(ucfirst($table), 0, -1); 

			return $statement->fetchAll(PDO::FETCH_CLASS, $className);

		}

		

	}

/*****************************************************************************************************/




/***********************
**
* *
*  Create record in the table
* *
**
***********************/

	public function create($table, $params) {
		
		$sql = sprintf(

			"insert into %s (%s) values (%s)",

			$table,

			implode( ', ', array_keys($params) ),

			':' . implode( ', :', array_keys($params) )

		);


		try {

			$statement = $this->pdo->prepare($sql);

			$statement->execute($params);

		} catch(PDOException $e) {

			die($e->getMessage());

		}

	}

/*****************************************************************************************************/




/***********************
**
* *
*  Select record from the table
* *
**
***********************/

	public function select($table, $param) {

		foreach ($param as $key => $value) {	

			$sql = sprintf (

				"select * from %s where %s = %s",

				$table,

				$key,

				':' . $key

			);

		}


		try {

			$statement = $this->pdo->prepare($sql);

			$statement->execute($param);

		} catch(PDOException $e) {

			die($e->getMessage());

		}

		return $statement->fetch(PDO::FETCH_ASSOC);

	}

/*****************************************************************************************************/

	public function update($table, $id, $params)	{

		

		$sql = sprintf (

			"update %s set ",

			$table

		);

		foreach ($params as $key => $value) {

			$str = sprintf( 

				"%s = %s, ",

				$key,

				":" . $key

			);	

			$sql = $sql . $str;

		}

		$sql = mb_substr($sql, 0, -2);

		$str = sprintf(

			" where id = %s",

			$id

		);


		$sql = $sql . $str;

		//die($sql);

		//die($params['text']);


		try {

			$statement = $this->pdo->prepare($sql);

			$statement->execute($params);

		} catch(PDOException $e) {

			die($e->getMessage());

		}

	}


/***********************
**
* *
*  delete record from the table
* *
**
***********************/

	public function delete($table, $id) {


		$sql = sprintf (

			"delete from %s where id = %s",

			$table,

			$id 

		);

		try {

			$statement = $this->pdo->prepare($sql);

			$statement->execute();

		} catch(PDOException $e) {

			die($e->getMessage());

		}


	}


}