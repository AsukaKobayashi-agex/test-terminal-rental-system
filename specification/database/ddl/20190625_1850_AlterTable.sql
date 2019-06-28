ALTER TABLE `test_device_basic`
	CHANGE COLUMN `test_device_caterory` `test_device_category` TINYINT(4) NOT NULL DEFAULT '0' AFTER `device_name`;
ALTER TABLE `test_device_mobile`
	ADD COLUMN `os_update_measure` TINYINT NOT NULL DEFAULT '0',
	ADD COLUMN `measure_date` DATETIME NOT NULL DEFAULT '1900-01-01 00:00:00';
ALTER TABLE `test_device_pc`
	DROP COLUMN `memory`,
	DROP COLUMN `cpu_name`;
ALTER TABLE `test_device_mobile`
	ADD COLUMN `admin_memo` VARCHAR(2000) NOT NULL DEFAULT '' AFTER `memo`;
	ALTER TABLE `test_device_pc`
	ADD COLUMN `admin_memo` VARCHAR(2000) NOT NULL DEFAULT '' AFTER `memo`;
