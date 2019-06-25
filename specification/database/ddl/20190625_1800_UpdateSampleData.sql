-- --------------------------------------------------------
-- ホスト:                          127.0.0.1
-- サーバーのバージョン:                   10.1.40-MariaDB - MariaDB Server
-- サーバー OS:                      Linux
-- HeidiSQL バージョン:               10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

--  テーブル sys_rental.admin_account の構造をダンプしています
CREATE TABLE IF NOT EXISTS `admin_account` (
  `admin_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`admin_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.admin_account: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `admin_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_account` ENABLE KEYS */;

--  テーブル sys_rental.charger の構造をダンプしています
CREATE TABLE IF NOT EXISTS `charger` (
  `charger_id` int(11) NOT NULL AUTO_INCREMENT,
  `rental_device_id` int(11) NOT NULL,
  `charger_name` varchar(200) NOT NULL DEFAULT '',
  `charger_type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`charger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.charger: ~1 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `charger` DISABLE KEYS */;
INSERT INTO `charger` (`charger_id`, `rental_device_id`, `charger_name`, `charger_type`) VALUES
	(1, 7, '充電器１', 1);
/*!40000 ALTER TABLE `charger` ENABLE KEYS */;

--  テーブル sys_rental.mobile_agreement の構造をダンプしています
CREATE TABLE IF NOT EXISTS `mobile_agreement` (
  `mobile_agreement_id` int(11) NOT NULL AUTO_INCREMENT,
  `carrier_id` tinyint(4) NOT NULL DEFAULT '0',
  `communication_plan` varchar(200) NOT NULL DEFAULT '',
  `call_plan` varchar(200) NOT NULL DEFAULT '',
  `monthly_price` int(11) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `memo` varchar(2000) NOT NULL DEFAULT '',
  PRIMARY KEY (`mobile_agreement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.mobile_agreement: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `mobile_agreement` DISABLE KEYS */;
INSERT INTO `mobile_agreement` (`mobile_agreement_id`, `carrier_id`, `communication_plan`, `call_plan`, `monthly_price`, `start_date`, `memo`) VALUES
	(1, 1, 'カケホーダイプラン', 'ビジネスシェアパック10★\r\n SPモード', 12639, '2007-06-01 00:00:00', '契約に関するメモが書かれています。');
/*!40000 ALTER TABLE `mobile_agreement` ENABLE KEYS */;

--  テーブル sys_rental.mobile_app_master の構造をダンプしています
CREATE TABLE IF NOT EXISTS `mobile_app_master` (
  `mobile_app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`mobile_app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.mobile_app_master: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `mobile_app_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `mobile_app_master` ENABLE KEYS */;

--  テーブル sys_rental.mobile_carrier の構造をダンプしています
CREATE TABLE IF NOT EXISTS `mobile_carrier` (
  `carrier_id` int(11) NOT NULL AUTO_INCREMENT,
  `carrier_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`carrier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.mobile_carrier: ~3 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `mobile_carrier` DISABLE KEYS */;
INSERT INTO `mobile_carrier` (`carrier_id`, `carrier_name`) VALUES
	(1, 'docomo'),
	(2, 'au'),
	(3, 'softbank');
/*!40000 ALTER TABLE `mobile_carrier` ENABLE KEYS */;

--  テーブル sys_rental.mobile_installed_app の構造をダンプしています
CREATE TABLE IF NOT EXISTS `mobile_installed_app` (
  `test_device_id` int(11) NOT NULL,
  `mobile_app_id` int(11) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`test_device_id`,`mobile_app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.mobile_installed_app: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `mobile_installed_app` DISABLE KEYS */;
/*!40000 ALTER TABLE `mobile_installed_app` ENABLE KEYS */;

--  テーブル sys_rental.mylist の構造をダンプしています
CREATE TABLE IF NOT EXISTS `mylist` (
  `mylist_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `mylist_name` varchar(200) NOT NULL DEFAULT '',
  `registration_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`mylist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.mylist: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `mylist` DISABLE KEYS */;
/*!40000 ALTER TABLE `mylist` ENABLE KEYS */;

--  テーブル sys_rental.mylist_device の構造をダンプしています
CREATE TABLE IF NOT EXISTS `mylist_device` (
  `mylist_id` int(11) NOT NULL AUTO_INCREMENT,
  `rental_device_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mylist_id`,`rental_device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.mylist_device: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `mylist_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `mylist_device` ENABLE KEYS */;

--  テーブル sys_rental.pc_software の構造をダンプしています
CREATE TABLE IF NOT EXISTS `pc_software` (
  `test_device_id` int(11) NOT NULL,
  `software_id` int(11) NOT NULL,
  `software_add_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`test_device_id`,`software_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.pc_software: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `pc_software` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_software` ENABLE KEYS */;

--  テーブル sys_rental.pc_software_master の構造をダンプしています
CREATE TABLE IF NOT EXISTS `pc_software_master` (
  `software_id` int(11) NOT NULL AUTO_INCREMENT,
  `software_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`software_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.pc_software_master: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `pc_software_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `pc_software_master` ENABLE KEYS */;

--  テーブル sys_rental.rental_device の構造をダンプしています
CREATE TABLE IF NOT EXISTS `rental_device` (
  `rental_device_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_category` tinyint(4) NOT NULL DEFAULT '0',
  `archive_flag` tinyint(4) NOT NULL DEFAULT '0',
  `registration_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`rental_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.rental_device: ~10 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `rental_device` DISABLE KEYS */;
INSERT INTO `rental_device` (`rental_device_id`, `device_category`, `archive_flag`, `registration_date`, `update_date`) VALUES
	(1, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(2, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(3, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(4, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(5, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(6, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(7, 2, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(8, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(9, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(10, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43');
/*!40000 ALTER TABLE `rental_device` ENABLE KEYS */;

--  テーブル sys_rental.rental_history の構造をダンプしています
CREATE TABLE IF NOT EXISTS `rental_history` (
  `rental_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `rental_device_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_type` tinyint(4) NOT NULL,
  `registration_datetime` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`rental_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.rental_history: ~0 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `rental_history` DISABLE KEYS */;
INSERT INTO `rental_history` (`rental_history_id`, `rental_device_id`, `user_id`, `action_type`, `registration_datetime`) VALUES
	(1, 1, 1, 1, '2019-06-18 14:38:43');
/*!40000 ALTER TABLE `rental_history` ENABLE KEYS */;

--  テーブル sys_rental.rental_state の構造をダンプしています
CREATE TABLE IF NOT EXISTS `rental_state` (
  `rental_device_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `rental_datetime` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `scheduled_return_datetime` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`rental_device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.rental_state: ~10 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `rental_state` DISABLE KEYS */;
INSERT INTO `rental_state` (`rental_device_id`, `status`, `user_id`, `rental_datetime`, `scheduled_return_datetime`) VALUES
	(1, 1, 1, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(2, 1, 2, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(3, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(4, 1, 3, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(5, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(6, 1, 1, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(7, 0, 1, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(8, 1, 2, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(9, 1, 4, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(10, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59');
/*!40000 ALTER TABLE `rental_state` ENABLE KEYS */;

--  テーブル sys_rental.test_device_basic の構造をダンプしています
CREATE TABLE IF NOT EXISTS `test_device_basic` (
  `test_device_id` int(11) NOT NULL AUTO_INCREMENT,
  `rental_device_id` int(11) NOT NULL,
  `device_name` varchar(200) NOT NULL DEFAULT '',
  `test_device_category` tinyint(4) NOT NULL DEFAULT '0',
  `os` tinyint(4) NOT NULL DEFAULT '0',
  `os_version` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`test_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.test_device_basic: ~9 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `test_device_basic` DISABLE KEYS */;
INSERT INTO `test_device_basic` (`test_device_id`, `rental_device_id`, `device_name`, `test_device_category`, `os`, `os_version`) VALUES
	(1, 1, 'F-10D　Arrows X①', 1, 1, '4.0.3'),
	(2, 2, 'F-10D　Arrows X Hoge②', 1, 1, '4.0.3'),
	(3, 3, 'F-10D　Arrows X③', 1, 1, '4.0.3'),
	(4, 4, 'iphone 6S④', 1, 2, '4.0.3'),
	(5, 5, 'F-10D　Arrows X⑤', 1, 1, '4.0.3'),
	(6, 6, 'F-10D　Arrows X⑥', 1, 1, '4.0.3'),
	(7, 8, 'タブレット', 1, 1, '4.0.3'),
	(8, 9, 'パソコン', 2, 3, '4.0.3'),
	(9, 10, 'マックブック', 2, 4, '4.0.3');
/*!40000 ALTER TABLE `test_device_basic` ENABLE KEYS */;

--  テーブル sys_rental.test_device_mobile の構造をダンプしています
CREATE TABLE IF NOT EXISTS `test_device_mobile` (
  `test_device_id` int(11) NOT NULL,
  `carrier_id` int(11) NOT NULL DEFAULT '0',
  `agreement_id` int(11) NOT NULL DEFAULT '0',
  `mobile_type` tinyint(4) NOT NULL DEFAULT '0',
  `number` varchar(100) NOT NULL DEFAULT '',
  `mail_address` varchar(200) NOT NULL DEFAULT '',
  `wifi_line` tinyint(4) NOT NULL DEFAULT '0',
  `communication_line` tinyint(4) NOT NULL DEFAULT '0',
  `sim_card` tinyint(4) NOT NULL DEFAULT '0',
  `charger_type` tinyint(4) NOT NULL DEFAULT '0',
  `resolution` varchar(200) NOT NULL DEFAULT '',
  `display_size` varchar(200) NOT NULL DEFAULT '',
  `launch_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `os_update` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `device_img` tinyint(4) NOT NULL DEFAULT '0',
  `memo` varchar(2000) NOT NULL DEFAULT '',
  `admin_memo` varchar(2000) NOT NULL DEFAULT '',
  PRIMARY KEY (`test_device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.test_device_mobile: ~7 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `test_device_mobile` DISABLE KEYS */;
INSERT INTO `test_device_mobile` (`test_device_id`, `carrier_id`, `agreement_id`, `mobile_type`, `number`, `mail_address`, `wifi_line`, `communication_line`, `sim_card`, `charger_type`, `resolution`, `display_size`, `launch_date`, `os_update`, `device_img`, `memo`, `admin_memo`) VALUES
	(1, 1, 5, 1, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(2, 0, 0, 1, '08014875932', 'hogehoge@hofe.co.jp', 1, 0, 0, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(3, 3, 4, 1, '08014875932', 'hogehoge@hofe.co.jp', 0, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(4, 2, 3, 1, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(5, 2, 2, 1, '08014875932', 'hogehoge@hofe.co.jp', 0, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(6, 1, 1, 1, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(7, 1, 1, 2, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', '2013-11-05 23:00:00', 1, 'メモが書かれています。', 'メモが書かれています。');
/*!40000 ALTER TABLE `test_device_mobile` ENABLE KEYS */;

--  テーブル sys_rental.test_device_pc の構造をダンプしています
CREATE TABLE IF NOT EXISTS `test_device_pc` (
  `test_device_id` int(11) NOT NULL,
  `pc_account_name` varchar(200) NOT NULL DEFAULT '',
  `os_update_measure` tinyint(4) NOT NULL DEFAULT '0',
  `measure_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `mail_address` varchar(200) NOT NULL DEFAULT '',
  `os_update` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `device_img` tinyint(4) NOT NULL DEFAULT '0',
  `memo` varchar(2000) NOT NULL DEFAULT '',
  `admin_memo` varchar(2000) NOT NULL DEFAULT '',
  PRIMARY KEY (`test_device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.test_device_pc: ~3 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `test_device_pc` DISABLE KEYS */;
INSERT INTO `test_device_pc` (`test_device_id`, `pc_account_name`, `os_update_measure`, `measure_date`, `mail_address`, `os_update`, `device_img`, `memo`, `admin_memo`) VALUES
	(7, 'adimin', 1, '0000-00-00 00:00:00', 'adadadadad@da', '1900-01-01 00:00:00', 0, 'メモが書かれています。', 'メモが書かれています。'),
	(8, 'admin', 0, '0000-00-00 00:00:00', 'adadadadad@da', '1900-01-01 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(9, 'admin', 0, '0000-00-00 00:00:00', 'adadadadad@da', '1900-01-01 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。');
/*!40000 ALTER TABLE `test_device_pc` ENABLE KEYS */;

--  テーブル sys_rental.user の構造をダンプしています
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `devision_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `registration_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- テーブル sys_rental.user: ~4 rows (約) のデータをダンプしています
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `name`, `password`, `address`, `devision_id`, `group_id`, `registration_date`, `update_date`) VALUES
	(1, '山根　瑞葵', '1114703', 'yamane-mizuki@agex.co.jp', 20, 2020, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(2, '小林　明日香', '1114703', 'yamane-mizuki@agex.co.jp', 20, 2020, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(3, '原田　翔平', '1114703', 'yamane-mizuki@agex.co.jp', 20, 2020, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(4, '徳永　迅', '1114703', 'yamane-mizuki@agex.co.jp', 20, 2020, '2019-06-18 14:38:43', '2019-06-18 14:38:43');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
