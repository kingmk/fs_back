Date.prototype.format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

String.prototype.endsWith = function(str) {
    var l = str.length;
    if (this.length < l) {
        return false;
    } 
    var strCmp = this.substring(this.length-l);
    if (strCmp == str) {
        return true;
    } else {
        return false;
    }
}

String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/gm,'');
}

String.prototype.isFloat = function() {
    return /^\d+(\.\d+)?$/.test(this);
}

var CommonUtils = function() {
    this.hostname = "/web/"; // for 158
    this.timeout = 30000;
    this.getUrlParamURI = function(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);  
        if (r != null) return decodeURIComponent(r[2]); return null; 
    };

    this.getStringValue = function(jObj, key) {
        var s = "";
        if (jObj && jObj[key]) {
            s = ""+jObj[key];
        }

        return s;
    }

    this.stringNotEmpty = function(str) {
        if (str && typeof(str) == "string") {
            if (str.trim().length>0) {
                return true;
            };
        };
        return false;
    }

    this.getPeriodStr = function(start, end) {
        var s = "";
        if (start.length>0 && end.length>0) {
            s = start+" 至 "+end;
        } else if (start.length>0 && end.length==0) {
            s = "自 "+start+" 起";
        } else if (start.length==0 && end.length>0) {
            s = "至 "+end;
        }
        return s;
    }
    
    this.numberCurrency = function(n){
        var s = n.toString();
        var ss = s.split(".");
        var s1, s2, rs;
        s1 = ss[0];
        s2 = ss[1]?ss[1]:"";
        var sign = "";
        if (s1[0] == "+" || s1[0] == "-") {
            sign = s1[0];
            s1 = s1.substr(1);
        };

        var len=s1.length;
        if(len<=3){
            rs = s1;
        } else {
            var r=len%3;
            rs = r>0?s1.slice(0,r)+","+s1.slice(r,len).match(/\d{3}/g).join(","):s1.slice(r,len).match(/\d{3}/g).join(",");
        }
        if (s2.length>0 || s.indexOf(".") == s.length-1) {
            rs += "."+s2
        };
        if (sign != "") {
            rs = sign+rs;
        };
        return rs;
    }

    this.numberCurrencyFix = function(n) {
        var s = this.numberCurrency(n);
        var ss = s.split(".");
        if (ss.length == 1) {
            return s+".00";
        } else if(ss[1].length == 1) {
            return s+"0";
        } else if(ss[1].length == 0) {
            return s+"00";
        } else if(ss[1].length > 2) {
            return ss[0]+"."+ss[1].substr(0,2);
        }
        return s;
    }
}

var commonUtils = new CommonUtils();

var service_status_map = {
    "ING": "服务中",
    "NOTING": "休息中"
}

var order_status_map = {
    "init": "未支付",
    "pay_succ": "进行中",
    "pay_fail": "支付失败",
    "refund_applied": "退款申请中",
    "refunding": "退款已受理",
    "refunded": "已退款",
    "refund_fail": "退款未同意",
    "completed": "已完成",
    "settlementing": "结算中",
    "settlemented": "已结算",
    "settlement_fail": "结算失败",
    "close": "交易关闭"
}

var sex_map = {
    "M": "男",
    "F": "女",
    "O": "未知"
}

var evaluate_map = {
    "avg_com": "综合评分",
    "avg_resp_speed": "响应速度",
    "avg_major_level": "专业水平",
    "avg_service_attitude": "服务态度"
}