<div class="menu-res">
    <div class="menu-bar-res">
        <a id="hamburger" href="#menu" title="Menu"><span></span></a>
        <a class="logo-res" href="">
            <img class="lazy" onerror="this.src='<?=THUMBS?>/200x40x1/assets/images/noimage.png';" data-src="<?=THUMBS?>/200x40x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>"/>
        </a>
        <div class="search-res">
            <p class="icon-search transition"><i class="fa fa-search"></i></p>
            <div class="search-grid w-clear">
                <input type="text" name="keyword-res" id="keyword-res" placeholder="Nhập sản phẩm cần tìm ..." onkeypress="doEnter(event,'keyword-res');"/>
                <p onclick="onSearch('keyword-res');"><i class="fa fa-search"></i></p>
            </div>
        </div>
    </div>
    <nav id="menu">
        <ul>
            <li><a href="" title="<?=trangchu?>"><?=trangchu?></a></li>
            <?php if(!empty($product_list)) { foreach($product_list as $klist => $vlist) { if(!empty($vlist['menu'])) { ?>
                <li>
                    <a title="<?=$vlist['ten'.$lang]?>" href="<?=$vlist[$sluglang]?>"><?=$vlist['ten'.$lang]?></a>
                    <?php if(!empty($product_cat)) { ?>
                        <ul>
                            <?php foreach($product_cat as $kcat => $vcat) { if($vcat['id_list'] == $vlist['id']) { ?>
                                <li>
                                    <a title="<?=$vcat['ten'.$lang]?>" href="<?=$vcat[$sluglang]?>"><?=$vcat['ten'.$lang]?></a>
                                    <?php if(!empty($product_item)) { ?>
                                        <ul>
                                            <?php foreach($product_item as $kitem => $vitem) { if($vitem['id_cat'] == $vcat['id']) { ?>
                                                <li>
                                                    <a title="<?=$vitem['ten'.$lang]?>" href="<?=$vitem[$sluglang]?>"><?=$vitem['ten'.$lang]?></a>
                                                    <?php if(!empty($product_sub)) { ?>
                                                        <ul>
                                                            <?php foreach($product_sub as $ksub => $vsub) { ?>
                                                                <li>
                                                                    <a title="<?=$vsub['ten'.$lang]?>" href="<?=$vsub[$sluglang]?>"><?=$vsub['ten'.$lang]?></a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } } } ?>
            <li><a href="promotion" title="<?=khuyenmai?>"><?=khuyenmai?></a></li>
            <li><a href="news" title="<?=tintuc?>"><?=tintuc?></a></li>
            <li>
                <a title="policies"><?=chinhsach?></a>
                <ul>
                    <?php foreach($policy as $v) { ?>
                        <li><a href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="lien-he" title="<?=lienhe?>"><?=lienhe?></a></li>
        </ul>
    </nav>
</div>