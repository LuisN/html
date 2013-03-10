<?
class Register_Controller extends Base_Controller{
	public function action_index(){
		if(!Input::has('hash')){
			return View::make('register.index');
		}
		$u=Input::all();
		return $u->to_array();
	}
}