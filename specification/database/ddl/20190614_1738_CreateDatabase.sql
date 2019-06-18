#**********************************************************
# admin_info
#**********************************************************
CREATE TABLE admin_info (
	admin_id INT NOT NULL AUTO_INCREMENT
	,admin_name VARCHER
	,admin_password VARCHER
	,admin_address VARCHER
	,CONSTRAINT PK_admin_info PRIMARY KEY (admin_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# app_master
#**********************************************************
CREATE TABLE app_master (
	app_id INT NOT NULL AUTO_INCREMENT
	,app_name VARCHER
	,CONSTRAINT PK_app_master PRIMARY KEY (app_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# app_table
#**********************************************************
CREATE TABLE app_table (
	app_id INT NOT NULL AUTO_INCREMENT
	,device_id INT NOT NULL
	,app_add_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT FK_app_table_1 FOREIGN KEY (device_id) REFERENCES device_info (device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# carrior_master
#**********************************************************
CREATE TABLE carrior_master (
	carrior_id INT NOT NULL AUTO_INCREMENT
	,carrior_name VARCHER
	,CONSTRAINT PK_carrior_master PRIMARY KEY (carrior_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# agreement_master
#**********************************************************
CREATE TABLE agreement_master (
	agreement_id INT NOT NULL AUTO_INCREMENT
	,carrior_id TINYINT NOT NULL DEFAULT (‹ó)
	,communication_plan VARCHER
	,call_plan VARCHER
	,start_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,monthly_price DATETIME NOT NULL DEFAULT '1900/1/1'
	,agreement_memo VARCHER
	,CONSTRAINT PK_agreement_master PRIMARY KEY (agreement_id)
	,CONSTRAINT FK_agreement_master_1 FOREIGN KEY (carrior_id) REFERENCES carrior_master (carrior_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# charger_info
#**********************************************************
CREATE TABLE charger_info (
	article_id INT NOT NULL
	,charger_name VARCHER
	,charger_type TINYINT NOT NULL DEFAULT 0
	,CONSTRAINT FK_charger_info_1 FOREIGN KEY (article_id) REFERENCES rental_commodity_master (article_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# device_info
#**********************************************************
CREATE TABLE device_info (
	article_id INT NOT NULL
	,device_id INT NOT NULL AUTO_INCREMENT
	,device_name VARCHER
	,os_name TINYINT NOT NULL DEFAULT 0
	,os_version VARCHER
	,device_caterory TINYINT NOT NULL DEFAULT 0
	,CONSTRAINT PK_device_info PRIMARY KEY (article_id,device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mobile_detail
#**********************************************************
CREATE TABLE mobile_detail (
	device_id INT NOT NULL AUTO_INCREMENT
	,mobile_type TINYINT NOT NULL DEFAULT 0
	,number VARCHER
	,device_img VARCHER
	,mail_address VARCHER
	,resolution VARCHER
	,display_size VARCHER
	,carrior_id INT NOT NULL DEFAULT 0
	,sim_card TINYINT NOT NULL DEFAULT 0
	,launch_date DATETIME NOT NULL DEFAULT '(‹ó)'
	,os_update DATETIME NOT NULL DEFAULT '(‹ó)'
	,wifi_line TINYINT NOT NULL DEFAULT 1900/1/0
	,communication_line TINYINT NOT NULL DEFAULT 1900/1/0
	,charger_type TINYINT NOT NULL DEFAULT (‹ó)
	,agreement_id INT NOT NULL DEFAULT (‹ó)
	,memo VARCHER
	,CONSTRAINT FK_mobile_detail_1 FOREIGN KEY (carrior_id) REFERENCES carrior_master (carrior_id)
	,CONSTRAINT FK_mobile_detail_2 FOREIGN KEY (agreement_id) REFERENCES agreement_master (agreement_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mylist_device
#**********************************************************
CREATE TABLE mylist_device (
	mylist_id INT NOT NULL AUTO_INCREMENT
	,article_id INT NOT NULL DEFAULT 0
	,CONSTRAINT PK_mylist_device PRIMARY KEY (mylist_id)
	,CONSTRAINT FK_mylist_device_1 FOREIGN KEY (article_id) REFERENCES rental_commodity_master (article_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# mylist_info
#**********************************************************
CREATE TABLE mylist_info (
	mylist_id INT NOT NULL AUTO_INCREMENT
	,record_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,edit_date TIMESTAMP
	,user_id INT NOT NULL DEFAULT 0
	,mylist_name VARCHER
	,CONSTRAINT PK_mylist_info PRIMARY KEY (mylist_id)
	,CONSTRAINT FK_mylist_info_1 FOREIGN KEY (user_id) REFERENCES rental_history (user_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# pc_detail
#**********************************************************
CREATE TABLE pc_detail (
	device_id INT NOT NULL AUTO_INCREMENT
	,device_img VARCHER
	,admin_name VARCHER
	,memory VARCHER
	,cpu_name VARCHER
	,mail_address VARCHER
	,os_update DATETIME NOT NULL DEFAULT '1900/1/1'
	,memo VARCHER
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# rental_commodity_master
#**********************************************************
CREATE TABLE rental_commodity_master (
	article_id INT NOT NULL AUTO_INCREMENT
	,category TINYINT NOT NULL DEFAULT (‹ó)
	,stock_flag TINYINT NOT NULL DEFAULT (‹ó)
	,add_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,last_update DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_rental_commodity_master PRIMARY KEY (article_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# rental_history
#**********************************************************
CREATE TABLE rental_history (
	user_id INT NOT NULL AUTO_INCREMENT
	,user_name VARCHER
	,user_password VARCHER
	,user_address VARCHER
	,devision_name TINYINT NOT NULL DEFAULT 0
	,group_name TINYINT NOT NULL DEFAULT 0
	,register_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_rental_history PRIMARY KEY (user_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# rental_master
#**********************************************************
CREATE TABLE rental_master (
	rental_commodity_id INT NOT NULL AUTO_INCREMENT
	,rental_flag 
	,CONSTRAINT PK_rental_master PRIMARY KEY (rental_commodity_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# software_master
#**********************************************************
CREATE TABLE software_master (
	software_id INT NOT NULL AUTO_INCREMENT
	,software_name VARCHER
	,CONSTRAINT PK_software_master PRIMARY KEY (software_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# software_table
#**********************************************************
CREATE TABLE software_table (
	software_id INT NOT NULL AUTO_INCREMENT
	,device_id INT NOT NULL
	,software_add_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT FK_software_table_1 FOREIGN KEY (device_id) REFERENCES device_info (device_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# user_info
#**********************************************************
CREATE TABLE user_info (
	user_id INT NOT NULL AUTO_INCREMENT
	,user_name VARCHER
	,user_password VARCHER
	,user_address VARCHER
	,devision_name TINYINT NOT NULL DEFAULT 0
	,group_name TINYINT NOT NULL DEFAULT 0
	,register_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_user_info PRIMARY KEY (user_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

