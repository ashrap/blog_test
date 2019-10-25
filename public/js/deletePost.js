let container = document.querySelector('#showContent');

let deleteButton = document.querySelector('#deleteButton');

let postId = document.querySelector('#postId').value;

let token = document.querySelector('#token').value;

let URL = '/delete';

let data = 'id=' + encodeURIComponent(postId) + '&token=' + encodeURIComponent(token);

let method = 'POST';


deleteButton.addEventListener('click', deletePost);


function deletePost(event) {

	event.preventDefault();

	console.log(token);

	
	let xhr = new XMLHttpRequest();

	xhr.open(method, URL, true);



	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


	xhr.send(data);

	xhr.onload = function() {

	  	console.log(`Loaded: ${xhr.status}`);

	  	console.log(`Loaded: ${xhr.response}`);

	  	clearContainer();	  	

	};

}


function clearContainer(){

	while (container.firstChild) {

		container.removeChild(container.firstChild);

	}
	

  	let deletedMessage = document.createElement('h5');

  	deletedMessage.className="text-danger text-center";

  	deletedMessage.textContent = "Post deleted!";

  	container.append(deletedMessage);


}