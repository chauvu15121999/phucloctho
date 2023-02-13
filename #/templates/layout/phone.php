<div class="fixbar">
    <ul class="w-clear">
        <li>
            <a href="">
                <span class="icon-home-new"><i class="fa fa-home" aria-hidden="true"></i></span><span class="text-link-toolbar"><?=trangchu?></span>
            </a>
        </li>
        <li>
            <a href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?> ">
                <span class="icon-cart-new"><i class="fa fa-phone-square" aria-hidden="true"></i></span><span class="text-link-toolbar"><?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?></span>
            </a>
        </li>
        <li>
            <a href="contact-us">
                <span class="icon-hotdeal-new"><i class="fa fa-map-marker" aria-hidden="true"></i></span><span class="text-link-toolbar"><?=lienhe?></span>
            </a>
        </li>
        <li>
            <a href="cart">
                <span class="icon-cart-mobile">
                    <span id="cart-total" class="cart-total-header cart-total-header-mobile">
                        <span class="count-cart"><?=(!empty($_SESSION['cart'])) ? count($_SESSION['cart']) : 0?></span>
                    </span>
                </span>
                <span class="text-link-toolbar"><?=giohang?></span>
            </a>
        </li>
    </ul>
</div>