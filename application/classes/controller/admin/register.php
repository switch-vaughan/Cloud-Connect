<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Register extends Controller{
	public function action_index(){
		$view = View::factory('admin/login')
				->bind('register', TRUE);
		
		$user = ORM::factory('user');
		$user->email = "qwe@qwe.qwe";
		$user->username = "qweqwe";
		$user->password = "qweqweqwe";
		$user->save();
		
		/*foreach($_POST as $key => $val){
			echo $key .' : ' . $val . '<br>';
		}
		
		if(isset($_POST['submit'])){
			try{
				//$user = ORM::Factory('user')->create_user($_POST, array('username', 'password', 'email'));
				
				$user = ORM::factory('user');
				
				$user->email = "qwe@qwe.qwe";
				
				#Note that the username cannot contain
				#certain characters such as"." or "@".
				#If it does "$client->save()" is going
				#to crash, and the error message is not
				#helpful
				$user->username = "qweqwe";
				
				$user->password = "qweqweqwe";
				
				$user->add('roles', ORM::factory('role', array('name' => 'login')));
				
				$user->save();
			} catch(ORM_Validation_Exception $errors){
				var_dump($errors->errors('model'));
				
				#foreach($errors->errors('model') as $val){
				#	var_dump($val) . '<br>';
				#}
			}
		}*/
		
		$this->response->body($view->render());
	}
}