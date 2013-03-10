<?
class Connect_Controller extends Base_Controller{
	public function action_index(){
		header("Content-Type: application/json",true,200);
		if(/*Session::get('hash')!==Input::get('hash')*/false) {
			return json_encode(array('code'=>301));
		}
		if(!Request::ajax()){
			return json_encode(array('code'=>403));
		}
		$u=User::or_where('email','=',Input::get('e'))->or_where('fbid','=',Input::get('id'))->first();
		if($u){
			Session::put('user',array('user'=>$u->to_array(),"accessToken"=>Input::get('accessToken')));
			return json_encode(array('code'=>200,Session::get('user')));
		}
		return json_encode(array('code'=>301));
	}
}