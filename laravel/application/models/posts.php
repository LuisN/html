<?
class Posts extends Eloquent{ 
	public static $table = 'post';
	public static function get($limit=10){
		$posts=Posts::all("LIMIT","=",$limit);
		return array("posts"=>$posts);
	}
}
