<div class="bg-white shadow rounded-lg d-block d-sm-flex member-section">
                <div class="profile-tab-nav border-right">
                    
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i> 
                            Account
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                            <i class="fa fa-key text-center mr-1"></i> 
                            Password
                        </a>
                        <a class="nav-link" id="wallet-tab" data-toggle="pill" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false">
                            <i class="fa fa-wallet text-center mr-1"></i> 
                            Wallet
                        </a>
                        <a class="nav-link" id="order-tab" data-toggle="pill" href="#order" role="tab" aria-controls="order" aria-selected="false">
                            <i class="fa fa-shopping-bag text-center mr-1"></i> 
                            <?=donhang?>
                        </a>
                        <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
                            <i class="fa fa-bell text-center mr-1"></i> 
                            Notification
                        </a>
                    </div>
                </div>
                <form method="post" class="w-100">
                <div class="tab-content p-4 px-md-5 py-md-3" id="v-pills-tabContent">
                    <div class="tab-pane fades show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <h3 class="mb-4 font-weight-bold text-uppercase"><?=thongtincanhan?></h3>
                         <?php 
                              if($model->get("error_account")){
                                  echo '<div class="alert alert-danger"><script> var _error='.json_encode((array)$model->get("error_account")).';</script>';
                                  foreach($model->get("error_account") as $v){
                                      echo '<p class="m-0 ">'.$v.'</p>';
                                  }
                                  echo '</div>';
                              }
                          ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?=taikhoan?></label>
                                    <input type="text" class="form-control" value="<?=$row_detail['username']?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="<?=$row_detail['email']?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?=hoten?></label>
                                    <input type="text" class="form-control" name="ten" value="<?=$row_detail['ten']?>" />
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?=dienthoai?></label>
                                    <input type="text" class="form-control" name="dienthoai" value="<?=$row_detail['dienthoai']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?=gioitinh?></label>
                                    <div class="input-group input-user">
                                        <div class="radio-user custom-control custom-radio">
                                            <input type="radio" id="nam" name="gioitinh" class="custom-control-input" <?=($row_detail['gioitinh']==1)?'checked':''?> value="1" required>
                                            <label class="custom-control-label" for="nam"><?=nam?></label>
                                        </div>
                                        <div class="radio-user custom-control custom-radio ml-3">
                                            <input type="radio" id="nu" name="gioitinh" class="custom-control-input" <?=($row_detail['gioitinh']==2)?'checked':''?> value="2" required>
                                            <label class="custom-control-label" for="nu"><?=nu?></label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label><?=ngaysinh?></label>
                                    <input type="text" class="form-control datepicker" id="ngaysinh" name="ngaysinh" value="<?=$model->carbon->parse($row_detail['ngaysinh'])->format('d-m-Y')?>" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?=diachi?></label>
                                    <input type="text" class="form-control" value="<?=$row_detail['diachi']?>" name="diachi"  />
                                </div>
                            </div>
                            <?php 
                            if($row_detail['ref']){?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Upline</label>
                                    <input type="text" class="form-control" value="<?=$model->getUser($row_detail['ref'],"username")?>" disabled/>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Wallet address</label>
                                    <input type="text" class="form-control" value="<?=$row_detail['wallet']?>" disabled/>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-danger">Link ref</label>
                                    <div class="input-group ">
                                      <input type="text" class="form-control"  value="<?=_baseUrl()?>?ref=<?=$row_detail['id']?>" disabled/>
                                      <span id="ref" class="d-none"><?=_baseUrl()?>?ref=<?=$row_detail['id']?></span>
                                      <div class="input-group-append">
                                        <button onclick="copyToClipboard('#ref');return false;" class="btn btn-dark" ><i class="fa fa-copy"></i>&nbsp;Copy</button>
                                      </div>
                                    </div>
                                   
                                </div>
                            </div>
                           
                        </div>
                        <div>
                            <button class="btn btn-dark" type="submit" name="submit" value="account"><?=capnhat?></button>
                           
                        </div>
                    </div>
                    <div class="tab-pane fades" id="password" role="tabpanel" aria-labelledby="password-tab">
                       
                        <h3 class="mb-4 font-weight-bold text-uppercase">Password Settings</h3>
                        <?php 
                              if($model->get("error_password")){
                                  echo '<div class="alert alert-danger"><script> var _error='.json_encode((array)$model->get("error_password")).';</script>';
                                  foreach($model->get("error_password") as $v){
                                      echo '<p class="m-0 ">'.$v.'</p>';
                                  }
                                  echo '</div>';
                              }
                          ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Old password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New password</label>
                                    <input type="password" name="new-password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input type="password" name="new-password-confirm" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                             <button class="btn btn-dark" type="submit" name="submit" value="password"><?=capnhat?></button>
                        </div>
                    </div>
                    <div class="tab-pane fades resp" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                        <h3 class="mb-4 font-weight-bold text-uppercase">Wallet</h3>
                         <table id="myTable" class="table table-bordered">
                          <!-- thead -->
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>TxtID</th>
                              <th>Amount</th>
                              <th>Date</th>
                            
                            </tr>
                          </thead><!-- /thead -->
                          <!-- tbody -->
                          <tbody>
                            <!-- create empty row to passing html validator -->
                           
                                <?php 
                               
                                foreach($model->get("data") as $k=>$v){
                                    
                                    ?>  <tr>
                                              <td data-th="ID:"><?=$k+1?></td>
                                              <td data-th="TxtID:"><a href="https://tronscan.org/#/transaction/<?=$v['transaction_id']?>" target="_blank"><?=$v['transaction_id']?></a></td>
                                              <td data-th="Amount:"><?=_price($v['amount'])?></td>
                                              <td data-th="Date:"><?=$v['created_at']?></td>
                                              
                                       </tr>
                                    <?php 
                                }
                                ?>
                             
                           
                          </tbody><!-- /tbody -->
                        </table><!-- /.table -->
                    </div>
                    <div class="tab-pane fades" id="order" role="tabpanel" aria-labelledby="order-tab">
                         <h3 class="mb-4 font-weight-bold text-uppercase"><?=giohang?></h3>
                         <table id="myTable" class="table table-bordered">
                          <!-- thead -->
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th><?=madonhang?></th>
                              <th><?=giatridonhang?></th>
                              <th>Date</th>
                              <th><?=payment_method?></th>
                              <th><?=tinhtrang?></th>
                              <th><?=xemchitiet?></th>
                              
                            
                            </tr>
                          </thead><!-- /thead -->
                          <!-- tbody -->
                          <tbody>
                            <!-- create empty row to passing html validator -->
                           
                                <?php 
                               
                                foreach($model->get("cart") as $k=>$v){
                                  
                                    ?>  <tr>
                                              <td data-th="ID:"><?=$k+1?></td>
                                              <td data-th="<?=madonhang?>:"><strong class="text-danger"><?=$v['madonhang']?></strong></td>
                                              <td data-th="<?=giatridonhang?>:"><?=$func->format_money($v['tonggia'])?></td>
                                              <td data-th="Date:"><?=date("d-m-Y H:i",$v['ngaytao'])?></td>
                                              <td data-th="<?=payment_method?>:"><?=$model->getPayment($v['httt'])?></td>
                                              <td data-th="<?=tinhtrang?>:"><?php 
                                              $s = $model->getStatus($v['tinhtrang']);
                                              echo '<span class="p-1 alert alert-'.$s['color'].' d-inline-block m-0">'.$s['name'].'</span>';
                                              ?></td>
                                              <td data-th="<?=xemchitiet?>:"><a href="" class="text-decoration-none text-success preview-cart" data-id="<?=$v['id']?>"><small><i class="fa fa-search"></i>&nbsp;<?=xemchitiet?></small></a></td>
                                              
                                              
                                       </tr>
                                    <?php 
                                }
                                ?>
                             
                           
                          </tbody><!-- /tbody -->
                        </table><!-- /.table -->
                    </div>
                    <div class="tab-pane fades" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                        <h3 class="mb-4">Notification Settings</h3>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notification1">
                                <label class="form-check-label" for="notification1">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notification2" >
                                <label class="form-check-label" for="notification2">
                                    hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notification3" >
                                <label class="form-check-label" for="notification3">
                                    commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                                </label>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary">Update</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>



