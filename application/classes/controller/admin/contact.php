<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Contact extends Controller_Admin_Article{//**********************implements******************/
	protected $fields = array('title' => array('required'),
							'slug' => array('readonly'),
							'copy' => NULL);
	protected $pageTitle = 'Contact';
	
	public function before(){
		$article = Model::factory('article');
		
		$data = $article->single_using_slug('contact');
		
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