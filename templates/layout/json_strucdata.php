<script type="application/ld+json">
    {
      "@context" : "https://schema.org",
      "@type" : "Organization",
      "name" : "<?=$row_setting['ten']?>",
      "url" : "https://www.hungvuongmeecoltd.com/",
      "sameAs" : [
      <?php $sum_mxh = count($mxh); if($sum_mxh>0){ foreach ($mxh as $key => $value) { ?>
        "<?=$value['url']?>"<?=(($key+1)<$sum_mxh)?',':''?>
      <?php }} ?>
       ],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?=$row_setting['diachi']?>",
        "addressRegion": "Ho Chi Minh",
        "postalCode": "70000",
        "addressCountry": "vi"
      }
    }
</script>
<?php if($template=='product_detail') {
    /*if($row_detail['sao']!=0){
      $sao= $row_detail['sao'];
    }else{
      $sao=4.4;
    }
    if($row_detail['luot']!=0){
      $luot= $row_detail['luot'];
    }else{
      $luot=89;
    }
	if($row_detail['luot']!=0){
      $luot= $row_detail['luot'];
    }else{
      $luot=89;
    }
	*/
	 
	
  ?>
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "<?=$row_detail['ten']?>",
      "image": [
        "<?=$http.$config_url?>/<?=_upload_sanpham_l.$row_detail['photo']?>"
        ],
      "description": "<?=$description?>",
      "sku":"SP0<?=$row_detail['id']?>",
      "mpn": "<?=$row_detail['id']?>",
      "brand": {
        "@type": "Brand",
        "name": "<?=$struct_name?>"
      },
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "<?=$sao > 0 ? $sao : $row_detail['sao']?>",
          "bestRating": "5"
        },"author": {
          "@type": "Person",
          "name": "<?=$company['ten']?>"
        }
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?=$sao > 0 ? $sao : $row_detail['sao']?>",
        "reviewCount": "<?=$luot > 0 ? $luot : $row_detail['luot']?>"
      },

      "offers": {
        "@type": "Offer",
        "url":"<?=getCurrentPageURL()?>",
        "priceCurrency": "VND",
        "price": "<?=$row_detail['gia']?>",
        "priceValidUntil": "2099-11-05",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "Executive Objects"
        }
      }
    }
</script>
<?php } ?>
<?php if($template=='news_detail'){?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://google.com/article"
      },
      "headline": "<?=$row_detail['ten']?>",
      "image": [
        "<?=$http.$config_url?>/<?=_upload_tintuc_l.$row_detail['photo']?>"
        ],
      "datePublished": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
      "dateModified": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
      "author": {
        "@type": "Person",
        "name": "<?=$company['ten']?>"
      },
       "publisher": {
        "@type": "Organization",
        "name": "Google",
        "logo": {
          "@type": "ImageObject",
          "url": "<?=$http.$config_url?>/<?=_upload_hinhanh_l.$logo_top['photo_'.$lang]?>"
        }
      },
      "description": "<?=$description_bar?>"
    }
    </script>

<?php }?>

<?php if($template=='about'){?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://google.com/article"
      },
      "headline": "<?=$row_detail['ten_vi']?>",
      "image": [
        "<?=$http.$config_url?>/<?=_upload_hinhanh_l.$row_detail['photo']?>"
        ],
      "datePublished": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
      "dateModified": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
      "author": {
        "@type": "Person",
        "name": "<?=$row_setting['ten_'.$lang]?>"
      },
       "publisher": {
        "@type": "Organization",
        "name": "Google",
        "logo": {
          "@type": "ImageObject",
          "url": "<?=$http.$config_url?>/<?=_upload_hinhanh_l.$logo_top['photo_'.$lang]?>"
        }
      },
      "description": "<?=$description_bar?>"
    }
    </script>

<?php }?>