<?
	class Page{
		function start(){
			 Session::put("hash",md5(uniqid(true)));
		}
//$_SESSION['user']=array("uid"=>1,"nickname"=>"Iku","username"=>"Ikuto","birthday","bio","fbid");
//require_once("inc/adodb.inc.php");
//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//require_once("inc/connection.php");
//require_once("inc/DataCore.inc.php");
//$DataCore = new DataCore($config);
//$DataCore->getSearch("Accel World");
}