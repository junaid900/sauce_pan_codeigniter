<div class="page-head">
    <h3 class="m-b-less">
        <?php echo $page_sub_title; ?>
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo $page_title; ?></li>
        </ol>
    </div>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    <?php echo $page_title; ?>
                    <span class="tools pull-right">
                        <!--a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a-->
                    </span>
                </header>
            <table class="table convert-data-table data-table">
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
					
					<td><?php echo get_phrase($l['phrase']); ?></td>
					
					


				</tr>
				<?php } ?>

			</tbody>	
            </table>
            </section>
        </div>
    </div>
</div>
