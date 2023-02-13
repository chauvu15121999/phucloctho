<?php
	session_start();
	define('LIBRARIES','../libraries/');
    define('THUMBS','thumbs');
    define('WATERMARK','watermark');

	if(empty($_SESSION['lang'])) $_SESSION['lang'] = 'vi';
    $lang = $_SESSION['lang'];
    require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    require_once LIBRARIES.'helper.php';
    require_once LIBRARIES.'vendor/autoload.php';
    new AutoLoad();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
    $cache = new FileCache($d);
    $cart = new Cart($d);
    require_once LIBRARIES."lang/lang$lang.php";
    $sqlCache = "select * from #_setting";
    $setting = $cache->getCache($sqlCache,'fetch',7200);
    $optsetting = (!empty($setting['options'])) ? json_decode($setting['options'],true) : null;
    $model = new Model($d,$config);
    $model->setLang($lang);
    $sluglang = 'tenkhongdauvi';