<?php 
function getNews($type){
    global $d;
    return $d->rawQuery("select * from #_news where type=? and hienthi > 0 order by stt asc,id desc",array($type));
}

function getShip($city,$district){
	global $d,$model;
	$city = $d->rawQueryOne("select ten from #_city where id = '$city'");
    $city = $city['ten'];
	$district = $d->rawQueryOne("select ten from #_district where id = '$district'");
    $district = $district['ten'];
	return $model->getShipCost(array("province"=>$city,"district"=>$district));
}
function isUserLogin(){
    global $login_member ;
    return array_key_exists($login_member, $_SESSION) && $_SESSION[$login_member]['active'];
}
function getUser($key){
    global $login_member,$d;

    $row = $d->rawQueryOne("select * from #_member where id = ?",array(@$_SESSION[$login_member]['id']));
	if(isset($row['id'])){
		return $row[$key];
	}
	return false;
}
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key1';
    $secret_iv = 'This is my secret iv1';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'e' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'd' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function validPassword($password){
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8)
        return false;
    return true;
}
function encode($str){
    return htmlentities($str);
}
function decode($str){
    return html_entity_decode($str);
}
function _lang($find,$replace,$str){
	$tmp = array();
	foreach($find as $k=>$v){
		$tmp[] = "{".$v."}";
	}
	return html_entity_decode(str_replace($tmp,$replace,$str));
}
function countDate($d1,$d2){
	
	return (int)round((strtotime($d1) - strtotime($d2)) / (24*3600))+1;
	
}
function logo($w,$h,$zc,$l="logo"){
    global $d;
    $logo = $d->rawQueryOne("select id, photo, options from #_photo where type = ? and act = ? limit 0,1",array($l,'photo_static'));
    return "thumbs/".$w."x".$h."x".$zc."/".UPLOAD_PHOTO_L.$logo['photo']."?v=1";
}
function getAllTronID(){
    global $d;
    $data = $d->rawQuery("select * from #_tron_transaction_log   where address ='".getUserInfo("wallet")."' order by id desc");
    $tmp = array();
    foreach($d->rawQuery("select * from #_history_log   where id_member ='".getUserInfo("id")."'") as $k=>$v){
         $tmp[$v['transaction_id']] = 1;
    } 
    $tmp2 = array();
    foreach($data as $k=>$v){
        $v['used'] = isset($tmp[$v['transaction_id']]);
        if(!$v['used']){
            $tmp2[] = $v;    
        }
        #$data[$k] = $v;
        #$tmp2[$v['used']][] = $v;
    }
    
    return $tmp2;
}

function exportCSV($array1,$array2)
{
    global $model;
    $now = gmdate("D, d M Y H:i:s");
    $filename = "export-".date("c").".csv";
    $tmp = array();
    foreach($array1 as $k=>$v){
        $array[] = $v;
        if(isset($array2[$v['id']])){
            foreach($array2[$v['id']] as $k2=>$v2){
                $array[] = $v2;
            }
        }
    }
    foreach($array as $xk=>$vx){
        foreach($vx as $k=>$v){
        if($k=="name"){
            $tmp[$xk]['Username'] = $v;
        }
         if($k=="id"){
            $tmp[$xk]['ID'] = $v;
        }
        if($k=="nickname_wt"){
            $tmp[$xk]['Nickname WT'] = $v;
        }
        if($k=="id_patronize"){
            $tmp[$xk]['ID bảo trợ'] = $v;
        }
        if($k=="nick_patronize"){
            $tmp[$xk]['Nick bảo trợ'] = $v;
        }
        if($k=="telegram"){
            $tmp[$xk]['Telegram'] = $v;
        }
        if($k=="status"){
            $tmp[$xk]['Trạng thái'] = status($v,true,$vx);
        }
        if($k=="status_quote_amout"){
            $tmp[$xk]['Trạng thái BV'] = status_quote($v);
        }
        if($k=="quote"){
            $tmp[$xk]['Hạn mức'] = ($v);
        }
        if($k=="fee"){
            $tmp[$xk]['Fee'] = ($v);
        }
        if($k=="transaction_id"){
            $tmp[$xk]['Transaction id'] = $v;
        }
        if($k=="ca"){
            $tmp[$xk]['ID bảo trợ'] = $model->getCA($v,"name");
        }
        if($k=="send_verify"){
            $tmp[$xk]['Gửi xác thực'] = ($v)?'Yes':'No';
        }
        if($k=="create_at" && $v){
            $tmp[$xk]['Ngày tạo'] = ($v);
        } 
        if($k=="at_time" && $v){
            $tmp[$xk]['Ngày kết thúc'] = ($v);
        }

        }
    }
    $array = $tmp;
   # dd($array);die;
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM*/

   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   echo ob_get_clean();
   exit;
}

function getUserInfo($key=null,$reload=false){
    global $config;
    
    $data = $_SESSION["LoginMember".NN_MSHD];
    if($data && $reload){
        global $d,$model;
        $model->savingUserLogin($d->rawQueryOne("select * from #_member where id = '".$data['id']."'"));
        $data = $_SESSION["login-".$config['hash']];

    }
    return $data[$key];
}
function status($s,$text=false,$arr=array()){
    $a = array(chuabaove,daduocbaove,hethan);
    if($text){
        #if($arr['id_parent']){
        #    return 'Upgrade to '.$arr['id_parent'];
        #}
        if(count($arr) && $arr['no_update']){
            return 'Upgrade';
        }
        if(count($arr) && $arr['pre_buy']){
            return 'Pre-registration';
        }
        return $a[$s];
    }
    $c = array("warning","success","danger");

    #if($arr['id_parent']){
    #       return '<span class="py-1 alert alert-danger">Upgrade to '.$arr['id_parent'].'</span>';
    #}
    if(count($arr) && $arr['no_update']){
            return '<span class="py-1 alert alert-primary">Upgrade</span>';
    }

    if(count($arr) && $arr['pre_buy']){
            return '<span class="py-1 alert alert-warning">Pre-registration</span>';
    }

    return '<span class="py-1 alert alert-'.$c[$s].'">'.$a[$s].'</span>';
}
function statusTron($s){
    $a = array(chuasudung,dasudung);
    $c = array("success","danger");
    return '<span class="py-1 alert alert-'.$c[$s].'">'.$a[$s].'</span>';
}
function status_quote($s){
    $a = array('Active','Pending');
    return $a[$s];
}
function checkTI($id){
    global $d;
    $address = getUserInfo("wallet");
    $row = $d->rawQueryOne("select * from #_tron_transaction_log where transaction_id='$id' and address = '$address'");
    $status = 0;
   
    if($row!==false && count($row)){
        $status = 1;
        $c = $d->rawQueryOne("select * from #_history_log where id_tron = '".$row['id']."'");
        if($c!==false){
           $status = 2; 
        }
    }
    return array("data"=>$row,"status"=>$status);
}
function checkWT($id){
	$tmp = json_decode(file_get_contents("https://api.winrich.club:2087/api?c=2047&nickname=".$id));
	$tmp2 = json_decode(file_get_contents("https://wintop1.com/check-nickname/vova28nk"));
	if($tmp->data===null){
		$tmp->data = "Not Available";
	}else{
		$tmp->data->username_parent = $tmp->data->parentUserName;
		$tmp->data->nickname_parent = $tmp->data->parentNickname;
	}	
   # $tmp = json_decode('{"data":{"username":"vova28","nickname":"vova28nk","balance":0,"username_parent":"vova25","nickname_parent":"nova77777"}}');
    if($id=="vova28nk"){
        $tmp->data->balance = 1200;
    }
    return $tmp;
}
function sendEmailError($message){
    global $emailer;
  #  $emailer->sendEmail("admin", array(), "Error ".$_SERVER['HTTP_HOST']." - ".currentDate(), $message);
}
function redirect($url){
    header("location:$url");
    exit;
}
function getEmail($path){
    ob_start();
    include $_SERVER['DOCUMENT_ROOT'].str_replace("/index.php","",($_SERVER['PHP_SELF']))."/templates/email/".$path.".php";
    $content = ob_get_contents();
    ob_clean();
    return $content;  
}
function _curlPost(){
    $ch = curl_init('http://www.example.com');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($ch);
    curl_close($ch);
    var_dump($response);
}
function currentDate(){
    return date("Y-m-d H:i:s"); 
}
function passwordEncode($password){
    global $func,$config;
    return $func->encrypt_password($config['website']['secret'], $password,$config['website']['salt']);
}
function checkActive($type,$id){
    global $model;
    return $model->get("active-type")==$type && $model->get("active-id")==$id;
}
function baseUrl($admin=true){
    global $config_base,$config;
	if($admin){
		return $config_base;
	}
	return str_replace("/".$config['admin']."/","",$config_base)."/";
}
function _baseUrl($url=null){
    global $config;
    return baseUrl().$url;
}
function isAjaxRequest(){
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
		return true;
	return false;
}
function showProduct($v){
	global $lang,$func,$sluglang;
	?>
	<div class="product">
            <a class="box-product text-decoration-none" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                <p class="pic-product scale-img"><img onerror="this.src='<?=THUMBS?>/270x270x2/assets/images/noimage.png';" src="thumbs/270x270x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"/></p>
                <h3 class="name-product "><?=$v['ten'.$lang]?></h3>
               <p class="price-product">
                    <?php if($v['giakm']) { ?>
                        <div class='d-flex justify-content-between'>
                            <span class="price-new"><?=$func->format_money($v['giamoi'])?></span>
                            <span class="price-old"><?=$func->format_money($v['gia'])?></span>
                        </div>
                        <span class="price-per"><?='-'.$v['giakm'].'%'?></span>
                    <?php } else { ?>
                        <span class="price-new d-block w-100 text-center"><?=($v['gia']) ? $func->format_money($v['gia']) : lienhe?></span>
                    <?php } ?>
                </p>
            </a>
            <?php /*<p class="cart-product w-clear">
                <span class="cart-add addcart transition" data-id="<?=$v['id']?>" data-action="addnow">Thêm vào giỏ hàng</span>
                <span class="cart-buy addcart transition" data-id="<?=$v['id']?>" data-action="buynow">Mua ngay</span>
            </p>*/?>
        </div>
    <?php 
}

function showProductz($v){
	global $lang,$func,$sluglang;
	?>
	 <div class="product">
            <a class="box-product text-decoration-none" href="<?=$product[$i][$sluglang]?>" title="<?=$product[$i]['ten'.$lang]?>">
                <p class="pic-product scale-img"><img onerror="this.src='<?=THUMBS?>/270x270x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/270x270x1/<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/></p>
                <h3 class="name-product text-split"><?=$product[$i]['ten'.$lang]?></h3>
                <p class="price-product">
                    <?php if($product[$i]['giakm']) { ?>
                        <span class="price-new"><?=$func->format_money($product[$i]['giamoi'])?></span>
                        <span class="price-old"><?=$func->format_money($product[$i]['gia'])?></span>
                        <span class="price-per"><?='-'.$product[$i]['giakm'].'%'?></span>
                    <?php } else { ?>
                        <span class="price-new"><?=($product[$i]['gia']) ? $func->format_money($product[$i]['gia']) : lienhe?></span>
                    <?php } ?>
                </p>
            </a>
            <p class="cart-product w-clear">
                <span class="cart-add addcart transition" data-id="<?=$product[$i]['id']?>" data-action="addnow">Thêm vào giỏ hàng</span>
                <span class="cart-buy addcart transition" data-id="<?=$product[$i]['id']?>" data-action="buynow">Mua ngay</span>
            </p>
        </div>
    <?php 
}
function phone($str){
	return preg_replace( '/[^0-9]/', '', $str );
}
function showNewsMenu($type){
	global $d,$lang,$sluglang;
	$ttlistmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_list where type = ? and hienthi > 0 order by stt,id desc",array($type));
 if(count($ttlistmenu)) { ?>
        <ul>
            <?php for($i=0;$i<count($ttlistmenu); $i++) {
                $ttcatmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($ttlistmenu[$i]['id'])); ?>
                <li>
                    <a class="transition" title="<?=$ttlistmenu[$i]['ten'.$lang]?>" href="<?=$ttlistmenu[$i][$sluglang]?>"><?=$ttlistmenu[$i]['ten'.$lang]?></a>
                    <?php if(count($ttcatmenu)>0) { ?>
                        <ul>
                            <?php for($j=0;$j<count($ttcatmenu);$j++) {
                                $ttitemmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_item where id_cat = ? and hienthi > 0 order by stt,id desc",array($ttcatmenu[$j]['id'])); ?>
                                <li>
                                    <a class="transition" title="<?=$ttcatmenu[$j]['ten'.$lang]?>" href="<?=$ttcatmenu[$j][$sluglang]?>"><?=$ttcatmenu[$j]['ten'.$lang]?></a>
                                    <?php if(count($ttitemmenu)) { ?>
                                        <ul>
                                            <?php for($u=0;$u<count($ttitemmenu);$u++) {
                                                $ttsubmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_sub where id_item = ? and hienthi > 0 order by stt,id desc",array($ttitemmenu[$u]['id'])); ?>
                                                <li>
                                                    <a class="transition" title="<?=$ttitemmenu[$u]['ten'.$lang]?>" href="<?=$ttitemmenu[$u][$sluglang]?>"><h2><?=$ttitemmenu[$u]['ten'.$lang]?></h2></a>
                                                    <?php if(count($ttsubmenu)) { ?>
                                                        <ul>
                                                            <?php for($s=0;$s<count($ttsubmenu);$s++) { ?>
                                                                <li>
                                                                    <a class="transition" title="<?=$ttsubmenu[$s]['ten'.$lang]?>" href="<?=$ttsubmenu[$s][$sluglang]?>"><?=$ttsubmenu[$s]['ten'.$lang]?></a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    <?php 
	}
}

function showComment(){
	global $func;
	echo '<div class="fb-comments" data-href="'.$func->getCurrentPageURL().'" data-width="100%" data-numposts="5" data-order-by="reverse_time"></div>';
}
function VND($price){
	global $optsetting,$lang;
	if($lang=="vi")
		return $price;
	return $price * preg_replace( '/[^0-9]/', '', $optsetting['ratio']);
}
function toVND($price){
	global $optsetting;
	return $price * preg_replace( '/[^0-9]/', '', $optsetting['ratio']);
}
function toNumber($n){
	return preg_replace( '/[^0-9]/', '', $n);
}
function toUSD($price){
	global $optsetting;
	return toNumber($price) / toNumber($optsetting['ratio']);
}
function _price($price,$format=true){
	global $func;
    $lang = "vi";
	if($lang=="vi")
		return ($format)?'$'.number_format($price,0, '.', '.'):$price;
	return ($format)?$func->myformat(VND($price)):VND($price);
	
	
	
}

function showPrice($value){
	global $lang,$func;
	$str = '';
	if($value['gia'] && $value['giamoi']){
		if($lang=="vi"){
			$str.= '<div class="price_product">$<span>'.number_format($value['gia'],2, '.', '.').'</span></div>';
			$str.= '<div class="price_old_detail">$<span>'.(($value['giamoi'])?number_format($value['giamoi'],2, '.', '.'):'').'</span></div>';
		}else{
			$str.= '<div class="price_product"><span>'.$func->myformat(VND($value['gia'])).'</span></div>';
			$str.= '<div class="price_old_detail"><span>'.$func->myformat(VND($value['giamoi'])).'</span></div>';
		}
	}elseif($value['gia']){
		$str.='<div class="price_product">'.(($lang=="vi")?('$<span>'.number_format($value['gia'],2, '.', '.').'</span>'):('<span>'.$func->myformat(VND($value['gia'])).'</span>')).'</span></div>';
	}else{
		$str.='<div class="price_product"><span>'.Contact.'</span></div>';
	}
	
	return $str;
								
				
	
}