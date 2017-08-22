var FsApi = function() {
	// for online
	// this.host = "/interface";
	this.loginUrl = "/login.html";
	this.serverhost = "http://leimenyi.com.cn/"

	// for test
	this.host = "/fs_back/interface";
	// this.serverhost = "http://haozhao.xicp.net/";
	// this.loginUrl = "/fs_back/login.html";
	this.apiCall = function(path, type, params, callback) {
		var self = this;
		$.ajax({
			url: this.host+"/"+path,
			type: type,
			data: params,
			dataType: "json",
			success: function(data) {
				if (data.code == "99") {
					// need login
					alert("当前未登录，请先登录");
					window.parent.location.href = self.loginUrl+"?back_url="+encodeURIComponent(window.parent.location.href);
					return;
				};
				if (typeof(callback) == "function") {
					callback(data);
				};
			}
		})
	}

	this.searchRecruits = function(params, callback) {
		params.method = "getRecruits";
		this.apiCall("recruitService.php", "GET", params, callback);
	}

	this.recruitDetail = function(params, callback) {
		params.method = "recruitDetail";
		this.apiCall("recruitService.php", "GET", params, callback);
	}

	this.auditRecruit = function(params, callback) {
		params.method = "auditRecruit";
		this.apiCall("recruitService.php", "POST", params, callback);
	}

	this.searchMasters = function(params, callback) {
		params.method = "getMasters";
		this.apiCall("masterService.php", "GET", params, callback);
	}

	this.masterDetail = function(params, callback) {
		params.method = "masterDetail";
		this.apiCall("masterService.php", "GET", params, callback);
	}

	this.updateMaster = function(params, callback) {
		params.method = "updateMaster";
		this.apiCall("masterService.php", "POST", params, callback);
	}

	this.updateMasterService = function(params, callback) {
		params.method = "updateMasterService";
		this.apiCall("masterService.php", "POST", params, callback);
	}

	this.searchConsultOrders = function(params, callback) {
		params.method = "getConsultOrders";
		this.apiCall("orderService.php", "GET", params, callback);
	}

	this.countRefundOrder = function(params, callback) {
		params.method = "countRefundOrder";
		this.apiCall("orderService.php", "GET", params, callback);
	}

	this.orderDetail = function(params, callback) {
		params.method = "orderDetail";
		this.apiCall("orderService.php", "GET", params, callback);
	}

	this.updateOrderEvaluate = function(params, callback) {
		params.method = "updateOrderEvaluate";
		this.apiCall("orderService.php", "POST", params, callback);
	}

	this.deleteOrderEvaluate = function(params, callback) {
		params.method = "deleteOrderEvaluate";
		this.apiCall("orderService.php", "POST", params, callback);
	}

	this.auditRefund = function(params, callback) {
		params.method = "auditRefund";
		this.apiCall("orderService.php", "POST", params, callback);
	}

	this.getUnsettledBills = function(params, callback) {
		params.method = "getUnsettledBills";
		this.apiCall("billService.php", "GET", params, callback);
	}

	this.getSettledBills = function(params, callback) {
		params.method = "getSettledBills";
		this.apiCall("billService.php", "GET", params, callback);
	}

	this.billDetail = function(params, callback) {
		params.method = "billDetail";
		this.apiCall("billService.php", "GET", params, callback);
	}

	this.loginAdmin = function(params, callback) {
		params.method = "loginAdmin";
		this.apiCall("adminService.php", "POST", params, callback);
	}

	this.logoutAdmin = function(callback) {
		var params = {};
		params.method = "logoutAdmin";
		this.apiCall("adminService.php", "POST", params, callback);
	}

	this.getAdmin = function(callback) {
		var params = {};
		params.method = "getAdmin";
		this.apiCall("adminService.php", "POST", params, callback);
	}
}


var fsApi = new FsApi();