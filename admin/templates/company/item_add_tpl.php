<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=company&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
                       <li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
	function TreeFilterChanged2(){
				$('#validate').submit();
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=company&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
    <div class="title"><img src="./images/icons/dark/users.png" alt="" class="titleIcon" />
			<h6>Thông tin công ty</h6>
		</div>
		<ul class="tabs">
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li><a href="#content_lang_2<?=$key?>"><?=$value?></a></li>
           <?php } ?>
       </ul>
       <?php foreach ($config['lang'] as $key => $value) { ?>
        <div id="content_lang_2<?=$key?>" class="tab_content">

		<div class="formRow">
			<label>Tên</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten'.$key]?>" name="ten<?=$key?>" title="Nhập tên công ty" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

    <div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['diachi'.$key]?>" name="diachi<?=$key?>" title="Nhập địa chỉ công ty" class="tipS" onblur="showAddress(this.value);" />
			</div>
			<div class="clear"></div>
		</div>

    <div class="formRow">
      <label>Kho</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['kho']?>" name="kho" title="Nhập địa chỉ công ty" class="tipS" onblur="showAddress(this.value);" />
      </div>
      <div class="clear"></div>
    </div>
	<div class="formRow">
      <label>MST</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['mst']?>" name="mst" title="Nhập địa mã số thuế" class="tipS" onblur="showAddress(this.value);" />
      </div>
      <div class="clear"></div>
    </div>
	<div class="formRow">
      <label>STK</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['stk']?>" name="stk" title="Nhập địa số tài khoản" class="tipS" onblur="showAddress(this.value);" />
      </div>
      <div class="clear"></div>
    </div>

    <?php if(in_array('slogan',$config['type'])) { ?>
      <div class="formRow">
  			<label>Slogan</label>
  			<div class="formRight">
  				<input type="text" value="<?=@$item['slogan'.$key]?>" name="slogan<?=$key?>" title="Nhập Slogan" class="tipS" />
  			</div>
  			<div class="clear"></div>
  		</div>
    <?php } ?>

		</div>
  <?php } ?>

		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ email" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

        <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập số điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
         <div class="formRow">
			<label>Zalo</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['fax']?>" name="fax" title="Nhập số fax" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        

    <?php if(in_array('giohoatdong',$config['type'])) { ?>
    <div class="formRow">
      <label>Giờ hoạt động</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['giohoatdong']?>" name="giohoatdong" title="Nhập số fax" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
  <?php }?>

    <?php if(in_array('zalo',$config['type'])) { ?>
    <div class="formRow">
      <label>Zalo</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['zalo']?>" name="zalo" title="Nhập số điện thoại" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
  <?php }?>

  <?php if(in_array('skype',$config['type'])) { ?>
    <div class="formRow">
      <label>Skype</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['skype']?>" name="skype" title="Nhập số điện thoại" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
  <?php }?>

		<div class="formRow">
			<label>Google map</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['googlemap']?>" name="googlemap" title="" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="formRow">
			<label>Website</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['website']?>" name="website" title="Nhập tên Website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Copyright</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['copy']?>" name="copy" title="Nhập copyright" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="formRow none">
			<label>Tìm địa chỉ</label>
			<div class="formRight">
             <input Class="tipS" id="AddressNumber" name="AddressNumber" type="text" value="" style="width:80% !important" />
             <input type="button" value="Tìm địa điểm" class="button_83 blueB" id="button_83" /><br /><br />
			</div>
			<div class="clear"></div>
	</div>
    <div class="formRow none">
			<label>Tọa độ hiện tại</label>
			<div class="formRight">
            <input type="text" name="toado" value="<?=$item['toado']?>" class="tipS" />
			</div>
			<div class="clear"></div>
	</div>
    <div class="form-editor content-item-map none">
        <div class="map-wrapper">
            <div class="map-content">
                <div id="BanDo" class="map-edit"></div>
            </div>
        </div>
        <div id="tienich" style="display:none"></div><!--tienich-->
        <div style="display:none">
            <input type="text" id="address" value="<?=@$item['diachi']?>" />
            <input type="button" class="button primaryAction btn btn-primary" value="Go" onclick="geocode()" />
            <?php
                $la=0;
                $lo=0;
                if($item['toado']!=''){
                    $arr_tmp=explode(',', $item['toado']);
                    $la=$arr_tmp[0];
                    $lo=$arr_tmp[1];
                }
            ?>
            <input id="Latitude" name="Latitude" type="text" value="<?=$la?>" />
            <input id="Longitude" name="Longitude" type="text" value="<?=$lo?>" />
        </div>
    </div>
    </div>


	 <div class="widget">
 	    <div class="title"><img src="./images/icons/dark/users.png" alt="" class="titleIcon" />
			<h6>Thông tin thêm</h6>
		</div>
        <div class="formRow">
			<label>Favicon</label>
			<div class="formRight">
             <?php if ($_REQUEST['act']=='capnhat') { ?>
                         <img width="32" src="<?=_upload_hinhanh.$item['faviconthumb']?>">
                    <br>
                    <?php }?>

				<input type="file" id="file" name="favicon" /> <img src="./images/question-button.png" alt="Upload favicon" class="icon_question tipS" original-title="Tải hình đại diện website (ảnh JPEG, GIF , JPG , PNG)">
                <div class="note"> Height:32px | Width:32px  <?=_format_duoihinh_l?> </div>
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Hoa</label>
			<div class="formRight">
             <?php if ($_REQUEST['act']=='capnhat') { ?>
                         <img width="32" src="<?=_upload_hinhanh.$item['img_hoa']?>">
                    <br>
                    <?php }?>

				<input type="file" id="img_hoa" name="img_hoa" /> <img src="./images/question-button.png" alt="Upload hoa" class="icon_question tipS" original-title="Tải hình đại diện website (ảnh JPEG, GIF , JPG , PNG)">
                <div class="note"> Height:32px | Width:32px  <?=_format_duoihinh_l?> </div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
          <label>Hiển thị hoa rơi : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">

            <input type="checkbox" name="hoaroi" id="check1" <?=(!isset($item['hoaroi']) || $item['hoaroi']==1)?'checked="checked"':''?> />
             
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow none">
			<label>Sitemap</label>
			<div class="formRight">
				<input type="file" id="file" name="sitemap" /> <img src="./images/question-button.png" alt="Upload Sitemap" class="icon_question tipS" original-title="Tải sitemap để seo website (Tên sitemap.xml)">
                <div class="note"><a href="../<?=$item['sitemap']?>" target="_blank" style="color:red;">Xem trực tiếp</a>  <strong>&nbsp;&nbsp;&nbsp;&nbsp;.xml, .XML </strong></div>
			</div>
			<div class="clear"></div>
		</div>

        <div class="formRow">
			<label>Fanpage</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['fanpage']?>" name="fanpage" title="Nhập địa chỉ fanpage" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

    

     <div class="formRow">
      <label>Youtube</label>
      <div class="formRight">
        <input type="text" value="<?=@$item['youtube']?>" name="youtube" title="Nhập địa chỉ Youtube" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>

   

     <div class="widget">
 	    <div class="title"><img src="./images/icons/dark/users.png" alt="" class="titleIcon" />
			<h6>Cấu hình web</h6>
		</div>

        <div class="formRow">
            <label>Ngôn ngữ mặc định:</label>
            <div class="formRight">
                <?php foreach ($config['lang'] as $key => $value) { ?>
                   <label><input <?php if($key==@$item['lang_default'])echo 'checked="checked"'; ?> type="radio" name="lang_default" value="<?=$key?>" /><?=$value?></label>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>

<?php if(in_array('sp',$config['type'])) { ?>
		<div class="formRow">
            <label>Số S.Phẩm/Trang:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="soluong_sp" value="<?=@$item['soluong_sp']?>"  title="Nhập số lượng sản phẩm trên 1 trang" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
      <?php }?>

      <?php if(in_array('spkhac',$config['type'])) { ?>
        <div class="formRow">
            <label>Số S.Phẩm khác/Trang:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="soluong_spk" value="<?=@$item['soluong_spk']?>"  title="Nhập số lượng sản phẩm khác trên 1 trang" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
      <?php }?>

      <?php if(in_array('tin',$config['type'])) { ?>
        <div class="formRow">
            <label>Số Tin/Trang:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="soluong_tin" value="<?=@$item['soluong_tin']?>"  title="Nhập số lượng tin tức trên 1 trang" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
      <?php }?>

      <?php if(in_array('tinkhac',$config['type'])) { ?>
        <div class="formRow">
            <label>Số Tin khác/Trang:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="soluong_tink" value="<?=@$item['soluong_tink']?>"  title="Nhập số lượng tin tức khác trên 1 trang" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
     </div>
    <?php }?>

     <div class="widget">
 	    <div class="title"><img src="./images/icons/dark/users.png" alt="" class="titleIcon" />
			   <h6>Thông tin Seo</h6>
		  </div>

        <div class="formRow">
            <label>H1</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['h1']?>" name="h1" title="" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>H2</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['h2']?>" name="h2" title="" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>H3</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['h3']?>" name="h3" title="" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
			<label>Title</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title']?>" name="title" title="Nhập title" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Keywords</label>
			<div class="formRight">
                <textarea rows="4" cols="" title="Nhập keywords,các từ hay cụm từ liên quan . " class="tipS" name="keywords"><?=@$item['keywords']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Description</label>
			<div class="formRight">
                <textarea rows="4" cols="" title="Nhập description,độ dài từ 60-170 ký tự (Quan trọng). " class="tipS" name="description"><?=@$item['description']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

    <div class="formRow">
			<label>Code Iframe bản đồ</label>
			<div class="formRight">
				<textarea rows="8" cols="" class="tipS description_input" name="bando" original-title="Nhập mã nhúng bản đồ"><?=@$item['bando']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

    <div class="formRow">
			<label>Code thêm header</label>
			<div class="formRight">
				<textarea rows="8" cols="" class="tipS description_input" name="codethem" original-title="Nhập thêm các code muốn thêm vào website như code chat,google analytics..."><?=@$item['codethem']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

         <div class="formRow">
			<label>Code thêm body</label>
			<div class="formRight">
				<textarea rows="8" cols="" class="tipS description_input" name="codethem2" original-title="Nhập thêm các code muốn thêm vào website như code chat,google analytics..."><?=@$item['codethem2']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

        <div class="formRow">
			<label>Code thêm body( only PC)</label>
			<div class="formRight">
				<textarea rows="8" cols="" class="tipS description_input" name="codethem3" original-title="Nhập thêm các code muốn thêm vào website như code chat,google analytics..."><?=@$item['codethem3']?></textarea>
			</div>
			<div class="clear"></div>
		</div>

        <div class="formRow">
			<div class="formRight">
                <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
     </div>
</form>

<style type="text/css">
.map-wrapper {
    width: 100%;
    height: 500px;
    border: 1px solid #BBBBBB;
}
.map-wrapper .map-content .map-edit {
    width: 100%;
    height: 500px;
}
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyACyJA0Ifi-Y2FmzHOrZYNMY5q4-qATAUg&sensor=false&libraries=places"></script>

<script type="text/javascript">
    if ($('.content-item-map').is(':visible')) {
        var map;
        var markers;
        var latlngs;
        var gRedIcon = new google.maps.MarkerImage("media/images/bds.png", new google.maps.Size(32, 45), new google.maps.Point(0, 0), new google.maps.Point(15, 45));
        var gSmallShadow = new google.maps.MarkerImage("mm_20_shadow.png", new google.maps.Size(22, 20), new google.maps.Point(0, 0), new google.maps.Point(6, 20));
        var infowindow;
        var geocoder;
        var divThongTin = "<div>Kéo thả nhà đến vị trí mới</div>";

        function initialize() {
            var olat, olng;
            olat = document.getElementById('Latitude').value;
            olng = document.getElementById('Longitude').value;
            if (olat == '' || olat == '0' || olng == '' || olng == '0') {
                olat = 10.77836;
                olng = 106.664468;
            }
            var mapOptions = {
                center: new google.maps.LatLng(olat, olng),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            latlngs = new google.maps.LatLng(olat, olng);
            map = new google.maps.Map(document.getElementById('BanDo'), mapOptions);
            geocoder = new google.maps.Geocoder();
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.bindTo('bounds', map);
            infowindow = new google.maps.InfoWindow();

            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
                icon: gRedIcon
            });
            if ((document.getElementById('Latitude').value != '' &&
             document.getElementById('Latitude').value != '0')
             && (document.getElementById('Longitude').value != ''
             && document.getElementById('Longitude').value != '0')) {
                marker.setPosition(new google.maps.LatLng(olat, olng));
            }
            markers = marker;
            google.maps.event.addListener(marker, 'dragstart', function () {
                var place = map.getCenter();
                updateMarkerPosition(place);

                google.maps.event.addListener(marker, 'drag', function () {
                    updateMarkerPosition(marker.getPosition());
                });

                google.maps.event.addListener(marker, 'dragend', function () {
                    geocodePosition(marker.getPosition());
                });

                marker.setPosition(place);
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(divThongTin);
                infowindow.open(map, marker);
            });

            google.maps.event.addListener(map, 'click', function (e) {
                geocoder.geocode(
              { 'latLng': e.latLng },
              function (results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                      if (results[0]) {
                          if (marker) {
                              marker.setPosition(e.latLng);
                          } else {
                              marker = new google.maps.Marker({
                                  position: e.latLng,
                                  map: map
                              });
                          }
                          //infowindow.setContent(divThongTin);
                          infowindow.open(map, marker);
                          updateMarkerPosition(marker.getPosition());
                          geocodePosition(marker.getPosition());
                          infowindow.setContent(divThongTin);
                      } else {
                          document.getElementById('geocoding').innerHTML =
                        'No results found';
                      }
                  } else {
                      document.getElementById('geocoding').innerHTML =
                      'Geocoder failed due to: ' + status;
                  }
              });
            });
        }

        function geocode() {
            var address = document.getElementById("address").value;
            console.log(address);
            geocoder.geocode({
                'address': address,
                'partialmatch': true
            }, geocodeResult);
        }

        function geocodeResult(results, status) {
            if (status == 'OK' && results.length > 0) {
                map.fitBounds(results[0].geometry.viewport);
                updateGeocodePosition(results[0].geometry.location); // Update Code Position
                markers.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng())); // lat() && lng()
                console.log(results[0].geometry.location);
				//alert(results);
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        }

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function (responses) {
                if (responses && responses.length > 0) {
                    updateMarkerAddress(responses[0].formatted_address);
                } else {
                    updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }

        //Update Geocode
        function updateGeocodePosition(latlng) {// lat() && lng()
            document.getElementById('Latitude').value = latlng.lat();
            document.getElementById('Longitude').value = latlng.lng();
            latlngs = latlng;
        }
        //Update Marker Position
        function updateMarkerPosition(latlng) {
            document.getElementById('Latitude').value = latlng.lat();
            document.getElementById('Longitude').value = latlng.lng();
            latlngs = latlng;
        }

        function updateMarkerAddress(str) {
            document.getElementById('address').value = str;
        }
        var markers = new Array();
        function timdiem(diadiems, radiuss) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = new Array();
            var request = {
                location: latlngs,
                radius: radiuss,
                types: diadiems
            };
            var service = new google.maps.places.PlacesService(map);
            service.search(request, callback);
        }
        function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place) {
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
            });

            markers[markers.length] = marker;

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    }

$("#button_83").click(function () {
		address=$(AddressNumber).val();
		//alert(address);
		$('#address').val(address);
		geocode();
});
</script>
