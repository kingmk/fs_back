<?php
include_once './common.php';

if (!session_id()) session_start();
parseMethod();

function parseMethod(){
	$httpM = $_SERVER['REQUEST_METHOD'];
	$params = null;
	if ($httpM == 'GET') {
		$params = $_GET;
	} else if($httpM == 'POST') {
		$params = $_POST;
	} else {
		echo 'not supported http method';
		return;
	}
	$method = $params["method"];

	call_user_func($method, $params);

}

function createAdmin($params) {
	$conn = getDBConn();
	$username = getStringParam($params, "username", "");
	$password = getStringParam($params, "password", "");

	$sql = "INSERT INTO fs_admin (username, password) VALUES('".$username."', '".md5($password)."')";

	$result = mysql_query($sql, $conn);
	$response = null;
	if ($result == FALSE) {
		$response = array("code"=>"01");
	} else {
		$id = mysql_insert_id();
		$response = array("code"=>"00", "id"=>$id);
	}
	mysql_close($conn);
	echo urldecode(json_encode($response));
}

function loginAdmin($params){
	$conn = getDBConn();
	$username = getStringParam($params, "username", "");
	$password = getStringParam($params, "password", "");

	$sql = "SELECT id, username, last_login_time FROM fs_admin WHERE username='".$username."' AND password='".$password."'";
	$result = mysql_query($sql);
	error_log($sql);
	$admin = mysql_fetch_array($result, MYSQL_ASSOC);
	$response = null;
	if ($admin == null) {
		$response = array("code"=>"88");
	} else {
		$admin["last_login_time"] = date("Y-m-d H:i:s",time());
		$sql = "UPDATE fs_admin SET last_login_time='".$admin["last_login_time"]."' WHERE id=".$admin["id"];
		$result = mysql_query($sql);

		$admin["last_access_timestamp"] = time();
		$response = array("code"=>"00", "admin"=>$admin);

		$_SESSION["login_admin"] = $admin;

	}
	mysql_close($conn);
	echo urldecode(json_encode($response));

}

function logoutAdmin($params){
	if (isset($_SESSION["login_admin"])) {
		unset($_SESSION["login_admin"]);
	}
	$rlt = array("code"=>"00");
	$returnUrl = getStringParam($params, "returnUrl", "");
	if (strlen($returnUrl) > 0) {
		Header("Location:".$returnUrl); 
	} else {
		echo urldecode(json_encode($rlt));
	}
}

function getAdmin($params) {
	$response = array();
	if (!hasLogin()) {
		$response["code"] = "99";
	} else {
		$admin = $_SESSION["login_admin"];
		$response["code"] = "00";
		$response["admin"] = $admin;
	}
	echo urldecode(json_encode($response));
}

?>