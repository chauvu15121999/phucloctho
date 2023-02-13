<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="box-slider clearfix">
    <div class="wap_l">
        <?php 
		
		if(!empty($arr_tuvan)){ ?>
            <table class="tbl_tuvan" cellspacing="0">
                <thead>
                    <th align="center">TT</th>
                    <th>NAME</th>
                </thead>
                <tbody>
                    <?php $stt = 1 + $page*$pageSize; foreach($arr_tuvan as $v){  ?>
                        <tr>
                            <td align="center"><?=$stt?></td>
                            <td><?=$v['tencty']?></td>
                        </tr>
                    <?php $stt++; } ?>
                </tbody>
            </table>
            <div class="clear"></div>
            <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
        <?php } ?>
    </div>
    <div class="wap_r">
        <?php include _template."layout/left.php";?>
    </div>
</div>