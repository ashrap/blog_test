<?php

//die(var_dump($_SESSION));


require 'layouts/header.view.php';

?>




<div class="container mt-5 px-0">	
			
	<div class="row m-0 p-0 px-1 mb-2 justify-content-center">


		<?php if (isset($message)): ?>

			<div class="col-12 text-center text-success">
				
				<h5><?= $message; ?></h5>

			</div>

		<?php endif ?>
		
		<div class="col-12 text-center">
			
			<h5>New post</h5>

		</div>

	

		<div class="col-12 col-sm-8">

			<form class="border rounded px-1 px-sm-5 pb-2 pb-sm-5 pt-4" action="/new" method="POST" enctype="multipart/form-data">

				<div class="form-row">	

					<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">		

					<div class="form-group col-12">

						<label for="postTitle">Title</label>

					    <input 

					    	type="text" 

					    	class="form-control" 

					    	id="postTitle" 

					    	placeholder="Title" 

					    	name="title"

					    	value="<?php if (isset($_SESSION['data']['title'])); echo $_SESSION['data']['title']; ?>" 

					    >

					    <?php if (isset($_SESSION['errors']['title'])): ?>

					    	<span class="text-danger"><?= $_SESSION['errors']['title']; ?></span>

					    <?php endif; ?>


					</div>

					<div class="form-group col-12 mt-3">

						<label for="postText">Post</label>

						<textarea class="form-control" aria-label="Post" id="postText" placeholder="Type here..." name="text"

						oninput="auto_grow(this)"

						><?php if (isset($_SESSION['data']['text'])); echo $_SESSION['data']['text']; ?></textarea>

						<?php if (isset($_SESSION['errors']['text'])): ?>

					    	<span class="text-danger"><?= $_SESSION['errors']['text']; ?></span>

					    <?php endif; ?>

					</div>

					<div class="form-group col-12 mt-4">

					  	<div class="custom-file">

					    	<input 

					    		type="file" 

					    		class="custom-file-input" 

					    		id="postImage" 

					    		name="image"

					    		value="<?php if (isset($_SESSION['data']['image'])); echo $_SESSION['data']['image']; ?>" 

					    	>

					   		<label class="custom-file-label" for="postImage" aria-describedby="postImage">Upload an image</label>

					   		<?php if (isset($_SESSION['errors']['image'])): ?>

						    	<span class="text-danger"><?= $_SESSION['errors']['image']; ?></span>

						    <?php endif; ?>

					  	</div>
					
					</div>

				</div>

				<button class="btn btn-block btn-primary mt-3" type="submit">Add Post</button>

			</form>

		</div>

	</div>

</div>

</div>

<script>

	let textarea = document.querySelector('#postText');

	auto_grow(textarea);

	function auto_grow(element) {

	    element.style.height = "50px";

	    if ( element.scrollHeight > 350 ) {

	    	element.style.height = 350 + 'px';

	    } else {

	    	element.style.height = (element.scrollHeight)+"px";

	    }	    

	}

</script>

<?php

	require 'layouts/footer.view.php';

?>
