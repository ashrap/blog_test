<?php

require 'layouts/header.view.php';

?>

<div class="container mt-5 px-0">

	<?php if (empty($posts)) : ?>

		<div class="justify-content-center">

			<span class="d-block text-danger text-center pb-3">We have no posts yet</span>

		</div>

	<?php endif; ?>
	
	<div class="row m-0 p-0">
			
		<?php foreach ($posts as $post): ?>

			<div class="col col-12 col-md-6 col-lg-4 my-2 mx-0">
				
				<div class="card"  style="min-height: 520px;">

					<img src="storage/images/<?= $post->image; ?>" alt="" class="card-img-top p-3">							
						
						<div class="card-body">
							
							<a href="/post/<?= $post->id; ?>"><h5 class="card-title"><?= $post->title; ?></h5></a>

							<h6 class="card-subtitle mb-2 text-muted">Last modified: <?= $post->modified_at; ?></h6>

							<p class="card-text"><?= $post->preview(); ?></p>

						</div>					

				</div>

			</div>

		<?php endforeach ?>		

	</div>

</div>


<?php

	require 'layouts/footer.view.php';

?>

