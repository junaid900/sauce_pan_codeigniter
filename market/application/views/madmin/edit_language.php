
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
    				
                				<th><?php echo get_phrase('translation'); ?></th>
                
                				<th><?php echo get_phrase('phrase'); ?></th>
                				
                				
                				<th><?php echo get_phrase('action'); ?></th>
                            </tr>
                            </thead>
                              <tbody>

                    				<?php $lang = $this->db->get('language')->result_array(); ?>
                    				<?php $count= 1; foreach($lang as $l){ ?>
                    				<tr>
                    
                    					<td><?php echo $count++; ?></td>
                    
                    					<td><input id="phrase_<?php echo $l['phrase_id']; ?>" value="<?php echo $l[$param1]; ?>" ></td>
                    					
                    					<td>													
                    
                    						<button class="btn btn-success" onclick="save_language(<?php echo $l['phrase_id']; ?>,'<?php echo $param1; ?>')"><?php echo get_phrase('save'); ?></button>
                    
                    					</td>
                    					
                    					<td><?php echo $l['phrase']; ?></td>
                    					
                    					
                    
                    
                    				</tr>
                    				<?php } ?>
                    
                    			</tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--        Body End-->