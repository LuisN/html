<?
class Login_Controller extends Base_Controller{
	public function action_index(){
		if(!Input::has('usr') || !Input::has('pwd')){
			return false;
		}
		$u = DB::table("users")->where("username","=",Input::get('usr'))->where("password","=",Input::get('pwd'))->first();
		
		Session::put('user',array('id'=>$u->uid,'user'=>$u->username,'nick'=>$u->username,'pwd'=>$u->password,'fbid'=>$u->fbid));
		return Redirect::to('home');
	}
}