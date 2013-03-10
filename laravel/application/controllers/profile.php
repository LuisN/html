<?php

class Profile_Controller extends Base_Controller {
	public function action_index(){
		$user = DB::table('users')->where('uid','=',Input::get('id'))->first();
		return View::make("profile.index",$user);
	}
	
}