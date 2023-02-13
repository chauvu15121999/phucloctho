<!-- Js Config -->
<script type="text/javascript">
    var _toast = [];
    <?php 
        $t = $model->getFlash("toast");
        if($t){
            ?>
            var _toast = <?=json_encode($t)?>;
            <?php 
        }
    ?>
    const PRICE = <?=$optsetting['price']?>;
    const CURRENT_LANG = "<?=$lang?>";
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var CONFIG_BASE = '<?=$config_base?>';
    var WEBSITE_NAME = '<?=(!empty($setting['ten'.$lang])) ? addslashes($setting['ten'.$lang]) : ''?>';
    var SHIP_CART = <?=(!empty($config['order']['ship'])) ? 'true' : 'false'?>;
    var GOTOP = 'assets/images/top.png';
    var LANG = {
        'no_keywords': '<?=chuanhaptukhoatimkiem?>',
        'delete_product_from_cart': '<?=banmuonxoasanphamnay?>',
        'no_products_in_cart': '<?=khongtontaisanphamtronggiohang?>',
        'wards': '<?=phuongxa?>',
        'back_to_home': '<?=vetrangchu?>',
    };
</script>
<script>
    var _version = "<?=$config['version']?>";
</script>

<!-- Js Files -->
<?php
    $js->setCache("cached");
    $js->setJs("./assets/js/jquery.min.js");
    $js->setJs("./assets/js/lazyload.min.js");
    $js->setJs("./assets/bootstrap/bootstrap.js");
    $js->setJs("./assets/js/pixelentity-shiner.js");
    $js->setJs("./assets/js/wow.min.js");
    $js->setJs("./assets/confirm/confirm.js");
    $js->setJs("./assets/mmenu/mmenu.js");
    $js->setJs("./assets/simplyscroll/jquery.simplyscroll.js");
    $js->setJs("./assets/owlcarousel2/owl.carousel.js");
    $js->setJs("./assets/magiczoomplus/magiczoomplus.js");
    $js->setJs("./assets/js/popper.min.js");
    $js->setJs("./assets/js/jnoty.min.js");
    $js->setJs("./assets/toc/toc.js");
    $js->setJs("./assets/js/functions.js");
    $js->setJs("./assets/litepicker/litepicker.js");
    $js->setJs("./assets/js/apps.js");
    echo $js->getJs();
?>

<?php if(!empty($config['googleAPI']['recaptcha']['active'])) { ?>
    <!-- Js Google Recaptcha V3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$config['googleAPI']['recaptcha']['sitekey']?>"></script>
    <script type="text/javascript">
        grecaptcha.ready(function () {
            grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'Newsletter' }).then(function (token) {
                var recaptchaResponseNewsletter = document.getElementById('recaptchaResponseNewsletter');
                recaptchaResponseNewsletter.value = token;
            });
            <?php if($source=='contact') { ?>
                grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'contact' }).then(function (token) {
                    var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
                    recaptchaResponseContact.value = token;
                });
            <?php } ?>
        });
    </script>
<?php } ?>

<?php if(!empty($config['oneSignal']['active'])) { ?>
    <!-- Js OneSignal -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?=$config['oneSignal']['id']?>"
            });
        });
    </script>
<?php } ?>

<!-- Js Structdata -->
<?php include TEMPLATE.LAYOUT."strucdata.php"; ?>

<!-- Js Addons -->
<?=$addons->setAddons('script-main', 'script-main', 0.5);?>
<?=$addons->getAddons();?>

<!-- Js Body -->
<?=htmlspecialchars_decode($setting['bodyjs'])?>