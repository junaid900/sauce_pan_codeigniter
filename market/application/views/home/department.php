
    <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>assets/home/images/page-banner.jpg);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php echo get_phrase('our_departments'); ?></h2>
                </div>
            </div>
        </div>
    </section>

    <!--====== Page Banner Ends ======-->

    <!--====== Top Course Start ======-->
    
    <section class="top-courses-area">
        <div class="container">
            <div class="courses-bar">
                <!---div class="row">
                    <div class="col-lg-6">
                        <div class="courses-tab">
                            <ul class="nav" role="tablist">
                                <li><a data-toggle="tab" href="#grid" role="tab"><i class="fas fa-th-large"></i></a></li>
                                <li><a class="active" data-toggle="tab" href="#list" role="tab"><i class="fas fa-list"></i></a></li>
                            </ul>
                            <p>Showing 1 - 16 of 36 results</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="courses-bar-form">
                            <div class="courses-select">
                                <select id="selectbox1">
                                    <option value="0">Newly published</option>
                                    <option value="1">published 01</option>
                                    <option value="2">published 02</option>
                                    <option value="3">published 03</option>
                                    <option value="4">published 04</option>
                                    <option value="5">published 05</option>
                                </select>
                            </div>
                            <div class="courses-search">
                                <input type="text" placeholder="Search courses">
                                <i class="far fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div-->            
            </div>    
            <div class="tab-content" id="myTabContent">
                 <div class="row">
                    <div class="col-md-4">
                        <form action="<?php echo control_helper(); ?>department/search" method="post">
                            <div class="col-md-12 m_search">
                               <input placeholder="enter search" name="department_search" class="form-control" value="<?php if(!empty($post_data)){ echo $post_data['department_search']; } ?>">
                            </div>
                            
                            <div class="col-md-12 cs_lbl">
                                <?php 
                                    
                                    foreach($page_data as $key=>$label){ 
                                    $checked = '';
                                    if(!empty($post_data) && !empty($post_data['chkboxes']) ){
                                    if (in_array($label['department_category_id'], $post_data['chkboxes'], TRUE)){
                                      $checked ='checked';  
                                    }
                                    }
                                
                                ?>
                                <label>
                                    <input type="checkbox"  name="chkboxes[]" value="<?php echo $label['department_category_id']; ?>" <?php echo $checked; ?>>
                                    <span><?php echo $label['title']; ?></span>
                                </label>
                                <?php } ?>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-default"><?php echo get_phrase('apply_filter'); ?></button>
                                </div>
                                <div class="col-md-6">
                                     <a href="<?php echo control_helper(); ?>department" class="btn btn-default" ><?php echo get_phrase('clear'); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                      <table class="table table-striped">
                      <thead>
                        <tr>
                          <th><?php echo get_phrase('program'); ?></th>
                          <th><?php echo get_phrase('school/College'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(empty($sub_data)){ ?>
                            <tr>
                                <td colspan="2">
                                   <P class="text-center">Data Not Found!</P>
                                </td>
                            </tr> 
                        <?php }?> 
                        <?php foreach($sub_data as $data){ ?>
                        <tr>
                            <td>
                                <a href="<?php echo control_helper(); ?>department_detail/<?php echo $data['link']; ?>">
                                  <?php echo $data['title']; ?>  
                                </a>
                            </td>
                          <td>
                          <?php
                           $lang = $this->session->userdata('current_language');
                            if($lang == 'Chinese'){
                                echo $this->db->get_where('department_category',array('department_category_id'=>$data['department_category_id']))->row()->ch_title;
                            }else{
                                echo $this->db->get_where('department_category',array('department_category_id'=>$data['department_category_id']))->row()->en_title;
                            }
                          ?>
                          </td>
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                    </table>   
                    </div>
                 </div>
            </div>        
            

        </div>
    </section>

    <!--====== Top Course Ends ======-->
    
    