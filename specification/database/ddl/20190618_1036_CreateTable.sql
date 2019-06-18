#**********************************************************
# admin_account
#**********************************************************
CREATE TABLE admin_account (
	admin_account_id INT NOT NULL AUTO_INCREMENT
	,name VARCHAR (100) NOT NULL DEFAULT ''
	,password VARCHAR (100) NOT NULL DEFAULT ''
	,address VARCHAR (200) NOT NULL DEFAULT ''
	,CONSTRAINT PK_admin_account PRIMARY KEY (admin_account_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# user
#**********************************************************
CREATE TABLE user (
	user_id INT NOT NULL AUTO_INCREMENT
	,name VARCHAR (100) NOT NULL DEFAULT ''
	,password VARCHAR (100) NOT NULL DEFAULT ''
	,address VARCHAR (200) NOT NULL DEFAULT ''
	,devision_id INT NOT NULL DEFAULT 0
	,group_id INT NOT NULL DEFAULT 0
	,registration_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,update_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_user PRIMARY KEY (user_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# rental_device
#**********************************************************
CREATE TABLE rental_device (
	rental_device_id INT NOT NULL AUTO_INCREMENT
	,device_category TINYINT NOT NULL DEFAULT (‹ó)
	,archive_flag TINYINT NOT NULL DEFAULT (‹ó)
	,registration_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,update_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_rental_device PRIMARY KEY (rental_device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# rental_state
#**********************************************************
CREATE TABLE rental_state (
	rental_device_id INT NOT NULL
	,status TINYINT NOT NULL DEFAULT 0
	,user_id INT NOT NULL DEFAULT 0
	,rental_datetime DATETIME NOT NULL DEFAULT '1900/1/1'
	,scheduled_return_datetime DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_rental_state PRIMARY KEY (rental_device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# rental_history
#**********************************************************
CREATE TABLE rental_history (
	rental_history_id INT NOT NULL AUTO_INCREMENT
	,rental_device_id INT NOT NULL
	,user_id INT NOT NULL
	,action_type TINYINT NOT NULL
	,registration_datetime DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_rental_history PRIMARY KEY (rental_history_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# test_device_basic
#**********************************************************
CREATE TABLE test_device_basic (
	test_device_id INT NOT NULL AUTO_INCREMENT
	,rental_device_id INT NOT NULL
	,device_name VARCHAR (200) NOT NULL DEFAULT ''
	,test_device_caterory TINYINT NOT NULL DEFAULT 0
	,os TINYINT NOT NULL DEFAULT 0
	,os_version VARCHAR (100) NOT NULL DEFAULT ''
	,CONSTRAINT PK_test_device_basic PRIMARY KEY (test_device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# test_device_mobile
#**********************************************************
CREATE TABLE test_device_mobile (
	test_device_id INT NOT NULL
	,carrier_id INT NOT NULL DEFAULT 0
	,agreement_id INT NOT NULL DEFAULT (‹ó)
	,mobile_type TINYINT NOT NULL DEFAULT 0
	,number VARCHAR (100) NOT NULL DEFAULT ''
	,mail_address VARCHAR (200) NOT NULL DEFAULT ''
	,wifi_line TINYINT NOT NULL DEFAULT 0
	,communication_line TINYINT NOT NULL DEFAULT 0
	,sim_card TINYINT NOT NULL DEFAULT 0
	,charger_type TINYINT NOT NULL DEFAULT 0
	,resolution VARCHAR (200) NOT NULL DEFAULT ''
	,display_size VARCHAR (200) NOT NULL DEFAULT ''
	,launch_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,os_update DATETIME NOT NULL DEFAULT '1900/1/1'
	,device_img TINYINT NOT NULL DEFAULT 0
	,memo VARCHAR (2000) NOT NULL DEFAULT ''
	,CONSTRAINT PK_test_device_mobile PRIMARY KEY (test_device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# test_device_pc
#**********************************************************
CREATE TABLE test_device_pc (
	test_device_id INT NOT NULL
	,pc_account_name VARCHAR (200) NOT NULL DEFAULT ''
	,memory VARCHAR (200) NOT NULL DEFAULT ''
	,cpu_name VARCHAR (200) NOT NULL DEFAULT ''
	,mail_address VARCHAR (200) NOT NULL DEFAULT ''
	,os_update DATETIME NOT NULL DEFAULT '1900/1/1'
	,device_img TINYINT NOT NULL DEFAULT 0
	,memo VARCHAR (2000) NOT NULL DEFAULT ''
	,CONSTRAINT PK_test_device_pc PRIMARY KEY (test_device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mobile_carrier
#**********************************************************
CREATE TABLE mobile_carrier (
	carrier_id INT NOT NULL AUTO_INCREMENT
	,carrier_name VARCHAR (200) NOT NULL DEFAULT ''
	,CONSTRAINT PK_mobile_carrier PRIMARY KEY (carrier_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mobile_agreement
#**********************************************************
CREATE TABLE mobile_agreement (
	mobile_agreement_id INT NOT NULL AUTO_INCREMENT
	,carrier_id TINYINT NOT NULL DEFAULT 0
	,communication_plan VARCHAR (200) NOT NULL DEFAULT ''
	,call_plan VARCHAR (200) NOT NULL DEFAULT ''
	,monthly_price INT NOT NULL DEFAULT 0 
	,start_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,memo VARCHAR (2000) NOT NULL DEFAULT ''
	,CONSTRAINT PK_mobile_agreement PRIMARY KEY (mobile_agreement_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mobile_installed_app
#**********************************************************
CREATE TABLE mobile_installed_app (
	test_device_id INT NOT NULL
	,mobile_app_id INT NOT NULL
	,add_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_mobile_installed_app PRIMARY KEY (test_device_id,mobile_app_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mobile_app_master
#**********************************************************
CREATE TABLE mobile_app_master (
	mobile_app_id INT NOT NULL AUTO_INCREMENT
	,app_name VARCHAR (200) NOT NULL DEFAULT ''
	,CONSTRAINT PK_mobile_app_master PRIMARY KEY (mobile_app_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# pc_software
#**********************************************************
CREATE TABLE pc_software (
	test_device_id INT NOT NULL
	,software_id INT NOT NULL
	,add_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_pc_software PRIMARY KEY (test_device_id,software_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# pc_software_master
#**********************************************************
CREATE TABLE pc_software_master (
	software_id INT NOT NULL AUTO_INCREMENT
	,software_name VARCHAR (200) NOT NULL DEFAULT ''
	,CONSTRAINT PK_pc_software_master PRIMARY KEY (software_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# charger
#**********************************************************
CREATE TABLE charger (
	charger_id INT NOT NULL AUTO_INCREMENT
	,rental_device_id INT NOT NULL
	,charger_name VARCHAR (200) NOT NULL DEFAULT ''
	,charger_type TINYINT NOT NULL DEFAULT 0
	,CONSTRAINT PK_charger PRIMARY KEY (charger_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mylist
#**********************************************************
CREATE TABLE mylist (
	mylist_id INT NOT NULL AUTO_INCREMENT
	,user_id INT NOT NULL DEFAULT 0
	,mylist_name VARCHAR (200) NOT NULL DEFAULT ''
	,registration_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,update_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_mylist PRIMARY KEY (mylist_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mylist_device
#**********************************************************
CREATE TABLE mylist_device (
	mylist_id INT NOT NULL AUTO_INCREMENT
	,rental_device_id INT NOT NULL DEFAULT 0
	,CONSTRAINT PK_mylist_device PRIMARY KEY (mylist_id,rental_device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

