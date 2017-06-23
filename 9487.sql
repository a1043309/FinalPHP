-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2017 年 06 月 22 日 20:27
-- 伺服器版本: 5.7.18-0ubuntu0.16.04.1
-- PHP 版本： 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `9487`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `P_Code` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `P_NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `P_Price` int(11) DEFAULT NULL,
  `P_Inv` int(11) DEFAULT NULL,
  `P_SoldAmount` int(11) DEFAULT NULL,
  `P_ImgPath` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Seller_ID` char(12) CHARACTER SET latin1 DEFAULT NULL,
  `P_Game` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `P_Server` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `P_Classify` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `P_Present` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Post_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `product`
--

INSERT INTO `product` (`P_Code`, `P_NAME`, `P_Price`, `P_Inv`, `P_SoldAmount`, `P_ImgPath`, `Seller_ID`, `P_Game`, `P_Server`, `P_Classify`, `P_Present`, `Post_Time`) VALUES
('01d6f1e5a3ab', '戲如人生 ', 500, 21, 1, 'product/img/01d6f1e5a3abRUGiJAS.jpg', 'yoyowen1114', '新楓之谷', '菇菇寶貝', '送禮', '幫自己的人生QQ \r\n送個禮吧!			', '2017-06-06 19:23:58'),
('03514560c15b', '+5長輩圖', 8787, 8877, 0, 'product/img/03514560c15bDMcnKs6.jpg', 'Uni', '新楓之谷', '藍寶', '道具', '長輩圖介紹\r\n					', '2017-06-07 06:39:42'),
('0d73e2eaedb8', 'Mentally Retarded', 87, 4, 83, 'product/img/0d73e2eaedb8FB_IMG_1477584603210.jpg', 'OEBOEBOEB', '新楓之谷', '緞帶肥肥', '道具', '87\r\n					\r\n					', '2017-06-06 19:16:07'),
('10098a758ea6', '誰能比我狂', 45, -6, 12, 'product/img/10098a758ea617795770_1320605791363010_8016702533439759830_n.jpg', 'yoyowen1114', '爆爆王', '全部', '道具', '94狂啦		', '2017-06-06 20:05:06'),
('154756289f90', '再看啊', 700, 11, 9, 'product/img/154756289f90IMAG0788.jpg', 'URShit', '跑跑卡丁車', '全部', '全部', '		', '2017-06-07 01:48:52'),
('1fd98ed13199', '代練', 50, 2, 1, 'product/img/1fd98ed1319912339174_490095597830871_2798415591360225986_o.jpg', 'OEBOEBOEB', '新楓之谷', '雪吉拉', '遊戲幣', '代練', '2017-06-06 19:37:39'),
('279e8a8959ff', '就在明天', 30, 30, 0, 'product/img/279e8a8959ff15443295_336303430090144_3448777053805819080_o.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '其他', '歪國人			', '2017-06-06 20:24:19'),
('29e4731bfd73', '馳騁著 摳瞜摳搂摳搂', 8745, 4, 1, 'product/img/29e4731bfd73IMG_3806.JPG', 'yoyowen1114', '新楓之谷', '菇菇寶貝', '其他', '跑啊跑啊跑			', '2017-06-06 19:48:21'),
('2e45be06e909', '針便宜賣 多到用不完', 100, 50, 49, 'product/img/2e45be06e909icon175x175.png', 'yvette', '爆爆王', '全部', '道具', '100=50根\r\n一根只要兩塊\r\n你看過那麼便宜的？\r\n					', '2017-06-06 19:21:21'),
('371846f5b221', '帳號轉手', 777, 1, 0, 'product/img/371846f5b221qbxFAno.jpg', 'yoyowen1114', '爆爆王', '全部', '帳號', '最強帳號，便宜賣!	', '2017-06-06 19:24:52'),
('37617083b58f', '6666555', 200, 19, 1, 'product/img/37617083b58fIMAG0719.jpg', 'OEBOEBOEB', '新楓之谷', '菇菇寶貝', '代練', 'qu06u6=		', '2017-06-07 04:58:36'),
('37e96bda3995', '9487666', 666, 30, 0, 'product/img/37e96bda3995IMAG0795.jpg', 'OEBOEBOEB', '跑跑卡丁車', '全部', '道具', '朝南		', '2017-06-07 04:53:09'),
('3c6d1fbd992a', '限定寵物', 350, 2, 8, 'product/img/3c6d1fbd992a12506769_812395702217284_2031236686_n.png', 'eunicedai', '新楓之谷', '藍寶', '道具', '二十週年 限定寵物\r\n一隻350不含剪刀 請自備剪刀\r\n					', '2017-06-03 15:10:58'),
('413116a8668c', '878787', 878787, 10, 0, 'product/img/413116a8668c1391450_540445896035141_837201172_n.jpg', 'OEBOEBOEB', '爆爆王', '全部', '道具', '\r\n					\r\n					', '2017-06-06 19:11:44'),
('487e4236e880', '天使車種', 11, 10, 1, 'product/img/487e4236e88012208326_776466029143128_3718446886876873888_n.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '其他', '小天使4ni\r\n					\r\n					', '2017-06-06 19:45:49'),
('49becd7ae906', '我不知道', 800, 19, 1, 'product/img/49becd7ae906IMAG0716.jpg', 'OEBOEBOEB', '爆爆王', '全部', '全部', '					', '2017-06-07 01:38:51'),
('5d0cda21b3c5', 'oPTTo小藍寶', 94879487, 1, 0, 'product/img/5d0cda21b3c515039608_1513594638667393_6697779562465709855_o.jpg', 'OEBOEBOEB', '跑跑卡丁車', '全部', '帳號', '僅此一組\r\n					', '2017-06-06 19:35:44'),
('6461aafb30c3', 'PHPDB100', 5000, 49, 1, 'product/img/6461aafb30c318589096_10208877665650059_4722872127623497380_o.jpg', 'OEBOEBOEB', '新楓之谷', '菇菇寶貝', '帳號', '新婚愉快!!!!			', '2017-06-07 06:05:23'),
('665eba5dc96a', '6666史上最6', 666, 66, 0, 'product/img/665eba5dc96a2017-01-06.png', 'yoyowen1114', '跑跑卡丁車', '全部', '其他', '史上最6錯過就沒\r\n					', '2017-06-06 19:35:47'),
('67f983bc9fa9', '小可愛', 38, 38, 0, 'product/img/67f983bc9fa915349778_333720660348421_902648827767892478_n.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '商城道具', '可愛 <3\r\n					', '2017-06-06 20:26:43'),
('697413c9754e', '搶劫功能卡', 74, 32, 0, 'product/img/697413c9754e15369166_334365696950584_3582240601177554542_o.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '其他', '搶劫犯			', '2017-06-06 20:27:27'),
('7384a05e51b8', '魯拉拉', 78, 22, 0, 'product/img/7384a05e51b810338893_964081217015471_1805926670404273029_n.jpg', 'yoyowen1114', '新楓之谷', '藍寶', '其他', '天使降臨!			', '2017-06-06 20:06:16'),
('79e5f2d30bd7', '快手達人', 789, 8, 5, 'product/img/79e5f2d30bd710551549_10206431283853551_7642056594589925687_o.jpg', 'yoyowen1114', '新楓之谷', '綠水靈', '代練', '13歲開始coding，至今已年滿7年，手速無人能敵			', '2017-06-06 19:53:26'),
('7f2283318902', '遊俠9 +5完美改', 3000, 30, 2, 'product/img/7f228331890214749878521709140HN.jpg', 'sddd1234567', '跑跑卡丁車', '全部', '其他', '遊俠9 +5完美改		', '2017-06-06 18:53:42'),
('8a0612b3f9ff', '賣甲派賣甲派', 88888, 88, 0, 'product/img/8a0612b3f9ff15036509_1018849531571442_923768558014779818_n.jpg', 'yoyowen1114', '爆爆王', '全部', '其他', '可愛龍貓貓		\r\n					', '2017-06-06 19:44:57'),
('a1ac02c45189', '別問', 3213, 22, 1, 'product/img/a1ac02c45189IMAG0751.jpg', 'OEBOEBOEB', '跑跑卡丁車', '全部', '全部', '\r\n					', '2017-06-06 20:28:24'),
('a26897c5d024', '聰明肥宅', 969, 33, 0, 'product/img/a26897c5d024252521_229156147111255_3482161_n.jpg', 'yoyowen1114', '爆爆王', '全部', '其他', '聰明肥至宅		', '2017-06-06 19:50:26'),
('aa242dd3914f', '知識就是力量', 50, 100, 0, 'product/img/aa242dd3914f14915698_315507355503085_2634011350670776411_n.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '遊戲幣', '培根好ㄘ				', '2017-06-06 20:07:48'),
('aa37b8f9f913', '肥宅技能加乘道具', 555, 3, 0, 'product/img/aa37b8f9f91315039676_1227137697342522_5041411624549323366_o.jpg', 'yoyowen1114', '爆爆王', '全部', '道具', '大木博士教你怎麼變肥宅		', '2017-06-06 19:51:57'),
('ab745cd627f6', '睡美人果實', 8787, 33, 0, 'product/img/ab745cd627f614566403_345679392434090_2264673610377334671_o.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '其他', '睡美人94狂			', '2017-06-06 19:57:51'),
('b02488eb1418', '亂世蔥蔥超強道具車', 500, 20, 0, 'product/img/b02488eb14182017-01-06.png', 'yoyowen1114', '跑跑卡丁車', '全部', '商城道具', '最強道具車!不買可惜\r\n強化滿等			', '2017-06-06 19:10:24'),
('b8f5882fe670', '1', 1, 1, 0, 'product/img/b8f5882fe670Chrysanthemum.jpg', '1', '新楓之谷', '星光精靈', '道具', '商品介紹\r\n					', '2017-06-07 05:19:29'),
('c35371bf18bb', '話不多說', 321, 2, 0, 'product/img/c35371bf18bb10386962_687382587976186_1578196054933343607_o.jpg', 'OEBOEBOEB', '跑跑卡丁車', '全部', '全部', '話不多說 看就對了					', '2017-06-06 19:47:10'),
('c93b75bcaaa5', '商城道具都賣！！', 50, 50, 0, 'product/img/c93b75bcaaa5iteminfo.jpg', 'yvette', '爆爆王', '全部', '商城道具', '50元：火針＋雪靴＋無敵光盾＋大雪＋毛手套＋彈簧鞋\r\n					', '2017-06-06 19:26:08'),
('d6978fc5366c', '又是肥宅', 20, 3, 0, 'product/img/d6978fc5366c15326448_335573203496500_5026769418009588832_n.jpg', 'yoyowen1114', '跑跑卡丁車', '全部', '道具', '倒數兩天			', '2017-06-06 20:25:00'),
('dbd95a0135b9', '閉嘴', 9487, 8, 1, 'product/img/dbd95a0135b9IMAG0800.jpg', 'URShit', '跑跑卡丁車', '全部', '全部', '\r\n					', '2017-06-07 02:15:24'),
('f7331d1e71f7', '全新上市浪漫好禮', 520, 2, 0, 'product/img/f7331d1e71f714612521_345688562433173_5517325531728181057_o.jpg', 'yoyowen1114', '新楓之谷', '九大', '送禮', '浪漫上市			', '2017-06-06 19:59:09');

-- --------------------------------------------------------

--
-- 資料表結構 `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_Code` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `Buyer_ID` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `P_Code` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `RateToSeller` int(11) DEFAULT NULL,
  `RateToBuyer` int(11) DEFAULT NULL,
  `isReceive` tinyint(1) DEFAULT '0',
  `Post_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `purchase`
--

INSERT INTO `purchase` (`Purchase_Code`, `Buyer_ID`, `P_Code`, `Amount`, `RateToSeller`, `RateToBuyer`, `isReceive`, `Post_Time`) VALUES
('0a96edca4865', 'URShit', '2e45be06e909', 49, 4, NULL, 1, '2017-06-07 02:14:37'),
('197d4423ac6a', 'OEBOEBOEB', '154756289f90', 8, NULL, NULL, 0, '2017-06-07 02:51:54'),
('19f87fd10b73', 'yoyowen1114', '6461aafb30c3', 1, 10, 10, 1, '2017-06-07 06:06:11'),
('273db4843368', 'OEBOEBOEB', '10098a758ea6', 1, 7, 8, 1, '2017-06-06 20:16:27'),
('3ac2142e9cf4', 'yoyowen1114', '0d73e2eaedb8', 1, 8, 10, 1, '2017-06-07 04:49:17'),
('49738307b37b', 'OEBOEBOEB', '154756289f90', 1, 8, NULL, 1, '2017-06-07 02:45:18'),
('4b5771ab3ba8', 'yoyowen1114', '7f2283318902', 1, 8, 10, 1, '2017-06-07 03:38:52'),
('4dfeb81a2ea3', 'yoyowen1114', '37617083b58f', 1, 7, 10, 1, '2017-06-07 04:59:46'),
('5cb7c5116c5f', 'URShit', '487e4236e880', 1, NULL, NULL, 1, '2017-06-07 01:59:20'),
('64ceb51366f8', 'yoyowen1114', '0d73e2eaedb8', 2, 8, 7, 1, '2017-06-06 20:03:41'),
('7349920ad6b6', 'OEBOEBOEB', '79e5f2d30bd7', 5, 7, 7, 1, '2017-06-06 20:14:03'),
('74057ed03dd9', 'sddd1234567', '10098a758ea6', 5, NULL, NULL, 0, '2017-06-07 06:25:07'),
('8cb2cbc4ee68', 'yoyowen1114', 'dbd95a0135b9', 1, NULL, NULL, 0, '2017-06-07 03:35:37'),
('9ce7777d00f9', 'sddd1234567', '49becd7ae906', 1, NULL, NULL, 0, '2017-06-15 01:18:17'),
('aa3329c5f817', 'yvette', '3c6d1fbd992a', 1, NULL, NULL, 0, '2017-06-06 20:00:14'),
('abe835b9bf9f', 'yoyowen1114', '1fd98ed13199', 1, NULL, NULL, 0, '2017-06-06 20:22:15'),
('c0c6fb82d4f4', 'URShit', '29e4731bfd73', 1, NULL, NULL, 1, '2017-06-07 02:14:17'),
('c23510a48f5f', 'URShit', '0d73e2eaedb8', 80, 4, 9, 1, '2017-06-07 01:59:59'),
('c7dfe7ddcaf4', 'h2so4', '01d6f1e5a3ab', 1, NULL, NULL, 0, '2017-06-07 03:22:59'),
('cc0dab35d67b', 'h2so4', '3c6d1fbd992a', 1, 1, 8, 1, '2017-06-07 02:52:24'),
('d107d37a96d3', 'h2so4', '3c6d1fbd992a', 1, 10, NULL, 1, '2017-06-07 02:49:06'),
('d9f5d851c6c3', 'URShit', '3c6d1fbd992a', 1, NULL, NULL, 1, '2017-06-07 02:48:14'),
('db624a7eb61d', 'URShit', 'a1ac02c45189', 1, 8, 1, 1, '2017-06-07 02:57:32'),
('ea6bcec81a9a', 'sddd1234567', '10098a758ea6', 6, NULL, NULL, 0, '2017-06-07 06:25:01'),
('eed12d3e6d8b', 'yoyowen1114', '7f2283318902', 1, NULL, NULL, 0, '2017-06-07 03:38:08'),
('f81f23833495', 'yvette', '3c6d1fbd992a', 1, NULL, NULL, NULL, '2017-06-06 19:57:08');

-- --------------------------------------------------------

--
-- 資料表結構 `question`
--

CREATE TABLE `question` (
  `Q_Code` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `P_Code` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `Asker_ID` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `Content` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reply_Content` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Post_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `question`
--

INSERT INTO `question` (`Q_Code`, `P_Code`, `Asker_ID`, `Content`, `Reply_Content`, `Post_Time`) VALUES
('0d166c890f64', '1fd98ed13199', 'yvette', '一次是幾等呢', '333', '2017-06-06 19:39:45'),
('13f6210fde6e', '7f2283318902', 'yvette', '請問 3000是三台嗎？', 'ㄏ', '2017-06-06 19:27:29'),
('45c8a2ffa237', '6461aafb30c3', 'yoyowen1114', '請問幾號喜宴?', '7月喔', '2017-06-07 06:07:01'),
('4ec2bee1d60e', '0d73e2eaedb8', 'yoyowen1114', '屌喔', '6666666', '2017-06-07 04:49:45'),
('54e6f92fbbe5', 'dbd95a0135b9', 'yoyowen1114', '已下單，五碗9點可以嗎', NULL, '2017-06-07 03:37:02'),
('54fa4abfc8bd', '413116a8668c', 'h2so4', '天哪好想買喔？ 可以便宜一點嗎？', NULL, '2017-06-06 19:21:24'),
('55ed1ecd7caf', '79e5f2d30bd7', 'URShit', '敢問 左手跟右手哪個比較快，可以只買一支嗎?', NULL, '2017-06-07 01:49:56'),
('619e6068779c', '487e4236e880', 'URShit', '好久不見，好便宜，是假貨嗎?', NULL, '2017-06-07 02:01:40'),
('6feff72ebfee', '37617083b58f', 'yoyowen1114', '何時可交貨?', '明天', '2017-06-07 05:00:21'),
('7cdcef60746d', '67f983bc9fa9', 'URShit', '鋼鐵人逆?', NULL, '2017-06-07 02:01:14'),
('95a5dc81ef51', '7384a05e51b8', 'OEBOEBOEB', 'toggle不見了QQ', '幫QQ', '2017-06-06 20:14:33'),
('96a3393d878f', '7f2283318902', 'yoyowen1114', '已下單，五碗9點可以嗎', NULL, '2017-06-07 03:38:27'),
('a19e71a1a3ea', '0d73e2eaedb8', 'URShit', '這麼87，價格真的$87嗎?', NULL, '2017-06-07 02:00:38'),
('a98de757c1f9', '3c6d1fbd992a', 'yvette', '好可愛！！！請問有寵物裝備嗎', NULL, '2017-06-06 19:41:05'),
('c28522a76a0a', 'f7331d1e71f7', 'URShit', '太貴了，可以只賣52就好嗎?', NULL, '2017-06-07 02:02:14'),
('c8593b27ff1f', '413116a8668c', 'yvette', '小心會被管理員刪除喔！', NULL, '2017-06-06 19:28:24'),
('e067e2115621', '7384a05e51b8', 'OEBOEBOEB', 'tired', 'sleep', '2017-06-06 20:07:24'),
('e4368d42eb5d', '1fd98ed13199', 'yoyowen1114', '價格太高了', NULL, '2017-06-06 20:22:03'),
('e9eefc1ba220', '279e8a8959ff', 'URShit', '歪國是哪國', NULL, '2017-06-07 01:49:17');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `U_ID` varchar(12) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `U_PW` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `U_NAME` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `U_BIRTH` date NOT NULL,
  `U_JOB` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `U_GENDER` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `U_PHONE` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `U_EMAIL` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `U_MONEY` int(11) DEFAULT '0',
  `Post_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `U_Right` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`U_ID`, `U_PW`, `U_NAME`, `U_BIRTH`, `U_JOB`, `U_GENDER`, `U_PHONE`, `U_EMAIL`, `U_MONEY`, `Post_Time`, `U_Right`) VALUES
('1', '1', '1', '2017-06-12', 'student', 'female', '1', '1', 0, '2017-06-07 05:18:39', NULL),
('eunicedai', 'php2017', '吳岱璇', '1996-06-21', 'student', 'female', '0909223445', 'eunice@gmail.com', 2150, '0000-00-00 00:00:00', NULL),
('h2so4', 'hanwei123', '陳冠維', '2017-06-06', 'student', 'male', '0917170981', 'sddd1234567@gmail.com', 9998799, '2017-06-06 19:08:46', NULL),
('OEBOEBOEB', 'OEBOEBOEB', 'OEBOEBOEB', '1978-06-07', 'student', 'male', '090805040025', '08520338', 105000, '2017-06-06 19:09:15', NULL),
('qqq', 'qqq', 'qqq', '1997-11-17', 'student', 'female', '123', '123', 0, '2017-06-07 04:48:17', NULL),
('sddd1234567', 'php2017', 'é™³å† ç¶­', '2017-05-02', 'student', 'male', '0917170981', 'sddd1234567@gmail.com', 2426, '0000-00-00 00:00:00', 1),
('Uni', 'cc1124', '油膩時代', '2017-06-07', 'work', 'male', '09229487', 'Eeeeemmmmaaaiiilll', 0, '2017-06-07 06:37:40', NULL),
('URShit', 'URShit', 'URShit', '1988-07-06', 'work', 'male', '0987654154', '123456789', 19857470, '2017-06-07 01:40:47', NULL),
('www', 'www', 'www', '1967-11-22', 'student', 'male', '0123456789', '123@yahoo.com', 0, '2017-06-07 03:33:57', NULL),
('yoyowen1114', 'php2017', '林祈妏', '1996-11-14', 'NULL', 'female', '0975110206', 'yoyowen1114@gmail.com', 5000, '2017-06-06 19:07:05', NULL),
('yvette', 'y1y2y3', '吳岱蓉', '1999-03-04', 'student', 'female', '0909966388', 'yvette@gmail.com', 5350, '2017-06-06 19:07:16', NULL);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`P_Code`),
  ADD KEY `Seller_ID` (`Seller_ID`);

--
-- 資料表索引 `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_Code`),
  ADD KEY `Buyer_ID` (`Buyer_ID`),
  ADD KEY `P_Code` (`P_Code`);

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Q_Code`),
  ADD KEY `P_Code` (`P_Code`),
  ADD KEY `Asker_Code` (`Asker_ID`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`U_ID`);

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `PRODUCT_ibfk_1` FOREIGN KEY (`Seller_ID`) REFERENCES `user` (`U_ID`);

--
-- 資料表的 Constraints `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `PURCHASE_ibfk_1` FOREIGN KEY (`Buyer_ID`) REFERENCES `user` (`U_ID`),
  ADD CONSTRAINT `PURCHASE_ibfk_2` FOREIGN KEY (`P_Code`) REFERENCES `product` (`P_Code`);

--
-- 資料表的 Constraints `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `QUESTION_ibfk_1` FOREIGN KEY (`P_Code`) REFERENCES `product` (`P_Code`),
  ADD CONSTRAINT `QUESTION_ibfk_2` FOREIGN KEY (`Asker_ID`) REFERENCES `user` (`U_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
