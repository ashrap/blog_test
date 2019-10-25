<?php


$db = App::get('database');


use Intervention\Image\ImageManagerStatic as Image;

Image::configure(array('driver' => 'imagick'));


class PostController 
{


/***********************
**
* *
*  Show all posts
* *
**
***********************/

	public function index() {


		$posts = App::get('database')->all('posts', 'desc');

		foreach ($posts as $post) {
		
			$post->modified_at = date('d-m-Y G:i:s', strtotime($post->modified_at));

		}



		return view('index', compact('posts'));


	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Show post
* *
**
***********************/

	public function show() {
		

		$id = explode('/', trim($_SERVER['REQUEST_URI'], '/'))[1];


		$post = App::get('database')->select('posts', ['id' => $id]);

		$user = App::get('database')->select('users', ['id' => $post['user_id']]);

		//die(var_dump($post));

		$post['author'] = $user['login'];

		if ( ! $post ) {

			return view('not_found');

		}

		return view( 'show', compact('post') );

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Show new post form
* *
**
***********************/

	public function new() {	

		if ( ! Session::status() ) {

			return redirect('login');

		}			

		return view('new');

	}

/*****************************************************************************************************/


	

/***********************
**
* *
*  Creating new post
* *
**
***********************/

	public function store() {

		//$request = Request::all();

		if ( ! Session::status() ) {

			return redirect('login');

		}


		$result = App::get('validation')->validate([

			'title' => 'required',

			'text' => 'required',

			'image' => 'image'

		]);


		if ( $result['image']['name'] !== '' ) {

			$result['image'] = $this->uploadImage($result['image']);

		}
	

		//die(var_dump($result));

		$user_id = $_SESSION['user_id'];

		$result['user_id'] = $user_id;	
		

		App::get('database')->create('posts', $result);


		$message = "New post created!";



		return view('new', compact('message'));

	}
	 
/*****************************************************************************************************/




/***********************
**
* *
*  Edit post
* *
**
***********************/

	public function edit() {

		if ( ! Session::status() ) {

			return redirect('login');

		}



		$id = $_POST['id'];

		

		$data = [

			'title' => $_POST['title'],

			'text' => $_POST['text']

		];


		$result = App::get('validation')->validate([

			'title' => 'required',

			'text' => 'required'

		], $data);


		App::get('database')->update('posts', $id, $result);


		$post = App::get('database')->select('posts', ['id' => $id]);

		$post['token'] = $_SESSION['token'];

		$post = json_encode($post);

		echo $post;

		//return 'hello';

	

}

/*****************************************************************************************************/




/***********************
**
* *
*  Delete post
* *
**
***********************/

	public function destroy() {


		if ( ! Session::status() ) {

			return redirect('login');

		}


		$id = $_POST['id'];


		$post = App::get('database')->select( 'posts', ['id' => $id] );


		if ( (int) $_SESSION['user_id'] !== (int) $post['user_id'] ) {

			throw new Exception("This is not your post!");
			
		}

		
		App::get('database')->delete('posts', $id);

		$image = App::get('public_path') . '/storage/images/' . $post['image'];

		unlink($image);



		return 'deleted';

	}
	 



/*****************************************************************************************************/


	

/***********************
**
* *
*  HELPER: upload image
* *
**
***********************/

	protected function uploadImage($image) {		

		$extension = explode('.', $image['name'])[1];		

		$random =  mt_rand() . mt_rand() . mt_rand() . time();

		$name = '::::' . base_convert($random, 10, 36) . '.' . $extension;

        $imgFilePost = Image::make($image['tmp_name']); //->encode('jpg', 75); 



        if ( $extension !== 'png' && $extension !== 'gif' ) {
            //checking orientation 
            $exif = exif_read_data($image);
            //and rotating if needed
            if (isset($exif['Orientation']))
        
            {
        
                switch ($exif['Orientation'])
        
                {
        
                    case 2:
        
                        $imgFilePost->flip('v');
        
                    break;
        
                    case 3:
        
                        $imgFilePost->rotate(-180);
        
                    break;
        
                    case 4:
        
                        $imgFilePost->flip('h');
        
                    break;
        
                    case 5:
        
                        $imgFilePost->rotate(-90)->flip('v');
        
                    break;
        
                    case 6:
        
                        $imgFilePost->rotate(-90);
        
                    break;
        
                    case 7:
        
                        $imgFilePost->rotate(90)->flip('v');
        
                    break;
        
                    case 8:
        
                        $imgFilePost->rotate(-90);
        
                    break;                
        
                }
        
            }
        
        }  
              

        $imgFilePost->resize(1280, null, function ($constraint) {

            $constraint->aspectRatio();

            $constraint->upsize();

        });         


        $imageFilePhotoMain = $imgFilePost->fit(680, 453)->save(App::get('public_path') . '/storage/images/' . $name);


        return $name;


	}

/*****************************************************************************************************/

}



