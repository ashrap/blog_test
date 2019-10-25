<?php

class Post 

{

	public $id;

	public $title;

	public $text;

	public $image;


	public function preview() {

		return mb_substr($this->text, 0, 180) . '...';

	}

}