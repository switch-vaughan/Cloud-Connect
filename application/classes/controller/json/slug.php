<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Json_Slug extends Controller{
	public function before(){
		if(!$this->request->is_ajax()){
			exit();
		}
	}
	
	public function action_verify(){
		Security::clean_get_data();
		
		$_GET['slug'] = URL::clean($_GET['slug']);
		
		//check if slug already exists
		$slug = Model::factory('article_common');
		$inUse = (bool)$slug->slug_in_use($_GET['slug'], $_GET['id']);
		
		echo json_encode(array('inUse' => $inUse, 'slug' => $_GET['slug']));
	}
}