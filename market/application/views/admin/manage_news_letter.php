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
                        
                        <!--a href="<?php echo base_url(); ?>admin/add_news" class="btn btn-success btn-sm"  style="color:#fff"> <i class="fa fa-plus"></i><?php echo get_phrase('add_news'); ?></a-->
                        <!--a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a-->
                    </span>
                </header>
            <table class="table table-striped convert-data-table data-table">
            <thead>
            <tr>
                <th>
                    #
                </th>
                <th>
                    <?php echo get_phrase('email'); ?>
                    
                </th>
                <!--th>
                    English Description
                </th>
                <th>
                    Chinese Description
                </th-->
                <th>
                    <?php echo get_phrase('date_joined'); ?>
                    
                </th>
                <!---th>
                    <?php echo get_phrase('action'); ?>
                    
                </th-->
            </tr>
            </thead>
            <tbody>
            <?php $count=0; if(!empty($page_data)){ foreach($page_data as $t){ $count++; ?>
            <tr>
                <td>
                    <?php echo $count; ?>
                </td>
                <td>
                    <?php echo $t['email']; ?>
                </td>
                <td>
                    <?php echo $t['date_added']; ?>
                </td>
                <!--td>													
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"><?php echo get_phrase('action'); ?> <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>admin/edit_news/<?php echo $t['news_id']; ?>" ><?php echo get_phrase('edit'); ?></a></li>
                            <li><a href="javascript:;" onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_news/delete/<?php echo $t['news_id']; ?>');"><?php echo get_phrase('delete'); ?></a></li>
                        </ul>
                    </div>

				</td-->
            </tr>
            <?php } } ?>
            </tbody>
            </table>
            </section>
        </div>
    </div>
</div>
