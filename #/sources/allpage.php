<?php
    if(!defined('SOURCES')) die("Error");

    /* Query allpage */
    $favicon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('favicon','photo_static'));
    $logo = $d->rawQueryOne("select id, photo, options from #_photo where type = ? and act = ? limit 0,1",array('logo','photo_static'));
    $slogan = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('slogan'));
    $social = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi'));
    $social2 = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi2'));
    $model->set("product_list",$d->rawQuery("select ten$lang, photo,mota$lang, tenkhongdauvi, tenkhongdauen, id, menu, noibat, photo2, photo3 from #_product_list where type = ? and hienthi > 0 and noibat > 0 order by stt,id desc",array('san-pham')));
    $product_cat = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, id_list from #_product_cat where id_list > 0 and type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
    $product_item = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, id_list, id_cat from #_product_item where id_list > 0 and id_cat > 0 and type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
    $footer = $d->rawQueryOne("select ten$lang, noidung$lang from #_static where type = ? limit 0,1",array('footer'));
    $policy = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo from #_news where type = ? and hienthi > 0 order by stt,id desc",array('chinh-sach'));

    /* Get statistic */
    $counter = $statistic->getCounter();
    $online = $statistic->getOnline();

    /* Newsletter */
    if(!empty($_POST['submit-newsletter']))
    {
        $responseCaptcha = $_POST['recaptcha_response_newsletter'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        if(($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true)
        {
            $dataNewsletter = (!empty($_POST['dataNewsletter'])) ? $_POST['dataNewsletter'] : null;

            if(!empty($dataNewsletter))
            {
                $data = array();
                $data['email'] = (!empty($dataNewsletter['email'])) ? htmlspecialchars($dataNewsletter['email']) : '';
                $data['ngaytao'] = time();
                $data['type'] = 'dangkynhantin';

                if($d->insert('newsletter',$data))
                {
                    $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.",$config_base);
                }
                else
                {
                    $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
                }
            }
            else
            {
                $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
            }
        }
        else
        {
            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
        }
    }
?>