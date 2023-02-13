<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="<?=_upload_hinhanh_l.$company['faviconthumb']?>" type="image/x-icon" />
<META NAME="ROBOTS" CONTENT="<?=$meta_robots?>" />
<meta name="author" content="<?=$company['ten']?>" />
<meta name="copyright" content="<?=$company['ten']?> [<?=$company['email']?>]" />
<title><?php if($title!='')echo $title;else echo $company['title'];?></title>
<meta name="keywords" content="<?php if($keywords!='')echo $keywords;else echo $company['keywords'];?>" />
<meta name="description" content="<?php if($description!='')echo $description;else echo $company['description'];?>" />
<meta name="DC.title" content="<?php if($title!='')echo $title;else echo $company['title'];?>" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="<?=$company['diachi']?>" />
<meta name="geo.position" content="<?=str_replace(',',':',$company['toado'])?>" />
<meta name="ICBM" content="<?=$company['toado']?>" />
<meta property="og:image" content="<?=$images_facebook?>" />
<meta property="og:title" content="<?=$title_facebook?>" />
<meta property="og:url" content="<?=$url_facebook?>" />
<meta property="og:description" content="<?=$description_facebook?>" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="<?=$company['ten']?>" />
<meta name="format-detection" content="telephone=no">
<link rel="canonical" href="<?=getCurrentPageURL();?>" />
<?php if($id>0 or $source=='about') { ?>
	<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51c3fae12493146d"></script>
<?php } ?>
