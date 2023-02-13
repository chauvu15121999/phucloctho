<?php  
	if(!defined('SOURCES')) die("Error");

	$popup = $d->rawQueryOne("select ten$lang, photo, link, hienthi from #_photo where type = ? and act = ? limit 0,1",array('popup','photo_static'));
    $slider = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide'));
    $slogan_product = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('slogan-san-pham'));
    $product_new = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, id_mau, id_size, photo from #_product where type = ? and moi > 0 and hienthi > 0 order by stt,id desc limit 0,10",array('san-pham'));
   
    $slogan_news = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('slogan-tin-tuc'));
    $news_home = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc limit 0,10",array('tin-tuc'));
    $slogan_video = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('slogan-video'));
    $slogan_fanpage = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('slogan-fanpage'));
    $icon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? limit 0,1",array('icon','photo_static'));
    $partner = $d->rawQuery("select ten$lang, link, photo from #_photo where type = ? and hienthi > 0 order by stt, id desc",array('doitac'));

    $product_list = $d->rawQuery("select ten$lang, photo,mota$lang, tenkhongdauvi, tenkhongdauen, id, menu, noibat, photo2, photo3 from #_product_list where type = ? and hienthi > 0 and noibat > 0 order by stt,id desc",array('san-pham'));

    /* SEO */
    $seoDB = $seo->getSeoDB(0,'setting','capnhat','setting');
    if(!empty($seoDB['title'.$seolang])) $seo->setSeo('h1',$seoDB['title'.$seolang]);
    if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
    if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
    if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
    $seo->setSeo('url',$func->getPageURL());
    $img_json_bar = (!empty($logo['options'])) ? json_decode($logo['options'],true) : null;
    if(empty($img_json_bar) || ($img_json_bar['p'] != $logo['photo']))
    {
        $img_json_bar = $func->getImgSize($logo['photo'],UPLOAD_PHOTO_L.$logo['photo']);
        $seo->updateSeoDB(json_encode($img_json_bar),'photo',$logo['id']);
    }
    if(!empty($img_json_bar))
    {
        $seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PHOTO_L.$logo['photo']);
        $seo->setSeo('photo:width',$img_json_bar['w']);
        $seo->setSeo('photo:height',$img_json_bar['h']);
        $seo->setSeo('photo:type',$img_json_bar['m']);
    }
?>