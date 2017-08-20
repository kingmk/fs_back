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


function getUnsettledBills($params) {
	$conn = getDBConn();
	$dateToday = date("Y-m-d 23:59:59");
	$sql = "SELECT DATE(settlement_time) AS date,count(*) AS num, sum(pay_rmb_amt) AS pay_sum, sum(settlement_plat_service_fee) AS plat_sum, sum(settlement_master_service_fee) AS master_sum FROM fs_order WHERE status!='refund_applied' AND status!='refunding' AND status!='refunded' AND status!='settlementing' AND status !='settlemented' AND settlement_time <='".$dateToday."'";
	error_log($sql);
	$result = mysql_query($sql);
	$billList = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($row["num"] > 0) {
			array_push($billList, $row);
		} else {
			$row["date"] = date("Y-m-d");
			$row["pay_sum"] = 0;
			$row["plat_sum"] = 0;
			$row["master_sum"] = 0;
			array_push($billList, $row);
		}
		break;
	}

	$sql = "SELECT DATE(settlement_time) AS date,count(*) AS num, sum(pay_rmb_amt) AS pay_sum, sum(settlement_plat_service_fee) AS plat_sum, sum(settlement_master_service_fee) AS master_sum FROM fs_order WHERE status!='refund_applied' AND  status!='refunding' AND status!='refunded' AND settlement_time> '".$dateToday."' GROUP BY settlement_time";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($billList, $row);
	}
	mysql_close($conn);
	$response = array("code"=>"00", "list"=>$billList);
	echo urldecode(json_encode($response));
}


function getSettledBills($params) {
	$conn = getDBConn();
	$dateToday = date("Y-m-d 00:00:00");
	$curpage = getIntParam($params, "curpage", 0);
	$pagesize = getIntParam($params, "pagesize", 10);
	$start = $curpage*$pagesize;

	$sql = "SELECT DATE(settlement_time) AS date,count(*) AS num, sum(pay_rmb_amt) AS pay_sum, sum(settlement_plat_service_fee) AS plat_sum, sum(settlement_master_service_fee) AS master_sum FROM fs_order WHERE (status='settlementing' OR status ='settlemented') AND settlement_time< '".$dateToday."' GROUP BY settlement_time ORDER BY date DESC LIMIT ".$start.", ".$pagesize;
	$billList = array();
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($billList, $row);
	}

	$sql = "SELECT COUNT(DISTINCT settlement_time) as total FROM fs_order WHERE (status='settlementing' OR status ='settlemented') AND settlement_time< '".$dateToday."'";
	$result = mysql_query($sql);
	$total = 0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$total = $row["total"];
	}


	mysql_close($conn);
	$response = array("code"=>"00", "list"=>$billList, "total"=>$total);
	echo urldecode(json_encode($response));
}

function billDetail($params) {
	$conn = getDBConn();
	$date = getStringParam($params, "date", date("Y-m-d"));
	$dateToday = date("Y-m-d");
	$statusStr = "";
	if ($dateToday == $date) {
		$statusStr = "status!='refund_applied' AND status!='refunding' AND status!='refunded' ";
	} else if ($dateToday < $date) {
		$statusStr = "status!='refund_applied' AND status!='refunding' AND status!='refunded' AND status!='settlementing' AND status !='settlemented' ";
	} else {
		$statusStr = "(status='settlementing' OR status ='settlemented') ";
	}

	$sql = "SELECT seller_usr_id, count(*) AS num, sum(pay_rmb_amt) AS pay_sum, sum(settlement_plat_service_fee) AS plat_sum, sum(settlement_master_service_fee) AS master_sum FROM fs_order WHERE ".$statusStr." AND settlement_time='".$date." 22:00:00' GROUP BY seller_usr_id";
	// error_log($sql);
	$usrBillList = array();
	$usrIds = array();
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($usrIds, $row["seller_usr_id"]);
		array_push($usrBillList, $row);
	}

	$masterMap = MasterUtils::getMastersByUserIds($usrIds, $conn);
	for ($i=0; $i <count($usrBillList) ; $i++) { 
		$usrId = $usrBillList[$i]["seller_usr_id"];
		$master = $masterMap[$usrId];
		$usrBillList[$i]["seller_name"] = $master["name"];
		$usrBillList[$i]["seller_nick_name"] = $master["nick_name"];
	}

	mysql_close($conn);
	$response = array("code"=>"00", "list"=>$usrBillList);
	echo urldecode(json_encode($response));
}

?>