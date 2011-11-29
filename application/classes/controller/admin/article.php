<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Article extends Controller_Admin_Core{
	//*************************************if slug is different from submitted even tho title remains changed/unchanged then update it****************************//
	//*************************************get parents childrens children in indexing*****************************************//
	//*************************************is it necessary to have a sticky field in table if "all"? articles with parent_id=0 have controllers?*****************************************//
	//*************************************global message and error????????? bind to view?*****************************************//
	protected $id = NULL;
	protected $parentID = 0;
	protected $view = 'article';
	protected $URLType = 'article';
	protected $pageTitle = 'Article';
	protected $fields = array();
	protected $depthLimit = 2;
	protected $articles = array();
	private $fieldsDefault = array('title' => array('required'),
								'slug' => array('required'),
								'copy' => '');
	
	public function before(){
		//no fields are defined then use default
		if(empty($this->fields)){
			$this->fields = $this->fieldsDefault;
		}
		
		parent::before();
	}
	
	public function action_index(){
		//create view links
		$editURL = URL::site('admin/' . $this->URLType . '/edit', TRUE, FALSE) . '/';
		$addURL = URL::site('admin/' . $this->URLType . '/add', TRUE, FALSE) . '/';
		
		$this->pageTitle .= 's';
		
		//use the plural view
		$view = View::factory('admin/' . $this->view . 's')
				->bind('articles', $articles)
				->bind('pageTitle', $this->pageTitle)
				->bind('editURL', $editURL)
				->bind('addURL', $addURL)
				->bind('edit', $edit);
		
		$articles = $this->catalog();
		
		if($this->parentID != 0){
			$edit = TRUE;
		}
		
		$this->template->content = $view->render();
	}
	
	public function action_add(){
		//define to display save button in view
		$save = TRUE;
		
		$slugAuto = $this->slug_auto();
		
		$view = View::factory('admin/' . $this->view)
				->bind('pageTitle', $this->pageTitle)
				->bind('slugAuto', $slugAuto)
				->bind('articles', $articles)
				->bind('message', $message)
				->bind('save', $save);
		
		$articles = $this->catalog();
		
		//dynamically assign controller specified vars to the view
		foreach($this->fields as $key => $val){
			//POST data exists then assign posted val
			if(isset($_POST[$key])){
				${$key}['val'] = $_POST[$key];
			} else {
				${$key}['val'] = '';
			}
			
			empty($val) ? $val = array() : NULL;
			${$key} = array('readonly' => in_array('readonly', $val), 'val' => ${$key}['val']);
			
			$view->bind($key, ${$key});
		}
		
		if(isset($_POST['save'])){
			$message = $this->save();
		}
		
		$this->template->content = $view->render();
	}
	
	public function action_edit(){//////////////******************************************************sticky article displaying auto create slug!!!!!!!!!!!! musnt because of controller!!!!!!!!!!!!!*********************/
		//define to display update button in view
		$update = TRUE;
		
		$slugAuto = $this->slug_auto();
		
		$view = View::factory('admin/' . $this->view)
					->bind('pageTitle', $this->pageTitle)
					->bind('slugAuto', $slugAuto)
					->bind('articles', $articles)
					->bind('id', $this->id)
					->bind('error', $error)
					->bind('message', $message)
					->bind('update', $update)
					->bind('deletable', $deletable);
		
		//if the child class hasnt defined an ID
		if(is_null($this->id)){
			$urlId = $this->request->param('id');
			
			//read the URL ID
			if(!empty($urlId)){
				$this->id = $this->request->param('id');
			} else {
				//no URL ID defined
				$error = 'Article ID is not defined';
			}
		}
		
		//assign specified fields to view
		foreach($this->fields as $key => $val){
			empty($val) ? $val = array() : NULL;
			${$key} = array('readonly' => (bool)in_array('readonly', $val));//////////////////////////////////////echo in_array('readonly', $val) . '<br>';
			$view->bind($key, ${$key});
		}
		
		//only run if an ID has been defined either through the child class or through the URL
		if(!is_null($this->id)){
			if(isset($_POST['delete'])){
				$message = $this->action_delete($this->id);
			}
			
			if(isset($_POST['update'])){
				//no validation error messages
				if(empty($message)){
					$result = $this->update($this->id);
					
					if((string)strpos($result, '[error]') == ''){
						$message = $result;
					} else {
						$error = str_replace('[error]', '', $result);
					}
				}
			}
			
			$article = ORM::factory('article');
			$data = $article->single($this->id);
			
			//assign values if a DB record was returned
			if(!empty($data)){
				foreach($data as $var){//***********************************************************************************populate POST data back into form instead of db data*****************************/
					$title['val'] = $var['title'];
					$slug['val'] = $var['slug'];
					$copy['val'] = $var['copy'];
					$deletable = !(bool)$var['sticky'];
					$parentID = $var['parent_id'];
				}
			} else {
				//specified article ID doesnt exist
				$error = 'Article ID doesnt exist in DB';
			}
		}
		
		if($deletable){
			$articles = $this->catalog(array($this->id));
		}
		
		$this->template->content = $view->render();
	}
	
	private function update($id = NULL){///************************************setup difference between error and messages on add and update***********************/
		$article = ORM::factory('article');
		
		$error = $this->prepare_input($id);
		
		//update article
		if(empty($error)){
			$result = $article->single_update($id, $_POST);
			
			if($result){
				$this->archive($id);
				$message = ucwords($this->URLType) . ' updated';
			} else {
				$error = ucwords($this->URLType) . ' not updated';
			}
		}
		
		return isset($message) ? $message : '[error]' . $error;
	}
	
	private function save(){
		$result = $this->prepare_input();
		
		$_POST['parent_id'] = $this->parentID;
		
		if(empty($result)){
			$article = ORM::factory('article');
			$result = $article->single_save($_POST);
			
			if(!empty($result)){
				$this->archive($result[0]);
			}
			
			//new article has been saved
			if($result){
				$this->request->redirect(URL::site('admin/' . $this->URLType, TRUE, FALSE));
			}
		}
		
		return isset($result) ? $result : '';
	}
	
	public function action_delete($id = NULL){
		$article = ORM::factory('article');
		
		if($article->single_delete($id)){
			$this->request->redirect(URL::site('admin/' . $this->URLType, TRUE, FALSE));
		}
		
		return 'Unable to delete article with ID "' . $id . '"';
	}
	
	private function catalog($exclude = array()){//******************************include parent in list if not zero?????????***********************//
		$query = Model::factory('article');
		
		$data = $query->catalog_where_parent($this->parentID);
		
		$this->loop_data($data, $exclude);
		
		return $this->articles;
	}
	
	private function loop_data($data = array(), $exclude = array()){
		foreach($data as $key => $val){
			$val = array_merge($val, $this->add_fields($val['id']));
			
			if(!in_array($val['id'], $exclude)){
				array_push($this->articles, $val);
			}
			
			$query = Model::factory('article');
			$data = $query->catalog_where_parent($val['id']);
			
			if(!empty($data)){
				$id = NULL;
				foreach($data as $var){//***********************************************************************************populate POST data back into form instead of db data*****************************/
					$id = $var['id'];
				}
				
				$this->loop_data($data, $exclude);
			}
		}
	}
	
	private function add_fields($id = NULL){
		$data = array();
		
		$data['hierarchy'] = $this->article_hierarchy($id);
		
		//create depth var
		$data['depth'] = count($data['hierarchy']);
		
		return $data;
	}
	
	private function archive($id = NULL){//***************************limit storage to bootstrap defined constant or default**********************/
		//store existing article
		try{
			//retrieve existing article
			$article = ORM::factory('article');
			$data = $article->single($id);
			
			$store = array();
			foreach($data as $var){
				$store['title'] = $var['title'];
				$store['slug'] = $var['slug'];
				$store['copy'] = $var['copy'];
				$store['sticky'] = $var['sticky'];
			}
			
			$archive = ORM::factory('article_archive');
			$archive->single_save($id, $store);
		} catch(ORM_Validation_Exception $errors){}
	}
	
	private function prepare_input($id = NULL){
		if(!array_key_exists('slug', $this->fields) || isset($_POST['slug_auto'])){
			$_POST['slug'] = $_POST['title'];
		}
		
		//make sure all POST vars are defined for DB
		//some fields may not exists if the fields array is defined by a child class
		foreach($this->fieldsDefault as $key => $val){
			if(!isset($_POST[$key])){
				$_POST[$key] = '';
			}
		}
		
		//purify all POST data
		Security::clean_post_data();
		
		//check fields meet requirements
		$error = $this->validate_post_data();
		
		$_POST['slug'] = URL::clean($_POST['slug']);
		
		//check if slug already exists
		if(empty($result)){
			$slug = Model::factory('article_common');
			$error = $slug->slug_in_use($_POST['slug'], $id);//******************turn JS file into PHP so its possible to output the project URL for ajax use****************************/
		}
		
		return $error;
	}
	
	private function validate_post_data(){
		foreach($this->fields as $key => $val){
			empty($val) ? $val = array() : NULL;
			
			if(in_array('required', $val) && empty($_POST[$key])){
				$error = ucwords($key) . ' is required';
				break;
			}
		}
		
		return isset($error) ? $error : '';
	}
	
	private function slug_auto(){
		$result = TRUE;
		
		if(isset($_POST['update']) || isset($_POST['save'])){
			!isset($_POST['slug_auto']) ? $result = NULL : NULL;
		}
		
		return $result;
	}
	
	private function article_hierarchy($id = NULL){
		$hierarchy = array();
		
		$article = Model::factory('article');
		
		while($id != 0){
			$data = $article->single($id);
			
			foreach($data as $var){
				$id = $var['parent_id'];
				array_push($hierarchy, (int)$var['id']);
			}
		}
		
		return $hierarchy;
	}
}