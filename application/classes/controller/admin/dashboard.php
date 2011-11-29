<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Dashboard extends Controller_Admin_Core{
	public function action_index(){
		$this->template->content = View::factory('admin/dashboard');
	}
}