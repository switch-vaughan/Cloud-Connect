<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_User extends Controller_Admin_Core{
	public function action_logout(){
		$this->request->redirect(URL::site('admin/login', TRUE, FALSE));
	}
}