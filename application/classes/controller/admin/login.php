<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Login extends Controller_Admin_Template{
	public function action_index(){
		$loginView = View::factory('admin/login')
				->bind('error', $error);
		
		$user = Auth::instance();
		
		//kill current session even if the user is logged in
		if($user->logged_in()){
			$user->logout(TRUE, TRUE);
		}
		
		if(isset($_POST['login'])){
			Security::clean_post_data();
			
			if($user->login($_POST['username'], $_POST['password'])){
				//create session init var with current session vals
				$init = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . Session::instance()->id();
				Session::instance()->bind('init', $init);
				
				$this->request->redirect(URL::site('admin/dashboard', TRUE, FALSE));
			} else {
				//login failure
				$error = 'Invalid username or password';
			}
		}
		
		$this->template->content = $loginView->render();
	}
}