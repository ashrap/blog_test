
let URLn = '/edit';



let editButton = document.querySelector('#editButton');

let submitEdit = document.querySelector('#submitEdit');

let cancelEdit = document.querySelector('#cancelEdit');


let title = document.querySelector('#title').textContent;

let text = document.querySelector('#text').textContent;


let postTitle = document.querySelector('#postTitle');

let postText = document.querySelector('#postText');

let editForm = document.querySelector('#editForm');


let newTitle = title;

let newText = text;



postTitle.value = title;

postText.textContent = text;


/*****
**
*	Event listeners
**
******/

editButton.addEventListener('click', openForm);

cancelEdit.addEventListener('click', closeForm);


postTitle.addEventListener('change', function() {

	newTitle = postTitle.value;	

});

postText.addEventListener('change', function() {

	newText = postText.value;

});

submitEdit.addEventListener('click', updatePost);

/**************************************************/


function openForm(event) {

	event.preventDefault();


	editForm.classList.remove('d-none');

	$('#updateStatus').addClass('d-none'); 
	$('#formErorr').addClass('d-none'); 

	auto_grow(postText);

}


function closeForm(event) {

	event.preventDefault();

	editForm.classList.add('d-none');

	let title = document.querySelector('#title').textContent;

	let text = document.querySelector('#text').textContent;

	postTitle.value = title;

	postText.textContent = text;
	
	postTitle.value = title;

	postText.textContent = text;

}

function updatePost() {

	console.log(newTitle);

	console.log(newText);

	console.log(postId);


	//$.post( "/edit", $( "#editForm" ).serialize()) 

	$.post( "/edit", {

		title: newTitle,

		text: newText,

		id: postId,

		token: token


	}) 

		.done( function(data) {

			console.log(data);

			   try {
			        
			        let response = JSON.parse(data);

			        $('#title').html(response.title);
			        $('#text').html(response.text);
			        $('#lastModified').html(response.modified_at);
			        token = response.token;

			        let message = 'Post updated!';
			        $('#updateStatus').html(message);
		        	$('#updateStatus').removeClass('d-none'); 
		        	$(cancelEdit).click();


		            console.log(response);

			    } catch (e) {			    	

			        let message = ('Error' + data.split('Error')[1].split('"')[0]).slice(0, -1); 

			        $('#formError').html(message);
		        	$('#formError').removeClass('d-none'); 			        

			        console.log(message);

			    }		 


		})

	    .fail( function(xhr, status, error) {

        	console.log(error);        	

    	}

    );

}


function auto_grow(element) {

    element.style.height = "50px";

    if ( element.scrollHeight > 350 ) {

    	element.style.height = 350 + 'px';

    } else {

    	element.style.height = (element.scrollHeight)+"px";

    }	    

}

