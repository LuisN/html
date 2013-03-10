<?
	session_start();
	require_once("inc/adodb.inc.php");
	require_once("inc/connection.php");
	require_once("inc/DataCore.inc.php");
	$DataCore= new DataCore($config);
	$id=$_GET['id'];
	$hash=$_GET['hash'];
	if(!empty($hash) && $hash==$_SESSION['hash']){
		if(!empty($_SESSION['user'])){
			$rs=$DataCore->getUserdata($_SESSION['user']['uid']);
			$return=array("code"=>200,$rs);
		}else{
			$return=array("code"=>301);
		}
	}else{
		$return=array("code"=>403);
	}
	header("Content-Type: application/json");
	echo json_encode($return);
?>