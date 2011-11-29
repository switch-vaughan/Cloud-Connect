<?php defined('SYSPATH') or die('No direct script access.');

class Controller_About extends Controller{
	public function action_index(){
		$this->response->body('frontend about');
	}
}