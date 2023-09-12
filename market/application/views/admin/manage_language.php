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
                        <!--a href="javascript:;" class="btn btn-success btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_category','Add Category')" style="color:#fff"> <i class="fa fa-plus"></i> Add Category</a-->
                        <!--a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a-->
                    </span>
                </header>
            <table class="table convert-data-table data-table">
            <thead>
           <tr>

				<th>#</th>

				<th><?php echo get_phrase('language'); ?></th>
				
				<th><?php echo get_phrase('action'); ?></th>

			</tr>
            </thead>
            <tbody>
           
        	<tr>

				<td>1</td>

				<td>English</td>
				
				<td>													

				    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">Action <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>admin/edit_language/english">Edit</a></li>
                        </ul>
                    </div>

				</td>

			</tr>
			<tr>

				<td>2</td>

				<td>Chinese</td>
				
				<td>													
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">Action <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>admin/edit_language/Chinese">Edit</a></li>
                        </ul>
                    </div>

				</td>

			</tr>
            </tbody>
            </table>
            </section>
        </div>
    </div>
</div>
