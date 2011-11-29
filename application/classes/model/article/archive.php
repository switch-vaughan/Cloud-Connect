<?php defined('SYSPATH') or die('No direct script access.');
class Model_Article_Archive extends ORM{
	public function single_save($id = NULL, $vars = array()){
		$query = DB::query(Database::INSERT, 'INSERT INTO article_archives (title, slug, copy, sticky) VALUES (:title, :slug, :copy, :sticky)')
				->param(':title', $vars['title'])
				->param(':slug', $vars['slug'])
				->param(':copy', $vars['copy'])
				->param(':sticky', $vars['sticky']);
		
		$result = $query->execute();
		
		return $result;
	}
}