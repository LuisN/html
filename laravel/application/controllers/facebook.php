<?
class Facebook_Controller extends Base_Controller{
	public function action_index(){
		if(Session::has('user') && Input::has('post_id')){
			$u = Session::get('user');
			if($u['user']['fbid']){
				$s= new Social;
				$s->uid=$u['user']['uid'];
				$s->post_id=Input::get('post_id');
				$s->save();
			}
		}
		return "<script>window.close();</script>";
	}
}
?>