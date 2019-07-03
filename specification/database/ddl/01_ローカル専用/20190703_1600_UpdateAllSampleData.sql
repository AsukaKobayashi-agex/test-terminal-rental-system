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

-- テーブル sys_rental.admin_account: ~0 rows (約) のデータをダンプしています
DELETE FROM `admin_account`;
/*!40000 ALTER TABLE `admin_account` DISABLE KEYS */;
INSERT INTO `admin_account` (`admin_account_id`, `name`, `password`, `address`) VALUES
	(1, 'admin1', 'admin1', 'abcdefg@mail.jp');
/*!40000 ALTER TABLE `admin_account` ENABLE KEYS */;

-- テーブル sys_rental.charger: ~0 rows (約) のデータをダンプしています
DELETE FROM `charger`;
/*!40000 ALTER TABLE `charger` DISABLE KEYS */;
INSERT INTO `charger` (`charger_id`, `rental_device_id`, `charger_name`, `charger_type`) VALUES
	(1, 16, '充電器１', 1),
	(2, 17, 'charger1', 2),
	(3, 18, '充電器２', 3),
	(4, 19, 'じゅうでんき３', 4),
	(5, 20, 'チャージャー', 1);
/*!40000 ALTER TABLE `charger` ENABLE KEYS */;

-- テーブル sys_rental.mobile_agreement: ~0 rows (約) のデータをダンプしています
DELETE FROM `mobile_agreement`;
/*!40000 ALTER TABLE `mobile_agreement` DISABLE KEYS */;
INSERT INTO `mobile_agreement` (`mobile_agreement_id`, `carrier_id`, `communication_plan`, `call_plan`, `monthly_price`, `start_date`, `memo`) VALUES
	(1, 1, 'カケホーダイプラン', 'ビジネスシェアパック10★\r\n SPモード', 12639, '2007-06-01 00:00:00', '契約に関するメモが書かれています。'),
	(2, 2, 'カケホーダイプラン', 'ビジネスシェアパック10★\r\n SPモード', 12639, '2007-06-01 00:00:00', '契約に関するメモが書かれています。'),
	(3, 3, 'カケホーダイプラン', 'ビジネスシェアパック10★\r\n SPモード', 12639, '2007-06-01 00:00:00', '契約に関するメモが書かれています。'),
	(4, 1, 'カケホーダイプラン', 'ビジネスシェアパック10★\r\n SPモード', 12639, '2007-06-01 00:00:00', '契約に関するメモが書かれています。'),
	(5, 2, 'カケホーダイプラン', 'ビジネスシェアパック10★\r\n SPモード', 12639, '2007-06-01 00:00:00', '契約に関するメモが書かれています。');
/*!40000 ALTER TABLE `mobile_agreement` ENABLE KEYS */;

-- テーブル sys_rental.mobile_app_master: ~3 rows (約) のデータをダンプしています
DELETE FROM `mobile_app_master`;
/*!40000 ALTER TABLE `mobile_app_master` DISABLE KEYS */;
INSERT INTO `mobile_app_master` (`mobile_app_id`, `app_name`) VALUES
	(1, 'アプリ1'),
	(2, 'アプリ2'),
	(3, 'アプリ3');
/*!40000 ALTER TABLE `mobile_app_master` ENABLE KEYS */;

-- テーブル sys_rental.mobile_carrier: ~3 rows (約) のデータをダンプしています
DELETE FROM `mobile_carrier`;
/*!40000 ALTER TABLE `mobile_carrier` DISABLE KEYS */;
INSERT INTO `mobile_carrier` (`carrier_id`, `carrier_name`) VALUES
	(1, 'docomo'),
	(2, 'au'),
	(3, 'softbank');
/*!40000 ALTER TABLE `mobile_carrier` ENABLE KEYS */;

-- テーブル sys_rental.mobile_installed_app: ~2 rows (約) のデータをダンプしています
DELETE FROM `mobile_installed_app`;
/*!40000 ALTER TABLE `mobile_installed_app` DISABLE KEYS */;
INSERT INTO `mobile_installed_app` (`test_device_id`, `mobile_app_id`, `add_date`) VALUES
	(2, 1, '2009-08-03 23:58:01'),
	(2, 2, '2009-08-03 23:58:01'),
	(2, 3, '2009-08-03 23:58:01'),
	(3, 1, '0000-00-00 00:00:00'),
	(3, 2, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `mobile_installed_app` ENABLE KEYS */;

-- テーブル sys_rental.mylist: ~0 rows (約) のデータをダンプしています
DELETE FROM `mylist`;
/*!40000 ALTER TABLE `mylist` DISABLE KEYS */;
INSERT INTO `mylist` (`mylist_id`, `user_id`, `mylist_name`, `registration_date`, `update_date`) VALUES
	(1, 1, 'yamanelist', '1900-01-01 00:00:00', '1900-01-01 00:00:00');
/*!40000 ALTER TABLE `mylist` ENABLE KEYS */;

-- テーブル sys_rental.mylist_device: ~0 rows (約) のデータをダンプしています
DELETE FROM `mylist_device`;
/*!40000 ALTER TABLE `mylist_device` DISABLE KEYS */;
INSERT INTO `mylist_device` (`mylist_id`, `rental_device_id`) VALUES
	(1, 2),
	(1, 3),
	(1, 4);
/*!40000 ALTER TABLE `mylist_device` ENABLE KEYS */;

-- テーブル sys_rental.pc_software: ~2 rows (約) のデータをダンプしています
DELETE FROM `pc_software`;
/*!40000 ALTER TABLE `pc_software` DISABLE KEYS */;
INSERT INTO `pc_software` (`test_device_id`, `software_id`, `software_add_date`) VALUES
	(9, 1, '2009-08-03 23:58:01'),
	(9, 2, '2009-08-03 23:58:01'),
	(9, 3, '2009-08-03 23:58:01'),
	(10, 1, '2009-08-03 23:58:01'),
	(10, 2, '2009-08-03 23:58:01');
/*!40000 ALTER TABLE `pc_software` ENABLE KEYS */;

-- テーブル sys_rental.pc_software_master: ~2 rows (約) のデータをダンプしています
DELETE FROM `pc_software_master`;
/*!40000 ALTER TABLE `pc_software_master` DISABLE KEYS */;
INSERT INTO `pc_software_master` (`software_id`, `software_name`) VALUES
	(1, 'ソフト1'),
	(2, 'ソフト2'),
	(3, 'ソフト3');
/*!40000 ALTER TABLE `pc_software_master` ENABLE KEYS */;

-- テーブル sys_rental.rental_device: ~8 rows (約) のデータをダンプしています
DELETE FROM `rental_device`;
/*!40000 ALTER TABLE `rental_device` DISABLE KEYS */;
INSERT INTO `rental_device` (`rental_device_id`, `device_category`, `archive_flag`, `registration_date`, `update_date`) VALUES
	(1, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(2, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(3, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(4, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(5, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(6, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(7, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(8, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(9, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(10, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(11, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(12, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(13, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(14, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(15, 1, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(16, 2, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(17, 2, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(18, 2, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(19, 2, 0, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(20, 2, 1, '2019-06-18 14:38:43', '2019-06-18 14:38:43');
/*!40000 ALTER TABLE `rental_device` ENABLE KEYS */;

-- テーブル sys_rental.rental_history: ~0 rows (約) のデータをダンプしています
DELETE FROM `rental_history`;
/*!40000 ALTER TABLE `rental_history` DISABLE KEYS */;
INSERT INTO `rental_history` (`rental_history_id`, `rental_device_id`, `user_id`, `action_type`, `registration_datetime`) VALUES
	(1, 1, 1, 1, '2019-06-18 14:38:43');
/*!40000 ALTER TABLE `rental_history` ENABLE KEYS */;

-- テーブル sys_rental.rental_state: ~11 rows (約) のデータをダンプしています
DELETE FROM `rental_state`;
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
	(10, 1, 1, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(11, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(12, 1, 2, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(13, 1, 4, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(14, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(15, 1, 1, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(16, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(17, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(18, 1, 1, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(19, 0, 0, '2019-06-18 14:38:43', '2019-06-18 23:59:59'),
	(20, 1, 2, '2019-06-18 14:38:43', '2019-06-18 23:59:59');
/*!40000 ALTER TABLE `rental_state` ENABLE KEYS */;

-- テーブル sys_rental.test_device_basic: ~9 rows (約) のデータをダンプしています
DELETE FROM `test_device_basic`;
/*!40000 ALTER TABLE `test_device_basic` DISABLE KEYS */;
INSERT INTO `test_device_basic` (`test_device_id`, `rental_device_id`, `device_name`, `test_device_category`, `os`, `os_version`) VALUES
	(1, 1, 'スマホ１', 1, 1, '4.0.3'),
	(2, 2, 'andoroid1', 1, 1, '5'),
	(3, 3, 'iphone1', 1, 2, '2.7'),
	(4, 4, 'iphone 6S', 1, 2, '7.9.0'),
	(5, 5, 'F-10D　Arrows X⑤', 1, 1, '4.0.3'),
	(6, 6, 'tablet1', 1, 1, '4'),
	(7, 7, 'タブレット', 1, 1, '3.63.1'),
	(8, 11, 'パソコン', 2, 3, '4.0.3'),
	(9, 12, 'マックブック', 2, 4, '4.0.3'),
	(10, 8, 'タブレット２', 1, 1, '11.3.1'),
	(11, 9, 'ipad', 1, 2, '3.5.2'),
	(12, 10, 'ipad pro', 1, 2, '6.5.2'),
	(13, 13, 'pasokon', 2, 3, '10'),
	(14, 14, 'パーソナル・コンピューター', 2, 3, '4'),
	(15, 15, 'ThinkPad', 2, 3, '41');
/*!40000 ALTER TABLE `test_device_basic` ENABLE KEYS */;

-- テーブル sys_rental.test_device_mobile: ~7 rows (約) のデータをダンプしています
DELETE FROM `test_device_mobile`;
/*!40000 ALTER TABLE `test_device_mobile` DISABLE KEYS */;
INSERT INTO `test_device_mobile` (`test_device_id`, `carrier_id`, `agreement_id`, `mobile_type`, `number`, `mail_address`, `wifi_line`, `communication_line`, `sim_card`, `charger_type`, `resolution`, `display_size`, `launch_date`, `device_img`, `memo`, `admin_memo`) VALUES
	(1, 2, 5, 1, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 4, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(2, 0, 0, 1, '', '', 1, 0, 0, 2, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(3, 1, 4, 1, '08014875932', 'hogehoge@hofe.co.jp', 0, 1, 3, 3, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(4, 3, 3, 1, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 2, 4, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(5, 2, 2, 1, '08014875932', 'hogehoge@hofe.co.jp', 0, 1, 4, 2, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(6, 1, 1, 2, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 1, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(7, 0, 0, 2, '', '', 1, 0, 0, 2, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(10, 1, 6, 2, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 1, 1, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(11, 0, 0, 2, '', '', 1, 0, 0, 3, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(12, 1, 7, 2, '08014875932', 'hogehoge@hofe.co.jp', 1, 1, 2, 4, '1280×720', '4.6インチ', '2012-07-20 00:00:00', 1, 'メモが書かれています。', 'メモが書かれています。');
/*!40000 ALTER TABLE `test_device_mobile` ENABLE KEYS */;

-- テーブル sys_rental.test_device_pc: ~3 rows (約) のデータをダンプしています
DELETE FROM `test_device_pc`;
/*!40000 ALTER TABLE `test_device_pc` DISABLE KEYS */;
INSERT INTO `test_device_pc` (`test_device_id`, `pc_account_name`, `mail_address`, `device_img`, `memo`, `admin_memo`) VALUES
	(7, 'adimin', 'adadadadad@da', 0, 'メモが書かれています。', 'メモが書かれています。'),
	(8, 'admin', 'adadadadad@da', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(9, 'admin', 'adadadadad@da', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(13, 'adimin', 'adadadadad@da', 1, 'メモが書かれています。', 'メモが書かれています。'),
	(14, 'adimin', 'adadadadad@da', 0, 'メモが書かれています。', 'メモが書かれています。'),
	(15, 'adimin', 'adadadadad@da', 0, 'メモが書かれています。', 'メモが書かれています。');
/*!40000 ALTER TABLE `test_device_pc` ENABLE KEYS */;

-- テーブル sys_rental.user: ~4 rows (約) のデータをダンプしています
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `name`, `password`, `address`, `devision_id`, `group_id`, `registration_date`, `update_date`) VALUES
	(1, '山根　瑞葵', 'yamane', 'yamane-mizuki@agex.co.jp', 10, 1010, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(2, '小林　明日香', 'kobayashi', 'kobayashi-asuka@agex.co.jp', 20, 2020, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(3, '原田　翔平', 'harada', 'harada-shohei@agex.co.jp', 30, 3030, '2019-06-18 14:38:43', '2019-06-18 14:38:43'),
	(4, '徳永　迅', 'tokunaga', 'tokunaga-zin@agex.co.jp', 40, 4020, '2019-06-18 14:38:43', '2019-06-18 14:38:43');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
