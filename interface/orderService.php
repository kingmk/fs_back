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

function countRefundOrder($params) {
	$conn = getDBConn();
	$total = OrderUtils::countRefundApplied($conn);

	$response = array("code"=>"00", "total"=>$total);
	echo urldecode(json_encode($response));

}

function getConsultOrders($params) {

	$conn = getDBConn();

	$seller_usr_name = getStringParam($params, "seller_usr_name", "");
	$seller_usr_id = -1;
	if (strlen($seller_usr_name) > 0) {
		$seller_usr_id = UserUtils::getUserIdByName($seller_usr_name, "master", $conn);
		if ($seller_usr_id == -1) {
			$response = array("code"=>"00", "total"=>$total, "list"=>array());
			echo urldecode(json_encode($response));
			return;
		}
	}

	$buy_usr_name = getStringParam($params, "buy_usr_name", "");
	$buy_usr_id = -1;
	if (strlen($buy_usr_name) > 0) {
		$buy_usr_id = UserUtils::getUserIdByName($buy_usr_name, "common", $conn);
		if ($buy_usr_id == -1) {
			$response = array("code"=>"00", "total"=>$total, "list"=>array());
			echo urldecode(json_encode($response));
			return;
		}
	}


	$sql = "SELECT id, order_num, buy_usr_id, seller_usr_id, goods_name, begin_chat_time, create_time, pay_confirm_time, end_chat_time, completed_time, pay_rmb_amt, settlement_plat_service_fee, settlement_master_service_fee, status, is_auto_refund, order_extra_info FROM fs_order";

	$conds = array("order_type='zxfw'");
	$goods_name = getStringParam($params, "goods_name", "");
	$create_time_start = getStringParam($params, "create_time_start", "");
	$create_time_end = getStringParam($params, "create_time_end", "");
	$status = getStringParam($params, "status", "");
	if ($seller_usr_id > 0) {
		array_push($conds, "seller_usr_id=".$seller_usr_id."");
	}
	if ($buy_usr_id > 0) {
		array_push($conds, "buy_usr_id=".$buy_usr_id."");
	}
	if (strlen($goods_name) > 0) {
		array_push($conds, "goods_name='".$goods_name."'");
	}
	if (strlen($create_time_start) > 0) {
		array_push($conds, "create_time>='".$create_time_start."'");
	}
	if (strlen($create_time_end) > 0) {
		array_push($conds, "create_time<='".$create_time_end."'");
	}
	if (strlen($status) > 0) {
		if ($status == "default") {
			array_push($conds, "(status='pay_succ' OR status='refund_applied' OR status='refunded' OR status='refunding' OR status='refund_fail' OR status='completed' OR status='settlemented')");
		} else if ($status == "refunded") {
			array_push($conds, "(status='refunded' OR status='refunding')");
		} else if ($status == "refund_fail") {
			array_push($conds, "(status='refund_fail' OR (status='completed' AND refund_confirm_time>0))");
		} else {
			array_push($conds, "status='".$status."'");
		}
	}
	if (count($conds)>0) {
		$sql = $sql." WHERE ".implode(" AND ", $conds);
	}

	$curpage = getIntParam($params, "curpage", 0);
	$pagesize = getIntParam($params, "pagesize", 10);
	$start = $curpage*$pagesize;
	$sql = $sql." ORDER BY create_time DESC LIMIT ".$start.", ".$pagesize;
	error_log($sql);
	$orderTmpList = array();
	$userIds = array();
	$orderIds = array();

	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($orderTmpList, $row);
		if (!in_array($row["buy_usr_id"], $userIds)) {
			array_push($userIds, $row["buy_usr_id"]);
		}
		if (!in_array($row["seller_usr_id"], $userIds)) {
			array_push($userIds, $row["seller_usr_id"]);
		}
		array_push($orderIds, $row["id"]);
	}
	if (count($orderTmpList) == 0) {
		$response = array("code"=>"00", "total"=>0, "list"=>array(), "sum_pay"=>0);
		echo urldecode(json_encode($response));
		return;
	}

	$userIdMap = UserUtils::getUsersByIds($userIds, $conn);
	$evaluateMap = OrderUtils::getEvaluatesByOrders($orderIds, $conn);

	$orderList = array();
	foreach ($orderTmpList as $order) {
		$order = OrderUtils::mergeOrderUsers($order, $userIdMap);
		if (isset($evaluateMap[$order["id"]])) {
			$order["evaluate"] = $evaluateMap[$order["id"]];
		}
		array_push($orderList, $order);
	}


	$sql = "SELECT count(*) as total, sum(pay_rmb_amt) as sum_pay, sum(settlement_plat_service_fee) as sum_plat_fee, sum(settlement_master_service_fee) as sum_master_fee FROM fs_order";
	if (count($conds)>0) {
		$sql = $sql." WHERE ".implode(" AND ", $conds);
	}

	$result = mysql_query($sql);
	$tmp = mysql_fetch_array($result);
	$total = $tmp["total"];
	$sum_pay = $tmp["sum_pay"];
	$sum_plat_fee = $tmp["sum_plat_fee"];
	$sum_master_fee = $tmp["sum_master_fee"];

	mysql_close($conn);

	$response = array("code"=>"00", "list"=>$orderList, "total"=>$total, "sum_pay"=>$sum_pay, "sum_plat_fee"=>$sum_plat_fee, "sum_master_fee"=>$sum_master_fee);

	echo urldecode(json_encode($response));
}

function orderDetail($params) {
	$conn = getDBConn();
	$id = getIntParam($params, "id", -1);
	$sql = "SELECT * FROM fs_order WHERE id=".$id;
	error_log($sql);
	$result = mysql_query($sql);
	$order = mysql_fetch_array($result, MYSQL_ASSOC);

	if (!$order) {
		$response = array("code"=>"00", "order"=>null);
		echo urldecode(json_encode($response));
		return;
	}

	$userIds = array();
	$orderIds = array();
	array_push($userIds, $order["buy_usr_id"]);
	array_push($userIds, $order["seller_usr_id"]);
	array_push($orderIds, $id);
	$userIdMap = UserUtils::getUsersByIds($userIds, $conn);
	$buy_usr = $userIdMap[$order["buy_usr_id"]];
	$seller_usr = $userIdMap[$order["seller_usr_id"]];

	$evaluateMap = OrderUtils::getEvaluatesByOrders($orderIds, $conn);

	$sql = "SELECT id, sent_usr_id, rece_usr_id, order_id, msg_type, is_escape, content, create_time FROM fs_chat_record WHERE order_id=".$id." ORDER BY create_time ASC";
	$result = mysql_query($sql);
	$chats = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($chats, $row);
	}

	$response = array("code"=>"00", "order"=>$order, "buy_usr"=>$buy_usr, "seller_usr"=>$seller_usr, "chats"=>$chats, "evaluate"=>$evaluateMap[$id]);
	echo urldecode(json_encode($response));

	mysql_close($conn);
}

function updateOrderEvaluate($params) {
	$id = getIntParam($params, "id", -1);
	$status = getStringParam($params, "status", "");
	$resp_speed = getIntParam($params, "resp_speed", -1);
	$major_level = getIntParam($params, "major_level", -1);
	$service_attitude = getIntParam($params, "service_attitude", -1);
	$evaluate_word = getStringParam($params, "evaluate_word", "");

	if ($id == -1 || $status == "" || $resp_speed == -1 || $major_level == -1 || service_attitude == -1) {
		$response = array("code"=>"10", "errmsg"=>"参数错误，请刷新后尝试");
		echo urldecode(json_encode($response));
		return;
	}
	$conn = getDBConn();
	$sql = "UPDATE fs_order_evaluate SET status='".$status."', resp_speed=".$resp_speed.", major_level=".$major_level.", service_attitude=".$service_attitude.", evaluate_word='".$evaluate_word."' WHERE id=".$id;
	$result = mysql_query($sql);
	mysql_close($conn);
	$response = array("code"=>"00", "evaluate"=>$params);
	echo urldecode(json_encode($response));

}

function deleteOrderEvaluate($params) {
	$id = getIntParam($params, "id", -1);

	if ($id == -1 ) {
		$response = array("code"=>"10", "errmsg"=>"参数错误，请刷新后尝试");
		echo urldecode(json_encode($response));
		return;
	}

	$conn = getDBConn();
	$sql = "DELETE FROM fs_order_evaluate WHERE id=".$id;
	$result = mysql_query($sql);
	mysql_close($conn);
	$response = array("code"=>"00", "id"=>$id, "sql"=>$sql);
	echo urldecode(json_encode($response));

}

function auditRefund($params) {

	$id = getIntParam($params, "id", -1);
	$isAgree = getStringParam($params, "isAgree", "N");
	$reason = getStringParam($params, "reason", "");

	$response = array("code"=>"00");
	error_log("id:".$id);
	error_log("; isAgree:".$isAgree);
	if ($id == -1 || $isAgree == "" || ($isAgree != "Y" && $isAgree != "N")) {
		$response["code"] = "80";
		$response["msg"] = "系统暂时异常，请刷新后重试";
		echo urldecode(json_encode($response));
		return;
	} else if ($reason == "") {
		$response["code"] = "81";
		$response["msg"] = "理由必须填写";
		echo urldecode(json_encode($response));
		return;
	}

	$callParams = array("method"=>"refund_apply_audit", "orderId"=>$id, "isAgree"=>$isAgree, "refundAuditWord"=>$reason, "reqTime"=>time()*1000);
	$pu_key_str = file_get_contents(dirname(__FILE__).'/rsa_public_key.pem');
	$pu_key = openssl_pkey_get_public($pu_key_str);
	$encryptedText = null;
	openssl_public_encrypt(json_encode($callParams),$encryptedText,$pu_key);
	$encryptedText = base64_encode($encryptedText);
	$url = SERVER_HOST."/admin/audit/api";
	$rlt = httpPost($url, $encryptedText);
	error_log("rlt from server:".$rlt);
	if ($rlt === FALSE) {
		$response["code"] = "10";
		$response["msg"] = "系统异常，请稍后再试";
	} else {
		$jRlt = json_decode($rlt, TRUE);
		if ($jRlt["head"]["code"] == "0000") {
			$response["code"] = "00";
			$response["msg"] = "操作成功";
		} else {
			$response["code"] = "10";
			$response["msg"] = $jRlt["head"]["msg"];
		}
	}
	echo urldecode(json_encode($response));

}


?>