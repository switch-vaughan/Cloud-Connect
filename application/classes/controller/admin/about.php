<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_About extends Controller_Admin_Article{
	protected $fields = array('title' => array('required'),
							'slug' => array('readonly'),
							'copy' => NULL);
	protected $pageTitle = 'About Us';
	
	public function before(){
		$article = Model::factory('article');
		
		$data = $article->single_using_slug('about');
		
		foreach($data as $val){
			$this->id = $val['id'];
		}
		
		parent::before();
	}
	
	//overwrite parent functions
	public function action_index(){}
	public function action_add(){}
	public function action_delete($id = NULL){}
}