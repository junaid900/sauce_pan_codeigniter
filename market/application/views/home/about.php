 <!--====== Page Banner Start ======-->

    <section class="page-banner">
        <div class="page-banner-bg bg_cover" style="background-image: url(<?php echo base_url(); ?>uploads/general/<?php echo $images[0]['image_preview']; ?>);">
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="title"><?php echo get_phrase('about_us'); ?></h2>
                </div>
            </div>
        </div>
    </section>

 <!--====== Page Banner Ends ======-->
    <section class="about-area">
        <div class="container">
            <div class="row">
                 <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="blog-sidebar-category mt-30">
                            
                            <!--div class="sidebar-title">
                                <h4 class="title">Categories</h4>
                            </div-->
                            <ul class="category-items">
                                <?php 
                                    $category_id = 0;
                                    $title= '';
                                    foreach($labels as $lbl){
                                        $categories = $this->Db_model->get_all_category($lbl['label_id']);
                                        foreach($categories as $key=>$cat){
                                           
                                            $u_title = str_replace(' ', '_', $cat['en_title']);
                                            if($param1==$u_title){
                                                $category_id = $cat['category_id'];
                                                $title = $cat['title'];
                                            }
                                             
                                ?>
                                <li>
                                    <div class="form-radio">
                                       <label for="<?php echo $u_title; ?>" class="lbl <?php if($param1==$u_title){ echo 'menu_activ'; } ?>" onclick="sideTabs('<?php echo $u_title; ?>')" > <!--span></span--> <?php echo $cat['title']; ?></label>
                                    </div>
                                </li>
                                <!--li>
                                    <div class="form-radio">
                                        <input type="radio" name="categoryRadio" onchange="sideTabs(this.id)" id="IEC" value="IEC">
                                        <label for="IEC"  class="lbl <?php if($param1=='IEC'){ echo 'menu_activ'; } ?>" id="lbl_IEC">  IEC </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-radio">
                                        <input type="radio" name="categoryRadio" onchange="sideTabs(this.id)" id="Admission" value="Admission">
                                        <label for="Admission"  class="lbl <?php if($param1=='Admission'){ echo 'menu_activ'; } ?>" id="lbl_Admission">  Admission Office </label>
                                    </div>
                                </li-->
                                <?php
                                        }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="col-lg-12 tbs">
                        <div class="section-title-2 parah">
                            <h2 class="title"><?php echo $title; ?></h2>
                            <span class="line"></span>
                            <?php 
                                $category_detail = $this->Db_model->get_all_category_detail($category_id);
                                echo $category_detail['description'];
                            ?>
                            
                        </div>
                    </div>
                    <!--div class="col-lg-12 tbs" id="tb_IEC" style="<?php if($param1=='IEC'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
                        <div class="section-title-2 parah">
                            <h2 class="title">IEC</h2>
                            <span class="line"></span>
                             <video width="100%" style="margin-top: 1em;" controls>
                              <source src="<?php echo base_url(); ?>assets/home/images/1603934286333958.mp4" type="video/mp4">
                            </video>
                            <p>International Exchange Center (IEC) of ZJUT is a special department in charge of recruitment, management and education for international students and students from Hong Kong, Macao, Taiwan regions, providing:</p>
                            <ul>
                                <li>1）Various Chinese language and culture learning programs</li>
                                <li>2）Various specialised programs in degree and non-degree studies</li>
                                <li>3）Arrangement for domestic and international academic conferences</li>
                                <li>4）Advanced educational facilities and comfortable daily life service</li>
                            </ul>
                            <img src="<?php echo base_url(); ?>assets/home/images/1599642427607510.png" style="margin: 1em 0em;">
                        </div>
                    </div>
                    <div class="col-lg-12 tbs" id="tb_Admission" style="<?php if($param1=='Admission'){ echo 'display:block'; }else{ echo 'display:none'; }  ?>">
                        <div class="section-title-2 parah">
                            <h2 class="title">Admission Office</h2>
                            <span class="line"></span>
                            <p>Contact Information</p>
                            <ul>
                                <li>Tel: +86-571-88320160/88320445 </li>
                                
                                <li>Fax: +86-571-88320756 </li>
                                
                                <li>E-mail: iec@zjut.edu.cn</li>
                                
                                <li>Scholarship：+86-571-88320160 E-mail：ischolarship@zjut.edu.cn</li>
                                
                                <li>Address：Room126,Shangdeyuan12#, No.18 Chaowang Road, Hangzhou, Zhejiang, China </li> 
                                
                                <li>PC : 310014</li>
                            </ul>         
                             
                        </div>
                    </div-->
                </div>
               
            </div>
        </div>
    </section>

    <!--====== About Ends ======-->

