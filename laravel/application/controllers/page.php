<?php

class Page_Controller extends Base_Controller {

	public function action_index($action){	
		$post=Posts::where("urltag",'=',$action)->first();
		return View::make('page.index')->with('post',$post);
	}
	
}