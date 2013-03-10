<?
class DataCore{ 
	private $db;
	function __construct($config){
		$this->db = &ADONewConnection('mysql');
		$this->db->Connect($config[0],$config[1],$config[2],$config[3]);
		if($this->db->isConnected()){
			$this->db->debug=empty($_GET['debug']) ? false : true;
			$this->db->ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		}else{
			die("Conexion a la Base de datos Fallida");
		}
	}
	public function getUserdata($uid){
		$sql="SELECT uid,nickname,username,birthday,bio,fbid FROM bl_users WHERE uid=?";
		$rtn=$this->db->GetRow($sql,$uid);
		return $rtn;
	}
	public function getSearch($term){
		$sql="SELECT * FROM bl_animelist WHERE title LIKE ?";
		return $this->db->GetRow($sql,array("%$term"));
	}
}
?>