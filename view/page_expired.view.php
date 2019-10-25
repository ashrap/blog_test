<?php

require 'layouts/header.view.php';

?>


<div class="container mt-5 px-0 bg-success">
	
	<h5 id="info">Page expired | 419</h5>

</div>


<script>
	
	let info = document.querySelector('#info');

	info.style.position = 'fixed';

	info.style.top = window.innerHeight/2 - info.clientHeight/2 + 'px';

	info.style.left = window.innerWidth/2 - info.clientWidth/2 + 'px';

</script>


<?php

	require 'layouts/footer.view.php';

?>