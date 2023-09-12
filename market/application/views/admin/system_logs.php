<div class="page-head">
    <h3 class="m-b-less">
        <?php echo $page_sub_title; ?>
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="#"><?php echo get_phrase('home'); ?></a></li>
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
            <table class="table table-striped convert-data-table data-table">
            <thead>
            <tr>
				<th>#</th>
				<th><?php echo get_phrase('logged_by'); ?></th>
                <th><?php echo get_phrase('module'); ?></th>
                <th><?php echo get_phrase('description'); ?></th>
                <th><?php echo get_phrase('action'); ?></th>
			    <th><?php echo get_phrase('date_recorded'); ?></th>
        	</tr>
            </thead>
            <tbody>
        	<?php $count = 1; foreach($system_logs as $x){ ?>
				<tr>
				    <td><?php echo $count++; ?></td>
				    <td><?php echo $this->db->get_where('users_system',array('users_system_id'=>$x['logged_by']))->row()->first_name; ?></td>
                    <td><?php echo $x['module']; ?></td>
                    <td><?php echo $x['description']; ?></td>
                    <td><?php echo $x['action']; ?></td>
                    <td><?php echo $x['date_recorded']; ?></td>
				</tr>
				
			<?php } ?>
			</tbody>	
            </table>
            </section>
        </div>
    </div>
</div>
