<?php
	if(!defined('LIBRARIES')) die("Error");
	
	/* Root */
	define('ROOT',__DIR__);

	/* Timezone */
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	/* Cấu hình coder */
	define('NN_MSHD',$_SERVER['HTTP_HOST']);
	define('NN_AUTHOR','');

	/* Cấu hình chung */
	$config = array(
		'version' => '1.2.3.'.time(),
		'author' => array(
			'name' => '',
			'email' => '',
			'timefinish' => ''
		),
		'arrayDomainSSL' => array(),
		'database' => array(
			'server-name' => $_SERVER["SERVER_NAME"],
			'url' => '/',
			'type' => 'mysql',
			'host' => 'localhost',
			'username' => 'doxan536_db',
			'password' => 'Fl3eDZUO7',
			'dbname' => 'doxan536_db',
			'port' => 3306,
			'prefix' => 'table_',
			'charset' => 'utf8'
		),
		'website' => array(
			'error-reporting' => 0,
			'secret' => '$nina@',
			'salt' => 'EhrnIs&^B',
			'debug-developer' => 1,
			'debug-css' => true,
			'debug-js' => true,
			'index' => false,
			'upload' => array(
				'max-width' => 1600,
				'max-height' => 1600
			),
			'lang' => array(
				'vi'=>'Tiếng Việt',
				#'en'=>'Tiếng Anh'
			),
			'lang-doc' => 'vi',
			'slug' => array(
				'vi'=>'Tiếng Việt',
				/*'en'=>'Tiếng Anh'*/
			),
			'seo' => array(
				'vi'=>'Tiếng Việt',
				# 'en'=>'Tiếng Anh'
			),
			'comlang' => array(
				"san-pham-moi" => array("vi"=>"san-pham-moi"),
				"khuyen-mai" => array("vi"=>"khuyen-mai"),
				"tin-tuc" => array("vi"=>"tin-tuc"),
				"lien-he" => array("vi"=>"lien-he")
			)
		),
		'order' => array(
			'ship' => true
		),
		'login' => array(
			'admin' => 'LoginAdmin'.NN_MSHD,
			'member' => 'LoginMember'.NN_MSHD,
			'attempt' => 5,
			'delay' => 15
		),
		'googleAPI' => array(
			'recaptcha' => array(
				'active' => true,
				'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
				'sitekey' => '6LdFVPIUAAAAABxGWURziqyjaoOBMnfo4NJDvBAD',
				'secretkey' => '6LdFVPIUAAAAAEqt_k8UcyqOrE568x5krTqXRRck'
			)
		),
		'oneSignal' => array(
			'active' => false,
			'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
			'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
		),
		'license' => array(
			'version' => "7.0.0",
			'powered' => ""
		)
	);

	/* Error reporting */
	error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);
	if($config['website']['error-reporting']){
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
	}

	/* Cấu hình base */
	if (isset($_SERVER['HTTPS']) &&
	    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
	    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
	    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
	  $http = 'https://';
	}
	else {
	  $http = 'http://';
	}
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
		#$location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		#header('HTTP/1.1 301 Moved Permanently');
		#header('Location: ' . $location);
		#exit;
	}
	/*if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
	    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    header('HTTP/1.1 301 Moved Permanently');
	    header('Location: ' . $location);
	    exit;
	}*/
	$config_url = $config['database']['server-name'].$config['database']['url'];
	$config_base = $http.$config_url;

	/* Cấu hình login */
	$login_admin = $config['login']['admin'];
	$login_member = $config['login']['member'];

	/* Cấu hình upload */
	require_once LIBRARIES."constant.php";
	define("token_ghtk","D515b51f9E8eB4AaDc91696Ba79aE7110260B925");