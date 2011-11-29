<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Core extends Controller_Admin_Template{
	public function before(){
		$this->session_authenticate();
		$this->session_expiry();
		parent::before();
	}
	
	private function session_authenticate(){
		//login session init var
		$init = Session::instance()->get('init');
		//current session var
		$current = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . Session::instance()->id();
		
		//if session init not declared
		//or current session vals dont match init session
		//or user is not logged in
		//redirect to login
		if(empty($init) || $init != $current || !Auth::instance()->logged_in()){
			$this->request->redirect(URL::site('admin/login', TRUE, FALSE));
		}
	}
	
	private function session_expiry(){
		if(is_null(Session::instance()->get('last-activity'))){
			$earlier = time();
		} else {
			$earlier = Session::instance()->get('last-activity');
		}
		
		$now = time();
		
		$timeout = defined('SESSION_TIMEOUT') ? SESSION_TIMEOUT : 300;
		
		if($now - $earlier > $timeout){
			$this->request->redirect(URL::site('admin/login', TRUE, FALSE));
		}
		
		Session::instance()->bind('last-activity', $now);
	}
	
	public function after(){
		//update and store users browsing history in session
		$this->history_handler();
		//checks if a back button has been clicked and redirects based on the history
		$this->back();
		//create the master template layout
		$this->layout();
		
		parent::after();
	}
	
	public function back(){
		if(isset($_POST['back'])){
			$history = (array)unserialize(Session::instance()->get('history'));
			
			//set pointer to last element
			end($history);
			
			//redirect to second last element
			$this->request->redirect(URL::site(prev($history), TRUE, FALSE));
		}
	}
	
	public function layout(){
		$url = URL::site('admin/', FALSE, FALSE);
		
		$menu = View::factory('admin/menu')
				->bind('url', $url);
		
		$this->template->menu = $menu->render();
		
		$header = View::factory('admin/header');
		
		$this->template->header = $header->render();
	}
	
	public function history_handler(){
		//session history var not declared yet
		if(is_null(Session::instance()->get('history'))){
			$history = array();
		} else {
			//get existing session history var and unserialize
			$history = (array)unserialize(Session::instance()->get('history'));
		}
		
		//current URL
		$url = $this->request->uri();
		
		//push current URL onto end of session history var
		if(end($history) != $url){
			array_push($history, $url);
		}
		
		//check if history levels const is defined, if not set to 10 levels
		$session_history = defined('SESSION_HISTORY') ? SESSION_HISTORY : 10;
		
		//if current levels exceeds limit shift first array element
		if(count($history) > $session_history){
			array_shift($history);
		}
		
		//serialize array to store in session var
		$history = serialize($history);
		
		Session::instance()->bind('history', $history);
	}
}