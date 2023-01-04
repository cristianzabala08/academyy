
<link rel="stylesheet" href="./css.css">
<?php
    $user_data = $this->db->get_where('users', array('id' => $user_id))->row_array();
    $social_links = json_decode($user_data['social_links'], true);
    $my_courses = $this->user_model->my_courses($user_id)->result_array();
?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?> </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row" >
    <div class="col-xl-12" >
        <div class="card">
            <div class="card-body">
            <h4 class="header-title mb-3" ><?php echo  $user_data['first_name']. "  " . $user_data['last_name'];  ?> 
                <div align="right">
                <a href="javascript:window.history.back();">
               <i class="fa fa-arrow-circle-left"></i>volver</a>
                </div>
                 </h4>
       <div class="row align-items-baseline">
        <div  class="row" id = "my_courses_area"  >
            <?php foreach ($my_courses as $my_course):
                $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
                $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();?>
                <div class="col-lg-3"  >
                    <div class="course-box-wrap "  >
                            <div class=" course-box">
                            
                                    <div class="course-image">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($my_course['course_id']); ?>" alt="" class="img-fluid">
                                        <span class="play-btn"></span>
                                    </div>
                
                                <div class="" id = "course_info_view_<?php echo $my_course['course_id'];  ?>">
                                  <div class="course-details">
                                      <a href="<?php echo site_url('admin/user_form/details_curso/'.$user_id."/".$my_course['course_id']) ?>">
                                      <h5 class="title"><?php echo ellipsis($course_details['title']); ?></h5></a>
                                      <div class="progress" style="height: 5px;">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo course_progress($my_course['course_id'], $user_id); ?>%" aria-valuenow="<?php echo course_progress($my_course['course_id'],$user_id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <small><?php echo ceil(course_progress($my_course['course_id'],$user_id)); ?>% <?php echo get_phrase('completed'); ?></small>
                                  </div>
                                </div>
                              
                            </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
            </div>
 
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>



