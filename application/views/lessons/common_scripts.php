<script type="text/javascript"> //saving the current progress and starting from the saved progress

//document.writeln(id_user)
var newProgress;
var savedProgress;
var quiz='<?php $object = $this->user_model->my_quiz($this->session->userdata('user_id'))->result_array();
echo $json_obj=json_encode($object);
?>'
var dataArray=JSON.parse(quiz);
var currentProgress='<?php echo lesson_progress($lesson_id); ?>';
var lessonType='<?php echo $lesson_details['lesson_type']; ?>';
var videoProvider='<?php echo $provider; ?>';

function markThisLessonAsCompleted(lesson_id, lesson_type) {

  if(lesson_type=='quiz') {
  
  if ($('input#'+lesson_id).is(':checked')) {

    $('input#'+lesson_id).prop('checked', false);
    dataArray.forEach(miFuncion);

    function miFuncion(elemento, indice) {
      $("#parrafo").append("Indice: "+ indice + " Valor: "+ elemento + "<br>");

      if(elemento['id_quiz']===lesson_id) {

        $('input#'+lesson_id).prop('checked', true);
        $('#lesson_list_area').hide();
        $('#lesson_list_loader').show();
        var progress;

        if ($('input#'+lesson_id).is(':checked')) {
          progress=1;
        }

        else {
          progress=0;
        }

        $.ajax( {

            type : 'POST',
            url : '<?php echo site_url('user/save_course_progress'); ?>',
            data : {
              lesson_id : lesson_id, progress : progress
            }

            ,
            success : function(response) {
              currentProgress=response;
              $('#lesson_list_area').show();
              $('#lesson_list_loader').hide();
            }
          }

        );

      }

     
    }

  }


}else{

    $('#lesson_list_area').hide();
    $('#lesson_list_loader').show();
    var progress;

    if ($('input#'+lesson_id).is(':checked')) {
      progress=1;
    }

    else {
      progress=0;
    }

    $.ajax( {

        type : 'POST',
        url : '<?php echo site_url('user/save_course_progress'); ?>',
        data : {
          lesson_id : lesson_id, progress : progress
        }

        ,
        success : function(response) {
          currentProgress=response;
          $('#lesson_list_area').show();
          $('#lesson_list_loader').hide();
        }
      }

    );

  }


}


var timer=setInterval(function() {
    console.log('Current Progress is '+currentProgress);

    if (lessonType=='video'&& videoProvider=='html5'&& currentProgress !=1) {
      getCurrentTime();
    }
  }

  , 1000);

$(document).ready(function() {
    if (lessonType=='video'&& videoProvider=='html5') {
      var totalDuration=document.querySelector('#player').duration;

      if (currentProgress==1 || currentProgress==totalDuration) {
        document.querySelector('#player').currentTime=0;
      }

      else {
        document.querySelector('#player').currentTime=currentProgress;
      }
    }
  }

);
var counter=0;

player.on('canplay', event=> {
    if (counter==0) {
      if (currentProgress==1) {
        document.querySelector('#player').currentTime=0;
      }

      else {
        document.querySelector('#player').currentTime=currentProgress;
      }
    }

    counter++;
  }

);

function getCurrentTime() {
  var lesson_id='<?php echo $lesson_id; ?>';
  newProgress=document.querySelector('#player').currentTime;
  var totalDuration=document.querySelector('#player').duration;


  if (newProgress !=savedProgress && newProgress > 0 && currentProgress !=1) {

    // if the user watches the entire video the lesson will be marked as seen automatically.
    if (totalDuration==newProgress) {
      newProgress=1;
      $('input#'+lesson_id).prop('checked', true);
    }

    // update the video prgress here.
    $.ajax( {

        type : 'POST',
        url : '<?php echo site_url('user/save_course_progress'); ?>',
        data : {
          lesson_id : lesson_id, progress : newProgress
        }

        ,
        success : function(response) {
          savedProgress=response;
        }
      }

    );
  }
}

</script>