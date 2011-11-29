<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Page extends Controller_Admin_Article{//**********************implements******************/
	protected $fields = array('title' => array('required'),
							'slug' => array('required'),
							'copy' => array('required'));
	protected $pageTitle = 'Page';
	protected $URLType = 'page';
}