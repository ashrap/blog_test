<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BLOG | test</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="/style.css">

</head>
<body>
	
	<nav class="navbar navbar-expand-lg fixed-top  navbar-dark bg-primary">

	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

	    	<span class="navbar-toggler-icon"></span>

	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">

		    <ul class="navbar-nav mx-auto">

		      	<li class="nav-item">

		        	<a class="nav-link text-white" href="/">Home<span class="sr-only"></span></a>		        

		      	</li>



<!-- if logged in -->

		      	<?php if( ! Session::status() ) : ?>		

			       	<li class="nav-item mr-auto">
			      	
						<a class="nav-link text-white" href="/login">Login<span class="sr-only">(current)</span></a>

			      	</li>

			       	<li class="nav-item mr-auto">
			      	
						<a class="nav-link text-white" href="/register">Register<span class="sr-only">(current)</span></a>

			      	</li>

		      	<?php endif; ?>

<!-- end if logged in -->


<!-- if not logged in -->	

				<?php if( Session::status() ) : ?>

					<li class="nav-item mr-auto">
			      	
						<a class="nav-link text-white" href="/new">New Post<span class="sr-only">(current)</span></a>

			      	</li>	

			      	<li class="nav-item mr-auto">
			      	
						<a class="nav-link text-white" href="/logout">Logout<span class="sr-only">(current)</span></a>

			      	</li>

		      	<?php endif; ?>

<!-- end if not logged in -->

		    </ul>

		</div>

	</nav>

	<div class="spacer"></div>