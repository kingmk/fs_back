<?php
include_once './common.php';
include_once './RSAHelper.php';



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

function getRecruits($params) {
	$conn = getDBConn();
	$sql = "SELECT id, usr_id, name, create_time, contact_mobile, contact_qq, contact_weixin, audit_status, audit_time FROM fs_master_info";
	$conds = array();
	$audit_status = getStringParam($params, "audit_status", "");
	$date_start = getStringParam($params, "date_start", "");
	$date_end = getStringParam($params, "date_end", "");
	$curpage = getIntParam($params, "curpage", 0);
	$pagesize = getIntParam($params, "pagesize", 10);
	$start = $curpage*$pagesize;
	if (strlen($audit_status) > 0) {
		array_push($conds, "audit_status='".$audit_status."'");
	}
	if (strlen($date_start) > 0) {
		array_push($conds, "create_time>='".$date_start."'");
	}
	if (strlen($date_end) > 0) {
		array_push($conds, "create_time<='".$date_end."'");
	}
	if (count($conds)>0) {
		$sql = $sql." WHERE ".implode(" AND ", $conds);
	}
	$sql = $sql." ORDER BY create_time DESC LIMIT ".$start.", ".$pagesize;

	$result = mysql_query($sql);
	$recruitList = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		array_push($recruitList, $row);
	}

	$sql = "SELECT count(*) as total FROM fs_master_info";
	if (count($conds)>0) {
		$sql = $sql." WHERE ".implode(" AND ", $conds);
	}

	$result = mysql_query($sql);
	$tmp = mysql_fetch_array($result);
	$total = $tmp["total"];
	mysql_close($conn);

	$response = array("total"=>$total, "list"=>$recruitList, "code"=>"00");

	echo urldecode(json_encode($response));
}

function recruitDetailTest($params) {
	$mock = '{"code":"00","recruit":{"id":"100016","usr_id":"100133","wx_open_id":"oCpYx1KTGB6TBjLT5wLUbXZkKJ8Y","audit_status":"ing","audit_time":null,"audit_word":null,"service_status":"NOTING","name":"\u82cf\u5dcd","nick_name":null,"english_name":null,"sex":"M","cert_type":"0","cert_no":"510124198104270033","cert_img1_url":"http:\/\/leimenyi.com.cn\/filedata0\/audit\/201707\/24\/dcd9f99a8f804f3e932312259de96dc2.jpg","cert_img2_url":"http:\/\/leimenyi.com.cn\/filedata0\/audit\/201707\/24\/ece58a3ce26243bea8a6ddafb5c1d9ce.jpg","head_img_url":null,"birth_year":"1981","birth_date":"0427","live_address":"\u56db\u5ddd\u7701 \u6210\u90fd\u5e02","contact_mobile":"13980833565","contact_qq":"","contact_weixin":"sulaowei","school":"","experience":"","achievement":"","good_at":"\u547d\u7406\u516b\u5b57\uff0c\u7384\u7a7a\u98ce\u6c34\uff0c\u5947\u95e8\u9041\u7532","profession":"","work_date":null,"is_full_time":null,"is_sign_other":"N","create_time":"2017-07-24 20:57:47","update_time":"2017-07-24 20:57:47"}}';

	$response = json_decode($mock);
	echo urldecode(json_encode($response));
}

function recruitDetail($params){
	$conn = getDBConn();
	$id = getIntParam($params, "id", -1);
	$sql = "SELECT * FROM fs_master_info WHERE id=".$id;
	$result = mysql_query($sql);
	$recruit = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_close($conn);

	$response = array("code"=>"00", "recruit"=>$recruit);
	echo urldecode(json_encode($response));
}

function auditRecruit($params) {

	$id = getIntParam($params, "id", -1);
	$status = getStringParam($params, "status", "");
	$reason = getStringParam($params, "reason", "");



	$response = array("code"=>"00");
	if ($id == -1 || $status == "" || ($status != "approved" && $status != "refuse")) {
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

	$callParams = array("method"=>"master_apply_audit", "masterInfoId"=>$id, "auditStatus"=>$status, "auditWord"=>$reason, "reqTime"=>time()*1000);
	$pu_key_str = file_get_contents(dirname(__FILE__).'/rsa_public_key.pem');

	$cipher = new RSAHelper();
	$cipher->initKey(null, $pu_key_str, 2048);
	$encryptedText = $cipher->encrypt(json_encode($callParams));

	// $pu_key = openssl_pkey_get_public($pu_key_str);
	// $encryptedText = null;
	// openssl_public_encrypt(json_encode($callParams),$encryptedText,$pu_key);
	// $encryptedText = base64_encode($encryptedText);
	// $response["etext"] = $encryptedText;

	// echo urldecode(json_encode($response));

	// return;

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