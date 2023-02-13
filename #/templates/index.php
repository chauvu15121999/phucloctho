<!DOCTYPE html>
<html lang="<?=$config['website']['lang-doc']?>">
<head>
    <?php include TEMPLATE.LAYOUT."head.php"; ?>
    <?php include TEMPLATE.LAYOUT."css.php"; ?>
	<style>.mask,#loading{display:none !Important}</style>
</head>
<body>
    <?php
        if($source=='index' && !$func->isGoogleSpeed()) include TEMPLATE.LAYOUT."loading.php";
        include TEMPLATE.LAYOUT."seo.php";
        include TEMPLATE.LAYOUT."header.php";
        include TEMPLATE.LAYOUT."mmenu.php";
        if($source=='index') { if(!$func->isGoogleSpeed()) { include TEMPLATE.LAYOUT."slide.php"; } }
        else { include TEMPLATE.LAYOUT."breadcrumb.php"; }
    ?>
    <div class="wrap-main <?=($source=='index')?'wrap-home':''?> w-clear">
        <?php include TEMPLATE.LAYOUT."category.php"; ?>
        <?php include TEMPLATE.$template."_tpl.php"; ?>
    </div>
    <?php
        include TEMPLATE.LAYOUT."footer.php";
        include TEMPLATE.LAYOUT."modal.php";
        include TEMPLATE.LAYOUT."js.php";
        if($deviceType=='mobile') include TEMPLATE.LAYOUT."phone.php";
    ?>
</body>
</html>