<?php
    /* Sản phẩm */
    $nametype = "san-pham";
    $config['product'][$nametype]['title_main'] = "Sản Phẩm";
    $config['product'][$nametype]['dropdown'] = true;
    $config['product'][$nametype]['gia'] = true;
    $config['product'][$nametype]['giacu'] = true;
    $config['product'][$nametype]['list'] = true;
    $config['product'][$nametype]['cat'] = true;
    $config['product'][$nametype]['item'] = false;
    $config['product'][$nametype]['mau'] = false;
    $config['product'][$nametype]['size'] = false;
    $config['product'][$nametype]['view'] = false;
    $config['product'][$nametype]['copy'] = false;
    $config['product'][$nametype]['brand'] = false;
    $config['product'][$nametype]['slug'] = true;
    $config['product'][$nametype]['check'] = array("moi" => "Mới", "noibat" => "Nổi bật");
    $config['product'][$nametype]['images'] = true;
    $config['product'][$nametype]['show_images'] = true;
	
    $config['product'][$nametype]['gallery'] = array
    (
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh sản phẩm",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 2,
            "images_photo" => true,
            "cart_photo" => true,
            "avatar_photo" => true,
            "tieude_photo" => true,
            "width_photo" => 280*2,
            "height_photo" => 345*2,
            "thumb_photo" => '80x100x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        )
    );
    $config['product'][$nametype]['ma'] = true;
    $config['product'][$nametype]['mota'] = true;
    $config['product'][$nametype]['mota_cke'] = true;
    $config['product'][$nametype]['noidung'] = true;
    $config['product'][$nametype]['noidung_cke'] = true;
    $config['product'][$nametype]['seo'] = true;
    $config['product'][$nametype]['width'] = 280;
    $config['product'][$nametype]['height'] = 345;
    $config['product'][$nametype]['thumb'] = '80x100x2';
    $config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm (Màu) */
    $config['product'][$nametype]['mau_mau'] = true;

    /* Sản phẩm (List) */
    $config['product'][$nametype]['title_main_list'] = "Sản phẩm cấp 1";
    $config['product'][$nametype]['images_list'] = true;
    $config['product'][$nametype]['show_images_list'] = true;
    $config['product'][$nametype]['images2_list'] = false;
    $config['product'][$nametype]['show_images2_list'] = false;
    $config['product'][$nametype]['images3_list'] = false;
    $config['product'][$nametype]['show_images3_list'] = false;
    $config['product'][$nametype]['slug_list'] = true;
    $config['product'][$nametype]['check_list'] = array("menu" => "Menu", "noibat" => "Nổi bật");
    $config['product'][$nametype]['mota_list'] = true;
    $config['product'][$nametype]['noidung_list'] = true;
    $config['product'][$nametype]['noidung_cke_list'] = true;
    $config['product'][$nametype]['seo_list'] = true;
    $config['product'][$nametype]['width_list'] = 300;
    $config['product'][$nametype]['height_list'] = 200;
    $config['product'][$nametype]['thumb_list'] = '100x100x2';
    $config['product'][$nametype]['width2_list'] = 380;
    $config['product'][$nametype]['height2_list'] = 780;
    $config['product'][$nametype]['thumb2_list'] = '80x100x2';
    $config['product'][$nametype]['width3_list'] = 1200;
    $config['product'][$nametype]['height3_list'] = 250;
    $config['product'][$nametype]['thumb3_list'] = '100x80x2';
    $config['product'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm (Cat) */
    $config['product'][$nametype]['title_main_cat'] = "Sản phẩm cấp 2";
    $config['product'][$nametype]['images_cat'] = true;
    $config['product'][$nametype]['show_images_cat'] = true;
    $config['product'][$nametype]['slug_cat'] = true;
    $config['product'][$nametype]['check_cat'] = array();
    $config['product'][$nametype]['seo_cat'] = true;
    $config['product'][$nametype]['width_cat'] = 300;
    $config['product'][$nametype]['height_cat'] = 200;
    $config['product'][$nametype]['thumb_cat'] = '100x100x2';
    $config['product'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm (Item) */
    $config['product'][$nametype]['title_main_item'] = "Sản phẩm cấp 3";
    $config['product'][$nametype]['images_item'] = true;
    $config['product'][$nametype]['show_images_item'] = true;
    $config['product'][$nametype]['slug_item'] = true;
    $config['product'][$nametype]['check_item'] = array();
    $config['product'][$nametype]['seo_item'] = true;
    $config['product'][$nametype]['width_item'] = 300;
    $config['product'][$nametype]['height_item'] = 200;
    $config['product'][$nametype]['thumb_item'] = '100x100x2';
    $config['product'][$nametype]['img_type_item'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm (Hãng) */
    $config['product'][$nametype]['title_main_brand'] = "Hãng sản phẩm";
    $config['product'][$nametype]['images_brand'] = true;
    $config['product'][$nametype]['show_images_brand'] = true;
    $config['product'][$nametype]['slug_brand'] = true;
    $config['product'][$nametype]['check_brand'] = array("noibat" => "Nổi bật");
    $config['product'][$nametype]['seo_brand'] = true;
    $config['product'][$nametype]['width_brand'] = 150;
    $config['product'][$nametype]['height_brand'] = 150;
    $config['product'][$nametype]['thumb_brand'] = '100x100x1';
    $config['product'][$nametype]['img_type_brand'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';