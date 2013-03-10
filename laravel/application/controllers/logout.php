<?
class Logout_Controller extends Base_Controller{
	public function action_index(){
		Session::flush();
		return Redirect::to('home');
	}
}