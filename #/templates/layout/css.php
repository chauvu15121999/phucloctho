<!-- Css Fonts -->
<?php if(!$func->isGoogleSpeed()) { ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
<?php } ?>

<!-- Css Files -->
<?php
    $css->setCache("cached");
    $css->setCss("./assets/css/animate.min.css");
    $css->setCss("./assets/bootstrap/bootstrap.css");
    $css->setCss("./assets/fonts/fontello/css/pinterest.css");
    $css->setCss("./assets/fontawesome512/all.css");
    $css->setCss("./assets/confirm/confirm.css");
    $css->setCss("./assets/mmenu/mmenu.css");
    $css->setCss("./assets/css/cart.css");
    $css->setCss("./assets/simplyscroll/jquery.simplyscroll.css");
    $css->setCss("./assets/simplyscroll/jquery.simplyscroll-style.css");
    $css->setCss("./assets/magiczoomplus/magiczoomplus.css");
    $css->setCss("./assets/owlcarousel2/owl.carousel.css");
    $css->setCss("./assets/owlcarousel2/owl.theme.default.css");
    $css->setCss("./assets/css/jnoty.min.css");
    $css->setCss("./assets/litepicker/css/litepicker.css");

    $css->setCss("./assets/css/style.css");
    echo $css->getCss();
?>

<!-- Js Google Analytic -->
<?=htmlspecialchars_decode($setting['analytics'])?>

<!-- Js Head -->
<?=htmlspecialchars_decode($setting['headjs'])?>