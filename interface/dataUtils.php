<?php

class UserUtils {
	public static function getUsersByIds($userIds, $conn) {
		$sql = "SELECT id, real_name, nick_name, register_mobile, sex FROM fs_usr WHERE id in (".implode(",", $userIds).")";
		$result = mysql_query($sql,$conn);
		$userIdMap = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$userIdMap[$row["id"]] = $row;
		}
		return $userIdMap;
	}

	public static function getUserIdByName($name, $usr_cate, $conn) {
		$sql = "SELECT id FROM fs_usr WHERE (real_name='".$name."' OR nick_name='".$name."') AND usr_cate='".$usr_cate."'";
		$result = mysql_query($sql, $conn);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if ($row) {
			return $row["id"];
		} else {
			return -1;
		}
	}
}

class OrderUtils {

	public static function mergeOrderUsers($order, $userIdMap) {
		$order["buy_usr_name"] = $userIdMap[$order["buy_usr_id"]]["real_name"];
		$order["buy_usr_mobile"] = $userIdMap[$order["buy_usr_id"]]["register_mobile"];
		$order["seller_usr_name"] = $userIdMap[$order["seller_usr_id"]]["real_name"];
		$order["seller_usr_nickname"] = $userIdMap[$order["seller_usr_id"]]["nick_name"];
		return $order;
	}


	public static function countRefundApplied($conn) {
		$sql = "SELECT count(*) as total FROM fs_order WHERE status='refund_applied'";
		$result = mysql_query($sql, $conn);
		$tmp = mysql_fetch_array($result);
		$total = $tmp["total"];
		return $total;
	}

	public static function getEvaluatesByOrders($orderIds, $conn) {

		$evaluateMap = array();
		if (count($orderIds) >0) {
			$sql = "SELECT id, order_id, status, resp_speed, major_level, service_attitude, create_time, evaluate_word FROM fs_order_evaluate WHERE order_id in (".implode(",", $orderIds).")";
			$result = mysql_query($sql,$conn);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$order_id = $row["order_id"];
				$evaluateMap[$order_id] = $row;
			}

		}

		return $evaluateMap;
	}
}

class MasterUtils {
	public static function getMastersByUserIds($usrIds, $conn) {
		$masterMap = array();
		if (count($usrIds) > 0) {
			$sql = "SELECT * FROM fs_master_info WHERE usr_id IN (".implode(",", $usrIds).")";
			$result = mysql_query($sql,$conn);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$usr_id = $row["usr_id"];
				$masterMap[$usr_id] = $row;
			}
		}
		return $masterMap;
	}

	public static function getServiceByMasters($usrIds, $conn) {
		$sql = "SELECT usr_id, fs_master_info_id, fs_zx_cate_id, name, is_plat_recomm, status, amt FROM fs_master_service_cate WHERE usr_id in (".implode(",", $usrIds).") ORDER BY fs_master_info_id, create_time ASC, fs_zx_cate_id ASC";
		$result = mysql_query($sql,$conn);
		$idServiceMap = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$tmpList = null;
			if (isset($idServiceMap[$row["usr_id"]])) {
				$tmpList = $idServiceMap[$row["usr_id"]];
			} else {
				$tmpList = array();
			}
			array_push($tmpList, $row);
			$idServiceMap[$row["usr_id"]] = $tmpList;
		}
		return $idServiceMap;
	}

	public static function getOrderStatisticsByMasters($usrIds, $conn) {
		$sql = "SELECT seller_usr_id, status, count(*) as order_count, sum(pay_rmb_amt) as service_fee FROM fs_order WHERE seller_usr_id IN (".implode(",", $usrIds).") AND status != 'init' AND status != 'close' AND status != 'pay_fail' GROUP BY seller_usr_id, status";
		$result = mysql_query($sql,$conn);
		$idStatisticsMap = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$tmpObj = null;
			if (isset($idStatisticsMap[$row["seller_usr_id"]])) {
				$tmpObj = $idStatisticsMap[$row["seller_usr_id"]];
			} else {
				$tmpObj = array();
			}
			$tmpObj[$row["status"]] = array("order_count"=>$row["order_count"], "service_fee"=>$row["service_fee"]);
			if (isset($tmpObj["order_total"])) {
				$tmpObj["order_total"] = $tmpObj["order_total"]+$row["order_count"];
			} else {
				$tmpObj["order_total"] = $row["order_count"];
			}
			$idStatisticsMap[$row["seller_usr_id"]] = $tmpObj;
		}
		return $idStatisticsMap;
	}

	public static function getEvaluatesByMasters($usrIds, $conn) {
		$sql = "SELECT seller_usr_id, AVG(resp_speed) as avg_resp_speed, AVG(major_level) as avg_major_level, AVG(service_attitude) as avg_service_attitude FROM fs_order_evaluate WHERE seller_usr_id in (".implode(",", $usrIds).") GROUP BY seller_usr_id";
		$result = mysql_query($sql,$conn);
		$idEvaluatesMap = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$tmpEvaluate["avg_resp_speed"] = (float)$row["avg_resp_speed"];
			$tmpEvaluate["avg_major_level"] = (float)$row["avg_major_level"];
			$tmpEvaluate["avg_service_attitude"] = (float)$row["avg_service_attitude"];
			$tmpEvaluate["avg_com"] = ((float)$tmpEvaluate["avg_resp_speed"]+(float)$tmpEvaluate["avg_major_level"]+(float)$tmpEvaluate["avg_service_attitude"])/3.0;
			$idEvaluatesMap[$row["seller_usr_id"]] = $tmpEvaluate;
		}
		return $idEvaluatesMap;
	}

	public static function getFollowByMasters($usrIds, $conn) {
		$sql = "SELECT focus_usr_id, count(*) as follow_count FROM fs_master_fans WHERE focus_usr_id in (".implode(",", $usrIds).") AND status='followed' GROUP BY focus_usr_id";
		$result = mysql_query($sql,$conn);
		$idFollowMap = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$idFollowMap[$row["focus_usr_id"]] = array("follow_count"=>$row["follow_count"]);
		}
		return $idFollowMap;
	}
}

?>