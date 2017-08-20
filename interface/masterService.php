<?php
include_once './common.php';
include_once './dataUtils.php';
if (!hasLogin()) {
	$response = array("code"=>"99");
	echo urldecode(json_encode($response));
	exit;
}

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

function getMasters($params) {
	$conn = getDBConn();

	$sql = "SELECT id, usr_id, service_status, name, nick_name, sex, contact_mobile, is_full_time, is_sign_other FROM fs_master_info WHERE audit_status='approved'";
	$masterTmpList = array();
	$idList = array();
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($masterTmpList, $row);
		array_push($idList, $row["usr_id"]);
	}

	if (count($masterTmpList) == 0) {
		$response = array("code"=>"00", "masters"=>array());
		echo urldecode(json_encode($response));
		return;
	}

	$orderStatMap = MasterUtils::getOrderStatisticsByMasters($idList, $conn);
	$followMap = MasterUtils::getFollowByMasters($idList, $conn);
	$serviceMap = MasterUtils::getServiceByMasters($idList, $conn);
	$evaluateMap = MasterUtils::getEvaluatesByMasters($idList, $conn);
	$masterList = array();
	for ($i=0; $i < count($masterTmpList); $i++) { 
		$master = $masterTmpList[$i];
		if (isset($orderStatMap[$master["usr_id"]])) {
			$orderStat = $orderStatMap[$master["usr_id"]];
			$master["order_total"] = $orderStat["order_total"];
			$master["service_fee"] = $orderStat;
		} else {
			$master["order_total"] = 0;
			$master["service_fee"] = null;

		}

		if (isset($followMap[$master["usr_id"]])) {
			$master["follows"] = $followMap[$master["usr_id"]];
		} else {
			$master["follows"] = array();
		}

		if (isset($serviceMap[$master["usr_id"]])) {
			$master["services"] = $serviceMap[$master["usr_id"]];
		} else {
			$master["services"] = array();
		}

		if (isset($evaluateMap[$master["usr_id"]])) {
			$master["evaluate"] = $evaluateMap[$master["usr_id"]];
		} else {
			$master["evaluate"] = null;
		}
		array_push($masterList, $master);
	}


	mysql_close($conn);

	$response = array("code"=>"00", "list"=>$masterList);
	// $response = array("code"=>"00", "list"=>array());
	echo urldecode(json_encode($response));
}

function masterDetail($params) {
	$conn = getDBConn();
	$id = getIntParam($params, "id", -1);
	$sql = "SELECT * FROM fs_master_info WHERE id=".$id;
	$result = mysql_query($sql);
	$master = mysql_fetch_array($result, MYSQL_ASSOC);
	$idList = array($master["usr_id"]);

	$orderStatMap = MasterUtils::getOrderStatisticsByMasters($idList, $conn);
	$serviceMap = MasterUtils::getServiceByMasters($idList, $conn);
	$evaluateMap = MasterUtils::getEvaluatesByMasters($idList, $conn);

	if (isset($orderStatMap[$master["usr_id"]])) {
		$orderStat = $orderStatMap[$master["usr_id"]];
		$master["order_total"] = $orderStat["order_total"];
		$master["service_fee"] = $orderStat;
	} else {
		$master["order_total"] = 0;
		$master["service_fee"] = null;

	}

	if (isset($serviceMap[$master["usr_id"]])) {
		$master["services"] = $serviceMap[$master["usr_id"]];
	} else {
		$master["services"] = array();
	}

	if (isset($evaluateMap[$master["usr_id"]])) {
		$master["evaluate"] = $evaluateMap[$master["usr_id"]];
	} else {
		$master["evaluate"] = null;
	}

	mysql_close($conn);
	$response = array("code"=>"00", "master"=>$master);
	echo urldecode(json_encode($response));
}

function updateMaster($params) {
	$conn = getDBConn();
	$id = getIntParam($params, "id", -1);
	$keys = array("nick_name", "sex", "contact_mobile", "contact_qq", "contact_weixin", "work_date", "live_address", "school", "experience", "achievement", "good_at", "profession", "is_full_time", "is_sign_other");
	$strs = array();
	for ($i=0; $i <count($keys) ; $i++) {
		array_push($strs, "".$keys[$i]." = '".$params[$keys[$i]]."'");
	}
	$sql = "UPDATE fs_master_info SET ".implode(",", $strs)."WHERE id=".$id;
	error_log($sql);

	$result = mysql_query($sql);

	mysql_close($conn);
	$response = array("code"=>"00", "masterup"=>$params);
	echo urldecode(json_encode($response));
}

function updateMasterService($params) {
	$masterid = getIntParam($params, "masterid", -1);
	$usrid = getIntParam($params, "usrid", -1);
	$cateid = getIntParam($params, "cateid", -1);
	$catename = getStringParam($params, "catename", "");
	$type = getStringParam($params, "type", "");
	$amt = getStringParam($params, "amt", "");
	$status = getStringParam($params, "status", "");
	$is_plat_recomm = getStringParam($params, "is_plat_recomm", "");
	// error_log(json_encode($params));
	if ($masterid == -1 || $usrid == -1 || $cateid == -1 || $catename == "" || $type == "" || $amt == "" || $status == "" || $is_plat_recomm == "") {
		$response = array("code"=>"10", "errmsg"=>"参数错误，请刷新后尝试");
		echo urldecode(json_encode($response));
		return;
	}

	$conn = getDBConn();
	$sql = "";
	$now = date("Y-m-d H:i:s");

	if ($type == "update") {
		$sql = "UPDATE fs_master_service_cate SET is_plat_recomm='".$is_plat_recomm."', status='".$status."', amt=".$amt.", update_time='".$now."'";
		// if ($is_plat_recomm == "Y") {
		// 	$sql = $sql.", plat_recomm_time='".$now."'";
		// } else {
		// 	$sql = $sql.", plat_recomm_time=null";
		// }
		$sql = $sql." WHERE fs_zx_cate_id=".$cateid." AND fs_master_info_id=".$masterid;
	} else if ($type == "create") {
		$sql = "INSERT INTO fs_master_service_cate (usr_id, fs_master_info_id, fs_zx_cate_id, name, is_plat_recomm, status, amt, create_time) VALUES('".$usrid."','".$masterid."','".$cateid."','".$catename."','".$is_plat_recomm."', '".$status."', ".$amt.", '".$now."')";
	}
	$result = mysql_query($sql);
	mysql_close($conn);
	$response = array("code"=>"00", "service"=>$params);
	echo urldecode(json_encode($response));

}

function getAllCates($params) {
	$conn = getDBConn();
	$sql = "SELECT id, name, level FROM fs_zx_cate WHERE level=2 AND status='EFFECT' ORDER BY id ASC";
	$result = mysql_query($sql);
	$cateList = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($cateList, $row);
	}
	mysql_close($conn);
	$response = array("code"=>"00", "cates"=>$cateList);
	echo urldecode(json_encode($response));

}

function test() {
	// $conn = getDBConn();
	// $usrIds = array(100005, 100004);
	// $rlt = MasterUtils::getServiceByMasters($usrIds, $conn);
	$date = date("Y-m-d H:i:s");

	echo urldecode($date);
}



?>