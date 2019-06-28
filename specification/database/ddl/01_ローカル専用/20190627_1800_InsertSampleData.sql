ALTER TABLE `mobile_app_master` AUTO_INCREMENT = 0;
INSERT INTO 
	mobile_app_master
values
	 (NULL,'アプリ1');
INSERT INTO 
	mobile_app_master
VALUes
	 (NULL,'アプリ2');
INSERT INTO 
	mobile_app_master
VALUEs
	 (NULL,'アプリ3');
ALTER TABLE `mobile_installed_app` AUTO_INCREMENT = 0;
INSERT INTO 
	mobile_installed_app
VALUEs
	 (2,1,cast('2009-08-03 23:58:01' as datetime));
INSERT INTO 
	mobile_installed_app(test_device_id,mobile_app_id,add_date)
VALUEs
	 (2,2,cast('2009-08-03 23:58:01' as datetime));
INSERT INTO 
	mobile_installed_app(test_device_id,mobile_app_id,add_date)
VALUEs
	 (2,3,cast('2009-08-03 23:58:01' as datetime));
INSERT INTO 
	pc_software_master
values
	 (NULL,'ソフト1');
INSERT INTO 
	pc_software_master
values
	 (NULL,'ソフト2');
INSERT INTO 
	pc_software_master
values
	 (NULL,'ソフト3');
INSERT INTO 
	pc_software(test_device_id,software_id,software_add_date)
VALUEs
	 (9,1,cast('2009-08-03 23:58:01' as datetime));
INSERT INTO 
	pc_software(test_device_id,software_id,software_add_date)
VALUEs
	 (9,2,cast('2009-08-03 23:58:01' as datetime));
INSERT INTO 
	pc_software(test_device_id,software_id,software_add_date)
VALUEs
	 (9,3,cast('2009-08-03 23:58:01' as datetime));
