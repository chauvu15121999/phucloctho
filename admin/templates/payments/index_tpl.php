<!-- CODE PHP -->
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/components/admin/breadcrums.php';
?>
<!-- END -->
<div class="row payments ps-2 pe-2">
    <div class="col-12 mt-2">
		<? 	
			$breadcrums = new Breadcrums();
			if(isset($_GET['key']) && $_GET['key']!=''){
				$searchBreakcrums = array(
					'title' => 'Kết quả tìm kiếm',
					'link' => "#",
					'current' => 'current'
				);
			} else {
				$searchBreakcrums = array(
					'title' => 'Tất cả',
					'link' => "#",
					'current' => 'current'
				);
			}
			$breadcrumsArr = array(
				array(
					'title' => 'Quản lý',
					'link' => "index.php?com=payments&act=get"
				),
				$searchBreakcrums
			);
			echo $breadcrums->renderBreadcrums($breadcrumsArr); 
		?>
    </div>
    <div class="col-12 mt-4">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <a href="index.php?com=payments&act=add" class='btn btn-outline-secondary ps-4 pe-4'>Thêm thanh toán</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <!-- <th scope="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Chọn tất cả
                                </label>
                            </div>
                        </th> -->
                        <th scope="col">#</th>
                        <th scope="col">Tên thanh toán</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Keyword</th>
                        <th scope="col">Ẩn/hiện </th>
                        <th scope="col">Mô tả </th>
                        <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($payments as $key => $pay) { ?>
                            <tr>
                                <!-- <th scope="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </th> -->
                                <th scope="row"><?= $key+1 ?></th>
                                <td><?= $pay['name'] ?></td>
                                <td><img src="<?=_upload_khac.$pay['image']?>" style="max-height:100px; max-width:100px;" /></td>
                                <td><?= $pay['codename'] ?></td>
                                <td><?= $pay['display'] == 1 ? 'Hiện thanh toán' : 'Ẩn thanh toán' ?></td>
                                <td><?= $pay['description'] ?></td>
                                <td>
                                    <a href="index.php?com=payments&act=update&id=<?= $pay['id'] ?>" class='btn btn-secondary pt-0 pb-0 ps-2 pe-2' data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thanh toán">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a  href="index.php?com=payments&act=delete&id=<?= $pay['id'] ?>" class='btn btn-danger pt-0 pb-0 ps-2 pe-2'ata-bs-toggle="tooltip" data-bs-placement="top" title="Xóa thanh toán">
                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                    </a>
                                </td>
                            </tr>  
                        <? } ?>
                      
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>