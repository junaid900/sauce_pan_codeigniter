                                    <a href="<?php echo base_url(); ?>admin/edit_user/<?php echo $user['users_system_id']; ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="javascript:;"
                                           onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_users/delete/<?php echo $user['users_system_id']; ?>');">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <a href="javascript:;"
                                           onclick="getPointsLog(<?= $user['users_system_id'] ?>,'exampleModal<?= $count ?>')"
                                           data-target="#exampleModal<?= $count ?>" data-toggle="tooltip" title="Sp Points Log!">
                                            <i class="fa fa-list-alt"></i>
                                        </a>
                                        <div class="modal fade" id="exampleModal<?= $count ?>" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel"><?= get_phrase("order_products") ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class = "header">
                                                            <h3><?= get_phrase("points_details") ?></h3>
                                                        </div>
                                                     
                                                        <div style="display: flex"
                                                             id="loader<?= $user['users_system_id'] ?>">
                                                            <h1><?= get_phrase("loading") ?>......</h1> 
                                                        </div>
                                                        <table class="table table-bordered table-responsive" style = "width: 100%">
                                                            <thead>
                                                           <tr>
                                                                <th width = "10%"><?= "#" ?></th>
                                                                <th width = "20%"><?= get_phrase("description")?></th>
                                                                <th width = "10%"><?= get_phrase("points") ?></th>
                                                                <th width = "10%"><?= get_phrase("increament_/_decrement") ?></th>
                                                                <th width = "15%"><?= get_phrase("current_points") ?></th>
                                                                <th width = "15%"><?= get_phrase("time") ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="body<?= $user['users_system_id'] ?>">

                                                            </tbody>
                                                            
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"
                                                                style="margin: 10px">
                                                            Close
                                                        </button>
                                                        <!--                                                <button type="button" class="btn btn-primary">Save changes</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <a href="javascript:;"
                                           onclick="getUserAddresses(<?= $user['users_system_id'] ?>,'exampleModalAddress<?= $count ?>')"
                                           data-target="#exampleModalAddress<?= $count ?>" data-toggle="tooltip" title="User Addresses!">
                                            <i class="fa fa-map-marker"></i>
                                        </a>
                                        <div class="modal fade" id="exampleModalAddress<?= $count ?>" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel"><?= get_phrase("order_products") ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                ariad-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class = "header">
                                                            <h3><?= get_phrase("points_details") ?></h3>
                                                        </div>
                                                     
                                                        <div style="display: flex"
                                                             id="loader<?= "address".$user['users_system_id'] ?>">
                                                            <h1><?= get_phrase("loading") ?>......</h1> 
                                                        </div>
                                                        <table class="table table-bordered table-responsive" style = "width: 100%">
                                                            <thead>
                                                           <tr>
                                                                <th width = "10%"><?= "#" ?></th>
                                                                <th width = "40%"><?= get_phrase("user_address") ?></th>
                                                                <th width = "10%"><?= get_phrase("country") ?></th>
                                                                <th width = "10%"><?= get_phrase("postal_code") ?></th>
                                                                <th width = "30%"><?= get_phrase("time") ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="address_body<?= $user['users_system_id'] ?>">
                                                            </tbody>
                                                            
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"
                                                                style="margin: 10px">
                                                            Close
                                                        </button>
                                                        <!--                                                <button type="button" class="btn btn-primary">Save changes</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <a href="javascript:;" data-toggle="tooltip" title="View User Orders"
                                           onclick="location.href='<?php echo base_url().admin_ctrl(); ?>/manage_order?user_id=<?php echo $user['users_system_id']; ?>'">
                                            <i class="fa fa-cart-arrow-down"></i>
                                        </a>
                                     