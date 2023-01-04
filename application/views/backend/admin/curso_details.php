
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
   
        <?php 
        $my_courses = $this->user_model->my_quiz_curso($user_id, $curso_id)->result_array();
        foreach ($my_courses as $my_course):
                $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
                $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();?>
                <div class="col-lg-3"  >
                    <div class="course-box-wrap "  >
                            <div class=" course-box">
                       
                             <h5 class="card-title">lesson <?php echo  $my_course['id_quiz'] ?></h5>
                            <p class="card-text">Tiene  <?php echo $my_course['resultado'] ?> de <?php echo $my_course['resultado1'] ?></p>
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



