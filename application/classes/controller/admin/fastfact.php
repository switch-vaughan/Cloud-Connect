<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_FastFact extends Controller_Admin_Article{//**********************implements******************/
	protected $fields = array('title' => array('required'),
							'slug' => array('required'),
							'copy' => array('required'));
	protected $pageTitle = 'Fast Fact';
	protected $URLType = 'fastfact';
	
	public function before(){
		$article = Model::factory('article');
		
		$data = $article->single_using_slug('fast-fact');
		
		foreach($data as $val){
			$this->parentID = $val['id'];
		}
		
		parent::before();
	}
}