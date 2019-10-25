<?php

require 'layouts/header.view.php';

?>

<div class="container mt-5 px-0">


	
	<div class="row m-0 p-0 justify-content-center">

		<?php if( Session::status() ) : ?>

			<?php if( (int) $_SESSION['user_id'] === (int) $post['user_id'] ) : ?>

				<form class="border rounded p-5 col-12 col-md-9 mb-3 d-none" enctype="multipart/form-data" id="editForm">

					<h5 class="text-center text-success">Edit Post</h5>

					<h6 class="text-danger text-center d-none" id="formError"></h6>
					
					<div class="form-row">		

						<input type="hidden" name="token" id="editFormToken" value="<?= $_SESSION['token']; ?>">

						<input type="hidden" name="postId" id="postId" value="<?= $post['id']; ?>">	

						<div class="form-group col-12">

							<label for="postTitle">Title</label>

						    <input 

						    	type="text" 

						    	class="form-control" 

						    	id="postTitle" 

						    	placeholder="Title" 

						    	name="title"

						    	required

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

							required 

							><?php if (isset($_SESSION['data']['text'])); echo $_SESSION['data']['text']; ?></textarea>

							<?php if (isset($_SESSION['errors']['text'])): ?>

						    	<span class="text-danger"><?= $_SESSION['errors']['text']; ?></span>

						    <?php endif; ?>

						</div>
						

					</div>

					<button class="btn btn-block btn-success mt-3" type="button" id="submitEdit">Confirm Changes</button>

					<button class="btn btn-block btn-primary mt-3" type="button" id="cancelEdit">Cancel</button>

				</form>

			<?php endif; ?>

		<?php endif; ?>
		
		<div class="col-12 col-md-8" id="showContent">
			
		<?php if ( ! empty($post) ) : ?>
		
			<h6 class="text-danger d-none text-center" id="updateStatus"></h6>

			<div class="card">


				<div class="card-header d-sm-flex justify-content-between align-items-center">
					
					<div class="m-0 p-0">

					    <h5 class="card-title" id="title"><?= $post['title']; ?></h5>

					    <h6 class="card-subtitle mb-2 text-muted" id="lastModified">Last modified: <?= $post['modified_at']; ?></h6>

				    </div>

				    

						<div class="m-0 p-0 text-center">

							<h6 class="card-subtitle py-1">Posted by: <?= $post['author']; ?></h6>
							
							<?php if( Session::status() ) : ?>

								<?php if( (int) $_SESSION['user_id'] === (int) $post['user_id'] ) : ?>

									<button class="btn btn-sm btn-primary" id="editButton">Edit</button>

									<button class="btn btn-sm btn-danger" id="deleteButton">Delete</button>			

									<input type="hidden" name="postId" id="postId" value="<?= $post['id']; ?>">

									<input type="hidden" name="token" id="token" value="<?= $_SESSION['token']; ?>">

								<?php endif; ?>

							<?php endif?>

						</div>

					

				 </div>

				
				
				<img src="/storage/images/<?= $post['image']; ?>" alt="" class="card-img-top p-3">	

				<div class="card-body">			

					<span 
					
						style="white-space: pre-wrap; font-size: 1rem; max-width:100%; width:100%; display:block; word-wrap: break-word;"

						id="text"

						class="card-text"

					><?= $post['text']; ?></span>

				</div>

			</div>

		<?php endif; ?>

		</div>

	</div>

</div>

<?php if( Session::status() ) : ?>

	<script src="<?= $public_path; ?>/js/deletePost.js"></script>

	<script src="<?= $public_path; ?>/js/editPost.js"></script>

<?php endif; ?>

<?php

	require 'layouts/footer.view.php';

?>