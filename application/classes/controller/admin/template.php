<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Template extends Controller_Template{
	public $template = 'admin/template';
	
	public function after(){
		$this->template->url = URL::site('', FALSE, FALSE);
		
		//CONST declared in bootstrap
		$this->template->title = TITLE;
		
		parent::after();
	}
}