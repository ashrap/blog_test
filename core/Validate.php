<?php


class Validate 

{

	public function __construct() {

	}

	protected $ajax_request = false;

	protected $rules = [];
	
	protected $data = [];

	protected $errMessages = []; 

/*****************************************************************************************************/


	

/***********************
**
* *
*  Validation
* *
**
***********************/

	public function validate($rules, $data=[]) {

		if ( empty( $data ) ) {

			$request = Request::all();

		} else {

			$request = $data;

			$this->ajax_request = true;

		}

		//die(var_dump($request));

		unset($request['token']);

		$this->rules = $rules;

		//die(var_dump($_REQUEST));

		foreach( $request as $key => $value ) {


			if ( ! is_array($value) ) {

				$this->data[$key] = htmlspecialchars( 

					stripslashes( 

						trim( $value ) 
					
					) 

				);

			} else {

				$this->data[$key] = $value;

			}

		}


		//die(var_dump($this->data));


		if (in_array ('required', $this->rules)) {

			$this->required();

		}

		if (in_array ('image', $this->rules)) {

			$this->image();

		}


		

		return $this->result();

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Check required fields
* *
**
***********************/

	protected function required() {

		foreach ($this->rules as $key => $value) {
				
			if ( $value === 'required' ) {

				//die($key);

				//die(var_dump($_POST[$key]));
				
				if ( empty($_POST[$key]) ) {

					$this->errMessages[$key] = "Error: Field '{$key}' is required!";

				}
				

			}

		}

	}

/*****************************************************************************************************/




/***********************
**
* *
*  Check image fields
* *
**
***********************/
	protected function image() {

		foreach ($this->rules as $key => $value) {
				
			if ( $value === 'image' && ($this->data[$key]['name']) !== '' )  {


				$file = $this->data[$key];


				$whitelist_type = array('image/jpeg', 'image/png','image/gif');
				
				
				if( function_exists( 'finfo_open' ) ) {   

				   $fileinfo = finfo_open( FILEINFO_MIME_TYPE );

				    if ( !in_array(finfo_file( $fileinfo, $file['tmp_name'] ), $whitelist_type ) ) {

				      $this->errMessages[$key]  = "Error: Uploaded file is not a valid image. Supported image types: jpeg/png/gif";

				    }

				} else if( function_exists('mime_content_type' ) ) {

				    if (!in_array(mime_content_type($file['tmp_name']), $whitelist_type)) {
				    
				      $this->errMessages[$key]  = "Uploaded file is not a valid image";
				    
				    }
				
				} else{
				  
				   if (!@getimagesize($file['tmp_name'])) {  //@ - for hide warning when image not valid
				  
				     $this->errMessages[$key]  = "Uploaded file is not a valid image";
				  
				   }
				
				}								

			}

		}

	}

/*****************************************************************************************************/
	



/***********************
**
* *
*  Return validation result
* *
**
***********************/

	protected function result() {

		if ( ! empty( $this->errMessages ) ) {

			if ($this->ajax_request) {

				die(var_dump($this->errMessages));

			}

			$location = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );

			return redirect ($location, $this->errMessages, $this->data );

		} else {			

			return $this->data;

		}

	}



}