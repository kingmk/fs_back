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

var OrderUtils = function() {

    this.mapExtraInfo = function(goods_name) {
        var formData = [];
        switch(goods_name) {
            case "流年运势":
            case "婚恋感情":
            case "健康事业财运":
            case "八字详批":
            case "命运祥批":
            {
                formData = [{
                    title: "咨询人信息",
                    index: 0,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"},
                        {title: "婚姻状况", fieldname: "marriageStatus"},
                        {title: "家中排行", fieldname: "familyRank"}
                    ]
                }];
                break;
            }
            case "个人改名":
            {
                formData = [{
                    title: "改名人信息",
                    index: 0,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "曾用名", fieldname: "onceName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"},
                        {title: "婚姻状况", fieldname: "marriageStatus"},
                        {title: "家中排行", fieldname: "familyRank"}
                    ]
                }]
                break;
            }
            case "个人起名":
            {
                formData = [{
                    title: "起名人信息",
                    index: 0,
                    data: [
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"},
                        {title: "家中排行", fieldname: "familyRank"},
                        {title: "哥哥姓名", fieldname: "brotherName"},
                        {title: "姐姐姓名", fieldname: "sisterName"}
                    ]
                }];
                break;
            }
            case "公司起名":
            {
                formData = [{
                    title: "企业信息",
                    index: 0,
                    data: [
                        {title: "成立时间", fieldname: "establishedDate"},
                        {title: "所处行业", fieldname: "industry"},
                        {title: "主营业务", fieldname: "scopeOfBusiness"},
                        {title: "所在地", fieldname: "comAddress"},
                        {title: "现用名", fieldname: "curComName"}
                    ]
                }, {
                    title: "企业主信息",
                    index: 0,
                    data: [
                        {title: "姓名", fieldname: "realName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }];
                break;
            }
            case "结婚吉日":
            {
                formData = [{
                    title: "未婚夫",
                    index: 0,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }, {
                    title: "未婚妻",
                    index: 1,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }, {
                    title: "期望结婚日期",
                    index: 0,
                    data: [
                        {title: "期望开始日期", fieldname: "expectMarriageDateBegin"},
                        {title: "期望结束日期", fieldname: "expectMarriageDateEnd"},
                    ]
                }];
                break;
            }
            case "择日生子":
            {
                formData = [{
                    title: "父亲信息",
                    index: 0,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }, {
                    title: "母亲信息",
                    index: 1,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }, {
                    title: "子女信息",
                    index: 0,
                    data: [
                        {title: "第几胎", fieldname: "fetusNum"}
                    ]
                }];
                break;
            }
            case "开张开市":
            {
                formData = [{
                    title: "企业信息",
                    index: 0,
                    data: [
                        {title: "现用名", fieldname: "curComName"},
                        {title: "所处行业", fieldname: "industry"},
                        {title: "主营业务", fieldname: "scopeOfBusiness"},
                        {title: "所在地", fieldname: "comAddress"}
                    ]
                }, {
                    title: "企业主信息",
                    index: 0,
                    data: [
                        {title: "姓名", fieldname: "realName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }];
                break;
            }
            case "乔迁择日": 
            {
                formData = [{
                    title: "新宅信息",
                    index: 0,
                    data: [
                        {title: "新宅地址", fieldname: "newAddress"},
                        {title: "新宅落成时间", fieldname: "completedTime"},
                        {title: "期望乔迁开始时间", fieldname: "expectMoveDateBegin"},
                        {title: "期望乔迁结束时间", fieldname: "expectMoveDateEnd"}
                    ]
                },{
                    title: "主人信息",
                    index: 0,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }, {
                    title: "伴侣信息",
                    index: 1,
                    data: [
                        {title: "中文姓名", fieldname: "realName"},
                        {title: "英文姓名", fieldname: "englishName"},
                        {title: "性别", fieldname: "sex"},
                        {title: "公历出生日期", fieldname: "birthDate"},
                        {title: "出生时刻", fieldname: "birthTimeText"},
                        {title: "出生地", fieldname: "birthAddress"}
                    ]
                }];
                break;
            }
        }
        return formData;
    }
}

var orderUtils = new OrderUtils();

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
    "refund_fail": "退款失败",
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