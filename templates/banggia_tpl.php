<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="box_container">
<div class="content">
<table class="tbl_banggia">
    <tr>
        <th class="an_mobi">STT</th>
        <th>Tên</th>
        <th>Download</th>
        <th class="an_mobi">Ngày cập nhật</th>
    </tr>
	<?php foreach($tintuc as $k => $v) { ?>
        <tr>
        <td class="an_mobi"><?=$k+1?></td>
        <td><?=$v['ten']?></td>
        <td><a href="<?=_upload_tintuc_l.$v['photo']?>" target="_blank">Tải về</a></td>
        <td class="an_mobi"><?=make_date($v['ngaytao']);?></td>
    </tr>
    <?php } ?>
</table>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div>
</div><!---END .box_container-->