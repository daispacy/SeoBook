<?php
# Database configuration
$config['db_pconnect'] = '0';
$config['db_type'] = 'mysql';
$config['db_server'] = 'localhost';
$config['db_name'] = 'mara_db';
$config['db_user'] = 'mara_user';
# If you don't want to secure the Mysql password, use the first line and comment 2nd and 3rd lines.
# If you want to secure Mysql DB user password, please go to this link http://your-website/encryptool.php, then input your DB password into the text field, then press "ENCRYPT" to get the encrypted text.
# Then put the encrypted text into the following line, and delete the first line.
$config['db_pwd'] = 'yG2Ls4p7ou';
#include_once(ROOT_PATH.'classes/security/boot.class.php');
#$config['db_pwd'] = $boots->decrypt('qLykyZ2Zp7XY');

# Allowed operations	
$ops = array
(
	'estore',					# Show store
	'main',						# Show home page
	'login',					# Login
	'logout',					# Log out
	'register',
	'checkusername',
);

# Allowed admin operations	
$aops = array
(
	'dashboard',				# Dash board
	'system',
	'changePassword',			# Change password
	'manage',					# Manage
	'report',					# Report
	'help',						# Help
	'support',					# Support
	'admin',					# Admin operations
	'index',					# Home page
	'login',					# Login
	'logout',					# Logout	
	'register',
	'checkusername',
	'forgotpassword',
	'invalidurl',
	'accessdenied',
	'profile',
	'intpage',
);
?>
