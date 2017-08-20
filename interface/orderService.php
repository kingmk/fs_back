<?php
include_once './common.php';
include_once './dataUtils.php';


	$res = '{"code":"00","list":[{"id":"101237","order_num":"201708201000003803","buy_usr_id":"105271","seller_usr_id":"100144","goods_name":"\u516b\u5b57\u8be6\u6279","begin_chat_time":"2017-08-20 10:53:25","create_time":"2017-08-20 10:50:23","pay_confirm_time":"2017-08-20 10:50:29","end_chat_time":"2017-08-21 10:53:25","completed_time":"2017-08-21 10:53:25","pay_rmb_amt":"88800","settlement_plat_service_fee":"26640","settlement_master_service_fee":"62160","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"marriageStatus\":\"single\",\"sex\":\"F\",\"birth\":\"1977-12-21\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u798f\u5efa\u7701 \u798f\u5dde\u5e02\",\"birthDate\":\"1977-12-21\",\"realName\":\"\u90b1\u7ea2\",\"isSelf\":\"Y\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"familyRank\":\"2\",\"birthTime\":\"\u4e0d\u6e05\u695a\"}]","buy_usr_name":"\u90b1\u7ea2","buy_usr_mobile":"13905936700","seller_usr_name":"\u8303\u7acb\u6625","seller_usr_nickname":null},{"id":"101236","order_num":"201708201000003800","buy_usr_id":"112657","seller_usr_id":"100125","goods_name":"\u516b\u5b57\u8be6\u6279","begin_chat_time":"2017-08-20 10:44:20","create_time":"2017-08-20 10:42:09","pay_confirm_time":"2017-08-20 10:42:43","end_chat_time":"2017-08-21 10:44:20","completed_time":"2017-08-21 10:44:20","pay_rmb_amt":"99800","settlement_plat_service_fee":"29940","settlement_master_service_fee":"69860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"marriageStatus\":\"married\",\"sex\":\"F\",\"birth\":\"1979-05-26\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5b89\u5fbd\u7701 \u6dee\u5317\u5e02\",\"birthDate\":\"1979-05-26\",\"realName\":\"\u5434\u83b9\",\"isSelf\":\"Y\",\"birthTimeText\":\"13:00\u4e4b\u540e\",\"familyRank\":\"2\",\"birthTime\":\"13:\u4e0d\u6e05\u695a\"}]","buy_usr_name":"\u5434\u83b9","buy_usr_mobile":"18964909719","seller_usr_name":"\u4f58\u731b","seller_usr_nickname":null},{"id":"101234","order_num":"201708201000003794","buy_usr_id":"105271","seller_usr_id":"100125","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-20 10:37:22","create_time":"2017-08-20 10:37:14","pay_confirm_time":"2017-08-20 10:37:22","end_chat_time":"2017-08-21 10:37:22","completed_time":"2017-08-21 10:37:22","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":null,"buy_usr_name":"\u90b1\u7ea2","buy_usr_mobile":"13905936700","seller_usr_name":"\u4f58\u731b","seller_usr_nickname":null},{"id":"101233","order_num":"201708201000003791","buy_usr_id":"107835","seller_usr_id":"100125","goods_name":"\u5065\u5eb7\u4e8b\u4e1a\u8d22\u8fd0","begin_chat_time":"2017-08-20 10:30:54","create_time":"2017-08-20 10:29:30","pay_confirm_time":"2017-08-20 10:29:36","end_chat_time":"2017-08-21 10:30:54","completed_time":"2017-08-21 10:30:54","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"marriageStatus\":\"single\",\"sex\":\"M\",\"birth\":\"1997-05-24\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u897f\u7701 \u4e5d\u6c5f\u5e02\",\"birthDate\":\"1997-05-24\",\"realName\":\"\u6c5f\u4f1f\u65ed\",\"isSelf\":\"N\",\"birthTimeText\":\"10:55\",\"familyRank\":\"1\",\"birthTime\":\"10:55\"}]","buy_usr_name":"\u674e\u96c5\u840d","buy_usr_mobile":"13162902688","seller_usr_name":"\u4f58\u731b","seller_usr_nickname":null},{"id":"101231","order_num":"201708201000003785","buy_usr_id":"103704","seller_usr_id":"100133","goods_name":"\u5065\u5eb7\u4e8b\u4e1a\u8d22\u8fd0","begin_chat_time":"2017-08-20 10:24:36","create_time":"2017-08-20 10:07:12","pay_confirm_time":"2017-08-20 10:07:19","end_chat_time":"2017-08-21 10:24:36","completed_time":"2017-08-21 10:24:36","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"marriageStatus\":\"married\",\"sex\":\"F\",\"birth\":\"1982-11-08\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5b89\u5fbd\u7701 \u868c\u57e0\u5e02\",\"birthDate\":\"1982-11-08\",\"realName\":\"\u5362\u5462\u5462\",\"isSelf\":\"Y\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"familyRank\":\"1\",\"birthTime\":\"\u4e0d\u6e05\u695a\"}]","buy_usr_name":"\u5362\u5462\u5462","buy_usr_mobile":"13685511066","seller_usr_name":"\u82cf\u5dcd","seller_usr_nickname":null},{"id":"101229","order_num":"201708200000003779","buy_usr_id":"112824","seller_usr_id":"100133","goods_name":"\u5065\u5eb7\u4e8b\u4e1a\u8d22\u8fd0","begin_chat_time":"2017-08-20 00:45:33","create_time":"2017-08-20 00:44:38","pay_confirm_time":"2017-08-20 00:44:44","end_chat_time":"2017-08-21 00:45:33","completed_time":"2017-08-21 00:45:33","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"marriageStatus\":\"single\",\"sex\":\"M\",\"birth\":\"1995-08-17\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5c71\u4e1c\u7701 \u67a3\u5e84\u5e02\",\"birthDate\":\"1995-08-17\",\"realName\":\"\u5218\u6653\u4e1c\",\"isSelf\":\"Y\",\"birthTimeText\":\"15:48\",\"familyRank\":\"2\",\"birthTime\":\"15:48\"}]","buy_usr_name":"\u5218\u6653\u4e1c","buy_usr_mobile":"18518501818","seller_usr_name":"\u82cf\u5dcd","seller_usr_nickname":null},{"id":"101228","order_num":"201708192300003776","buy_usr_id":"107405","seller_usr_id":"100433","goods_name":"\u5065\u5eb7\u4e8b\u4e1a\u8d22\u8fd0","begin_chat_time":"2017-08-19 23:34:10","create_time":"2017-08-19 23:31:54","pay_confirm_time":"2017-08-19 23:32:00","end_chat_time":"2017-08-20 23:34:10","completed_time":"2017-08-20 23:34:10","pay_rmb_amt":"49800","settlement_plat_service_fee":"14940","settlement_master_service_fee":"34860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"Shuli\",\"marriageStatus\":\"single\",\"sex\":\"F\",\"birth\":\"1982-12-04\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u91cd\u5e86\u5e02 \u91cd\u5e86\u5e02\",\"birthDate\":\"1982-12-04\",\"realName\":\"\u738b\u59dd\u4e3d\",\"isSelf\":\"Y\",\"birthTimeText\":\"18:00\",\"familyRank\":\"1\",\"birthTime\":\"18:00\"}]","buy_usr_name":"\u738b\u59dd\u4e3d","buy_usr_mobile":"13552515458","seller_usr_name":"\u5d14\u6069\u5e05","seller_usr_nickname":null},{"id":"101227","order_num":"201708192300003773","buy_usr_id":"103714","seller_usr_id":"100433","goods_name":"\u5065\u5eb7\u4e8b\u4e1a\u8d22\u8fd0","begin_chat_time":"2017-08-19 23:28:01","create_time":"2017-08-19 23:21:42","pay_confirm_time":"2017-08-19 23:21:48","end_chat_time":"2017-08-20 23:28:01","completed_time":"2017-08-20 23:28:01","pay_rmb_amt":"49800","settlement_plat_service_fee":"14940","settlement_master_service_fee":"34860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"StaceyNessa\",\"marriageStatus\":\"single\",\"sex\":\"F\",\"birth\":\"1997-03-28\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"1997-03-28\",\"realName\":\"\u5b59\u5609\u8fce\",\"isSelf\":\"N\",\"birthTimeText\":\"06:10\",\"familyRank\":\"1\",\"birthTime\":\"06:10\"}]","buy_usr_name":null,"buy_usr_mobile":"13801635635","seller_usr_name":"\u5d14\u6069\u5e05","seller_usr_nickname":null},{"id":"101226","order_num":"201708192200003770","buy_usr_id":"100310","seller_usr_id":"100128","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 22:53:29","create_time":"2017-08-19 22:50:41","pay_confirm_time":"2017-08-19 22:50:48","end_chat_time":"2017-08-20 22:53:29","completed_time":"2017-08-20 22:53:29","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1982-09-07\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u897f\u7701 \u4e0a\u9976\u5e02\",\"birthDate\":\"1982-09-07\",\"realName\":\"\u534e\u4e39\",\"isSelf\":\"N\",\"birthTimeText\":\"11:28\",\"birthTime\":\"11:28\"},{\"englishName\":\"vivian\",\"sex\":\"F\",\"birth\":\"1981-08-13\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u897f\u7701 \u629a\u5dde\u5e02\",\"birthDate\":\"1981-08-13\",\"realName\":\"\u8c22\u6167\",\"isSelf\":\"Y\",\"birthTimeText\":\"21:28\",\"birthTime\":\"21:28\"}]","buy_usr_name":"\u8c22\u6167","buy_usr_mobile":"18107919586","seller_usr_name":"\u8cf4\u653f\u5b87","seller_usr_nickname":null},{"id":"101224","order_num":"201708192200003764","buy_usr_id":"109569","seller_usr_id":"100129","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 22:52:47","create_time":"2017-08-19 22:47:53","pay_confirm_time":"2017-08-19 22:47:58","end_chat_time":"2017-08-20 22:52:47","completed_time":"2017-08-20 22:52:47","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1981-04-20\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"1981-04-20\",\"realName\":\"\u9648\u4e2d\u5174\",\"isSelf\":\"Y\",\"birthTimeText\":\"10:30\",\"birthTime\":\"10:30\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1987-08-12\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6d59\u6c5f\u7701 \u6e56\u5dde\u5e02\",\"birthDate\":\"1987-08-12\",\"realName\":\"\u90a2\u9701\u98de\u82f1\",\"isSelf\":\"N\",\"birthTimeText\":\"19:00\u4e4b\u540e\",\"birthTime\":\"19:\u4e0d\u6e05\u695a\"}]","buy_usr_name":"\u9648\u4e2d\u5174","buy_usr_mobile":"18018653759","seller_usr_name":"\u4ed8\u4e7e\u4e09","seller_usr_nickname":null},{"id":"101223","order_num":"201708192200003761","buy_usr_id":"112778","seller_usr_id":"100133","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 22:34:35","create_time":"2017-08-19 22:30:32","pay_confirm_time":"2017-08-19 22:30:39","end_chat_time":"2017-08-20 22:34:35","completed_time":"2017-08-20 22:34:35","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"2017-08-19\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"2017-08-19\",\"realName\":\"\u6ca1\u6709\",\"isSelf\":\"N\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"birthTime\":\"\u4e0d\u6e05\u695a\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1976-04-30\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"1976-04-30\",\"realName\":\"\u987e\u709c\",\"isSelf\":\"Y\",\"birthTimeText\":\"12:00\",\"birthTime\":\"12:00\"}]","buy_usr_name":"\u987e\u709c","buy_usr_mobile":"13916355482","seller_usr_name":"\u82cf\u5dcd","seller_usr_nickname":null},{"id":"101221","order_num":"201708192200003755","buy_usr_id":"107824","seller_usr_id":"100127","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 22:20:44","create_time":"2017-08-19 22:14:40","pay_confirm_time":"2017-08-19 22:14:47","end_chat_time":"2017-08-20 22:20:44","completed_time":"2017-08-20 22:20:44","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1988-10-01\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5b89\u5fbd\u7701 \u5de2\u6e56\u5e02\",\"birthDate\":\"1988-10-01\",\"realName\":\"\u90d1\u98de\u6d0b\",\"isSelf\":\"N\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"birthTime\":\"\u4e0d\u6e05\u695a\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1987-11-15\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u82cf\u7701 \u82cf\u5dde\u5e02\",\"birthDate\":\"1987-11-15\",\"realName\":\"\u9648\u99a8\u61ff\",\"isSelf\":\"Y\",\"birthTimeText\":\"14:30\",\"birthTime\":\"14:30\"}]","buy_usr_name":"\u9648\u99a8\u61ff","buy_usr_mobile":"13382147796","seller_usr_name":"\u5415\u91d1\u6cfd","seller_usr_nickname":null},{"id":"101220","order_num":"201708192200003752","buy_usr_id":"107887","seller_usr_id":"100125","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 22:22:01","create_time":"2017-08-19 22:05:34","pay_confirm_time":"2017-08-19 22:05:42","end_chat_time":"2017-08-20 22:22:01","completed_time":"2017-08-20 22:22:01","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1984-11-15\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5b89\u5fbd\u7701 \u5b89\u5e86\u5e02\",\"birthDate\":\"1984-11-15\",\"realName\":\"\u8463\u7eac\",\"isSelf\":\"Y\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"birthTime\":\"\u4e0d\u6e05\u695a\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1984-11-03\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"1984-11-03\",\"realName\":\"\u674e\u96cd\",\"isSelf\":\"N\",\"birthTimeText\":\"05:55\",\"birthTime\":\"05:55\"}]","buy_usr_name":"\u674e\u96cd","buy_usr_mobile":"18601607340","seller_usr_name":"\u4f58\u731b","seller_usr_nickname":null},{"id":"101218","order_num":"201708192100003746","buy_usr_id":"102497","seller_usr_id":"100125","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 22:02:28","create_time":"2017-08-19 21:54:52","pay_confirm_time":"2017-08-19 21:55:05","end_chat_time":"2017-08-20 22:02:28","completed_time":"2017-08-20 22:02:28","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1988-11-07\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u82cf\u7701 \u5357\u4eac\u5e02\",\"birthDate\":\"1988-11-07\",\"realName\":\"\u5d14\u7389\u9f99\",\"isSelf\":\"Y\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"birthTime\":\"\u4e0d\u6e05\u695a\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1985-04-25\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u82cf\u7701 \u5f90\u5dde\u5e02\",\"birthDate\":\"1985-04-25\",\"realName\":\"\u5b8b\u96ea\",\"isSelf\":\"N\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"birthTime\":\"\u4e0d\u6e05\u695a\"}]","buy_usr_name":"\u5d14\u7389\u9f99","buy_usr_mobile":"17721161946","seller_usr_name":"\u4f58\u731b","seller_usr_nickname":null},{"id":"101216","order_num":"201708192000003740","buy_usr_id":"104031","seller_usr_id":"100498","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 21:37:23","create_time":"2017-08-19 20:52:04","pay_confirm_time":"2017-08-19 20:52:35","end_chat_time":"2017-08-20 21:37:23","completed_time":"2017-08-20 21:37:23","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1989-04-14\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5b89\u5fbd\u7701 \u829c\u6e56\u5e02\",\"birthDate\":\"1989-04-14\",\"realName\":\"\u90b1\u78ca\",\"isSelf\":\"N\",\"birthTimeText\":\"17:00\",\"birthTime\":\"17:00\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1988-06-13\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"1988-06-13\",\"realName\":\"\u960e\u8574\u745b\",\"isSelf\":\"Y\",\"birthTimeText\":\"10:00\",\"birthTime\":\"10:00\"}]","buy_usr_name":"\u960e\u8574\u745b","buy_usr_mobile":"13681868023","seller_usr_name":"\u7a0b\u6770","seller_usr_nickname":null},{"id":"101215","order_num":"201708192000003737","buy_usr_id":"108833","seller_usr_id":"100129","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 21:06:02","create_time":"2017-08-19 20:50:38","pay_confirm_time":"2017-08-19 20:50:52","end_chat_time":"2017-08-20 21:06:02","completed_time":"2017-08-20 21:06:02","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"gavin lee\",\"sex\":\"M\",\"birth\":\"1984-04-26\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u9ed1\u9f99\u6c5f\u7701 \u54c8\u5c14\u6ee8\u5e02\",\"birthDate\":\"1984-04-26\",\"realName\":\"\u674e\u5929\u822a\",\"isSelf\":\"N\",\"birthTimeText\":\"12:20\",\"birthTime\":\"12:20\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1985-12-25\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5317\u4eac\u5e02 \u5317\u4eac\u5e02\",\"birthDate\":\"1985-12-25\",\"realName\":\"\u5f20\u6587\u7389\",\"isSelf\":\"Y\",\"birthTimeText\":\"\u4e0d\u6e05\u695a\",\"birthTime\":\"\u4e0d\u6e05\u695a\"}]","buy_usr_name":"\u674e\u5929\u822a","buy_usr_mobile":"18600031583","seller_usr_name":"\u4ed8\u4e7e\u4e09","seller_usr_nickname":null},{"id":"101214","order_num":"201708192000003734","buy_usr_id":"112337","seller_usr_id":"100129","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 21:26:57","create_time":"2017-08-19 20:44:01","pay_confirm_time":"2017-08-19 20:44:40","end_chat_time":"2017-08-20 21:26:57","completed_time":"2017-08-20 21:26:57","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1985-06-01\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5e7f\u4e1c\u7701 \u6f6e\u5dde\u5e02\",\"birthDate\":\"1985-06-01\",\"realName\":\"\u6c88\u6653\u51e1\",\"isSelf\":\"N\",\"birthTimeText\":\"23:00\u4e4b\u540e\",\"birthTime\":\"23:\u4e0d\u6e05\u695a\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1988-01-04\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u4e0a\u6d77\u5e02 \u4e0a\u6d77\u5e02\",\"birthDate\":\"1988-01-04\",\"realName\":\"\u9a6c\u6587\u5a77\",\"isSelf\":\"Y\",\"birthTimeText\":\"23:17\",\"birthTime\":\"23:17\"}]","buy_usr_name":"\u9a6c\u6587\u5a77","buy_usr_mobile":"18930173210","seller_usr_name":"\u4ed8\u4e7e\u4e09","seller_usr_nickname":null},{"id":"101213","order_num":"201708191700003731","buy_usr_id":"106167","seller_usr_id":"100433","goods_name":"\u5a5a\u604b\u611f\u60c5","begin_chat_time":"2017-08-19 23:00:19","create_time":"2017-08-19 17:48:10","pay_confirm_time":"2017-08-19 17:48:17","end_chat_time":"2017-08-20 23:00:19","completed_time":"2017-08-20 23:00:19","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"sex\":\"M\",\"birth\":\"1989-05-26\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u6c5f\u82cf\u7701 \u5357\u4eac\u5e02\",\"birthDate\":\"1989-05-26\",\"realName\":\"\u5468\u767b\u6781\",\"isSelf\":\"N\",\"birthTimeText\":\"09:00\",\"birthTime\":\"09:00\"},{\"englishName\":\"\",\"sex\":\"F\",\"birth\":\"1988-12-15\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u9655\u897f\u7701 \u897f\u5b89\u5e02\",\"birthDate\":\"1988-12-15\",\"realName\":\"\u738b\u7487\",\"isSelf\":\"Y\",\"birthTimeText\":\"21:35\",\"birthTime\":\"21:35\"}]","buy_usr_name":"\u738b\u7487","buy_usr_mobile":"18221526464","seller_usr_name":"\u5d14\u6069\u5e05","seller_usr_nickname":null},{"id":"101212","order_num":"201708191700003728","buy_usr_id":"112480","seller_usr_id":"100144","goods_name":"\u6d41\u5e74\u8fd0\u52bf","begin_chat_time":"2017-08-19 17:22:04","create_time":"2017-08-19 17:19:12","pay_confirm_time":"2017-08-19 17:19:26","end_chat_time":"2017-08-20 17:22:04","completed_time":"2017-08-20 17:22:04","pay_rmb_amt":"39800","settlement_plat_service_fee":"11940","settlement_master_service_fee":"27860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"\",\"marriageStatus\":\"married\",\"sex\":\"M\",\"birth\":\"1981-09-18\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u5c71\u897f\u7701 \u592a\u539f\u5e02\",\"birthDate\":\"1981-09-18\",\"realName\":\"\u674e\u7fd4\",\"isSelf\":\"Y\",\"birthTimeText\":\"11:30\",\"familyRank\":\"1\",\"birthTime\":\"11:30\"}]","buy_usr_name":"\u674e\u7fd4","buy_usr_mobile":"13917103611","seller_usr_name":"\u8303\u7acb\u6625","seller_usr_nickname":null},{"id":"101211","order_num":"201708191600003725","buy_usr_id":"107405","seller_usr_id":"100433","goods_name":"\u5065\u5eb7\u4e8b\u4e1a\u8d22\u8fd0","begin_chat_time":"2017-08-19 16:43:56","create_time":"2017-08-19 16:40:42","pay_confirm_time":"2017-08-19 16:40:48","end_chat_time":"2017-08-20 16:43:56","completed_time":"2017-08-20 16:43:56","pay_rmb_amt":"49800","settlement_plat_service_fee":"14940","settlement_master_service_fee":"34860","status":"pay_succ","is_auto_refund":null,"order_extra_info":"[{\"englishName\":\"Shuli\",\"marriageStatus\":\"divorce\",\"sex\":\"F\",\"birth\":\"1982-12-04\",\"birthTimeType\":\"min\",\"birthAddress\":\"\u91cd\u5e86\u5e02 \u91cd\u5e86\u5e02\",\"birthDate\":\"1982-12-04\",\"realName\":\"\u738b\u59dd\u4e3d\",\"isSelf\":\"Y\",\"birthTimeText\":\"18:00\",\"familyRank\":\"1\",\"birthTime\":\"18:00\"}]","buy_usr_name":"\u738b\u59dd\u4e3d","buy_usr_mobile":"13552515458","seller_usr_name":"\u5d14\u6069\u5e05","seller_usr_nickname":null}],"total":"713","sum_pay":"33776051","sum_plat_fee":"9984880","sum_master_fee":"23791171"}';
	echo $res;
	return;

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