<?php defined('SYSPATH') or die('No direct script access.');
class Model_Article_Common extends Model{
	public static function slug_in_use($slug = '', $id = NULL){
		$article = Model::factory('article');
		$slugData = $article->single_using_slug($slug);
		foreach($slugData as $val){ $owned = $val['id']; }
		
		//slug is in use but doesnt belong to current article
		if(isset($owned) && ($owned != $id || is_null($id))){
			$result = 'Slug "' . $slug . '" is already in use by another article';
		}
		
		return isset($result) ? $result : '';
	}
}