<?php

// for test
define("DB_HOST_ADDR", "fs_db", true);
define("DB_USERNAME", "root", true);
define("DB_PASSWORD", "111111", true);
define("DB_SCHEMA", "fs_dev", true);
define("SERVER_HOST", "http://10.10.17.188:8091", true);
// define("SERVER_HOST", "http://10.10.19.64:8080", true);

// for online
// define("DB_HOST_ADDR", "106.14.203.236", true);
// define("DB_USERNAME", "fs_pro001", true);
// define("DB_PASSWORD", "webaDmin%)0519FJkd", true);
// define("DB_SCHEMA", "fs_pro", true);
// define("SERVER_HOST", "http://127.0.0.1:8080", true);

define("RSA_PUBLIC", '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApvtjv3+QtpKN2L5RVMCF
TPPEOlVzz6bhJc7qrnXksOqaueLN4AvBQzH6a8KptC5Qzm4u2ZYmCUJGWTTcR3D/
CD0/noblUZI8IcM1gSBJybKaysR/9iQReMftubHIzNmnL+WU/bWu7X96nXemO547
pPDZo+FR3qwmXaVall8nX2oe4BUeyUwomqVNjfkyT/L6czlk42aKQhY4iC5LKrRR
/JbTH3+pqQYKBGi3cHy5uMxZIE77iW4IWUbeUK6q8upAy4fcgWVZfYjg5KjrRTrH
QhrVuw0mjO7CoHw00y6Bi+Y6m6TnvsDWLj3R2W0u9t1/M7pHh3DlHBE2MDwnKIS0
zwIDAQAB
-----END PUBLIC KEY-----', true);


//http://10.10.17.188:8091/usr/search/master_detail?masterInfoId=100013

date_default_timezone_set("PRC");

function hasLogin() {
	if (!session_id()) session_start();
	if (!isset($_SESSION["login_admin"])) {
		return false;
	}
	$admin = $_SESSION["login_admin"];
	$last_access_timestamp = getIntParam($admin, "last_access_timestamp", 0);
	$now_access_timestamp = time();
	if ($now_access_timestamp - $last_access_timestamp > 7200) {
		unset($_SESSION["login_admin"]);
		return false;
	} else {
		$admin["last_access_timestamp"] = $now_access_timestamp;
		$_SESSION["login_admin"] = $admin;
	}
	return true;
}

function getDBConn() {
	$conn = mysql_connect(DB_HOST_ADDR, DB_USERNAME, DB_PASSWORD);
	mysql_query("set names 'utf8'");
	mysql_select_db(DB_SCHEMA, $conn);
	return $conn;
}

function getBoolParam($params, $key, $default) {
	if (!array_key_exists($key, $params)) {
		return $default;
	}
	$v = $params[$key];
	if ($v == "true") {
		return true;
	} else {
		return false;
	}
}

function getIntParam($params, $key, $default) {
	if (!array_key_exists($key, $params)) {
		return $default;
	}

	try {
		$v = intval($params[$key], 10);
	} catch(Exception $e) {
		$v = $default;
	}
	return $v;
}

function getStringParam($params, $key, $default) {
	if (!array_key_exists($key, $params)) {
		return $default;
	}

	return $params[$key];
}

function httpPost($url, $postData) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/plain', 'Content-length: '.strlen($postData)));
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


?>