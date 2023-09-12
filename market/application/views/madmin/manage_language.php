
<!--        Page Heeder-->

<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>
       
        </ol>
    </div>

    <div class="vl-hr">
    </div>
    <div class="header-add-btn">
    </div>
</div>
<!--        Page Header End-->
<!--        Body -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">

                    <div class="table-responsive">
                        <table class="custom-table dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>

                				<th><?php echo get_phrase('language'); ?></th>
                				
                				<th><?php echo get_phrase('action'); ?></th>
                            </tr>
                            </thead>
                            <tbody >
                               	<tr>
    
                    				<td>1</td>
                    
                    				<td>English</td>
                    				
                    				<td>													
                                         <a href="<?php echo base_url(); ?>admin/edit_language/english">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                    				   
                    				</td>
                    
                    			</tr>
                    			<tr>
                    
                    				<td>2</td>
                    
                    				<td>Chinese</td>
                    				
                    				<td>													
                                         <a href="<?php echo base_url(); ?>admin/edit_language/Chinese">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                    				   
                    				</td>
                    
                    
                    			</tr>

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--        Body End-->
