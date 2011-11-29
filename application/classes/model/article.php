<?php defined('SYSPATH') or die('No direct script access.');
class Model_Article extends ORM{
	public function single_using_slug($slug = ''){
		$query = DB::query(Database::SELECT, 'SELECT * FROM articles WHERE slug=:slug')
					->param(':slug', $slug);
		
		$result = $query->execute()->as_array();
		
		return $result;
	}
	
	public function single($id = NULL){
		$query = DB::query(Database::SELECT, 'SELECT * FROM articles WHERE id=:id')
					->param(':id', $id);
		
		$result = $query->execute()->as_array();
		
		return $result;
	}
	
	public function single_update($id = NULL, $vars = array()){
		$query = DB::query(Database::UPDATE, 'UPDATE articles SET title=:title, slug=:slug, copy=:copy WHERE id=:id')
				->param(':id', $id)
				->param(':title', $vars['title'])
				->param(':slug', $vars['slug'])
				->param(':copy', $vars['copy']);
		
		$result = $query->execute();
		
		return $result;
	}
	
	public function single_save($vars = array()){
		$created = date('Y-m-d H:i:s');
		
		$query = DB::query(Database::INSERT, 'INSERT INTO articles (title, slug, copy, parent_id, created) VALUES (:title, :slug, :copy, :parent_id, :created)')
				->param(':title', $vars['title'])
				->param(':slug', $vars['slug'])
				->param(':copy', $vars['copy'])
				->param(':parent_id', $vars['parent_id'])
				->param(':created', $created);
		
		$result = $query->execute();
		
		return $result;
	}
	
	public function single_delete($id = NULL){
		$query = DB::query(Database::DELETE, 'DELETE FROM articles WHERE id=:id')
				->param(':id', $id);
		
		$result = $query->execute();
		
		return $result;
	}
	
	public function catalog(){
		$query = DB::query(Database::SELECT, 'SELECT * FROM articles ORDER BY sequence ASC');
		
		$result = $query->execute()->as_array();
		
		return $result;
	}
	
	public function catalog_where_parent($parent_id = NULL){
		$query = DB::query(Database::SELECT, 'SELECT * FROM articles WHERE parent_id = :parent_id ORDER BY sequence ASC')
					->param(':parent_id', $parent_id);
		
		$result = $query->execute()->as_array();
		
		return $result;
	}
}