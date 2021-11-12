<?php 
$patient_id = $this->session->userdata('patient_id');
// $student_id = $this->session->userdata('student_id');
$name = $this->session->userdata('name');
?>
<div class="container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="alert notification" style="display: none;">
                <button class="close" data-close="alert"></button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                             <div id="calendarIO"></div>
                            <div class="modal fade" id="create_modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="POST" id="form_create">
                        <input type="hidden" name="calendar_id" value="0">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Create Schedule List</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="alert alert-danger" style="display: none;">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Name  <span class="required"> * </span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control" placeholder="Enter You Name" required>
                                    <!-- <input type="hidden" name="student_id" class="form-control" value="<?php echo"$student_id"; ?>">
                                    <input type="hidden" name="student_name" class="form-control" value="<?php echo"$name"; ?>"> -->

                                    <input type="hidden" name="patient_id" class="form-control" value="<?php echo"$patient_id"; ?>">
                                    <input type="hidden" name="patient_name" class="form-control" value="<?php echo"$name"; ?>">
                                    <input type="hidden" name="color" class="form-control" value="#F29339">
                                    <input type="hidden" name="status" class="form-control" value="pending">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Description</label>
                                <div class="col-sm-12">
                                    <textarea name="description" rows="3" class="form-control"  placeholder="Enter description" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Doctors confirmed');?></label>
                    <div class="col-sm-12">
                           <select name="doctor_id" id="doctor_id" class="form-control select2" onchange="return get_doctor(this.value)" required>
                    <option value=""><?php echo get_phrase('select_doctor');?></option>

                    <?php $doctor =  $this->db->get('doctor')->result_array();
                    foreach($doctor as $key => $doctor):?>
                    <option value="<?php echo $doctor['doctor_id'];?>"<?php if(isset($doctor_id) && $doctor_id==$doctor['doctor_id']) echo 'selected="selected"';?>><?php echo $doctor['name'];?></option>
                    <?php endforeach;?>
                   </select>

                           <select name="doctor_name" class="form-control select2" id="section_selector_holder" style="visibility: hidden;">
                    <option value=""><?php echo get_phrase('select_name');?></option>
                    </select> 
                    
                      </div>
                  </div>
                  <div class="form-group">
                                <label class="control-label col-sm-2">Date
                                <span class="required"> * </span></label>
                                <div class="col-sm-12">
                                    <div  data-date-format="YYYY-MM-DD " data-datetime-viewmode="years">
                                        <input type="date" class="form-control m-r-10" name="start_date" id="example-date-input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Start Time</label>
                                <div class="col-sm-12">
                                    <div  data-date-format="yyyy-mm-dd hh-mm-ss" data-date-viewmode="years">
                                        <input class="form-control m-r-10" name="start_time"  type="time"   required>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="control-label col-sm-2">End Date</label>
                                <div class="col-sm-12">
                                    <div  data-date-format="yyyy-mm-dd hh-mm-ss" data-date-viewmode="years">
                                        <input class="form-control m-r-10" name="end_date"  type="date"   required>
                                        
                                    </div>
                                </div>
                            </div> -->
                             <div class="form-group">
                                <label class="control-label col-sm-2">End Time</label>
                                <div class="col-sm-12">
                                    <div  data-date-format="hh-mm-ss" data-date-viewmode="years">
                                        <input class="form-control m-r-10" name="end_time"  type="time"   required>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="modal-footer">
                            <a href="javascript::void" class="btn default" data-dismiss="modal">Cancel</a>
                            <a class="btn btn-danger delete_calendar" style="display: none;">Delete</a>
                            <button type="submit" class="btn green">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
      <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                             <div id="calendarIO"></div>
                            <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="POST" id="form_create">
                        <input type="hidden" name="calendar_id" value="0">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Create calendar update</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="alert alert-danger" style="display: none;">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Name  <span class="required"> * </span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control" placeholder="Enter You Name" required>
                                    
                                    
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-sm-2">Description  <span class="required"> * </span>
                                </label>
                                <div class="col-sm-12">
                                    <textarea type="text" name="description" class="form-control" placeholder="Enter description" required>
                                    </textarea>
                                    
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Date<span class="required"> * </span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="date"  name="start_date" class="form-control" placeholder="Enter Start Date"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Start Time<span class="required"> * </span>
                                </label>
                               <div class="col-sm-12">
                                    <input type="time"  name="start_time" class="form-control" placeholder="Enter Start Time"  required>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="control-label col-sm-2">End Date<span class="required"> * </span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="date"  name="end_date" class="form-control" placeholder="Enter end_date"  required>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="control-label col-sm-2">End Time<span class="required"> * </span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="time"  name="end_time" class="form-control" placeholder="Enter End Time"  required>
                                </div>
                            </div>
                            
                        <div class="modal-footer">
                            <a href="javascript::void" class="btn default" data-dismiss="modal">Cancel</a>
                            <a class="btn btn-danger delete_calendar" style="display: none;">Delete</a>
                            <button type="submit" class="btn green">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

    <script type="text/javascript">
        var get_data        = '<?php echo $get_data; ?>';

        var backend_url     = '<?php echo base_url(); ?>';

        $(document).ready(function($id) {
            $('.date-time-picker').datepicker();
            $('#calendarIO').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                                     
                    right: 'month,agendaWeek,agendaDay'
                },

                defaultDateTime: moment().format('DD-MM-YYYY HH:MM'),
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,
                select: function(start, end,) {

                    var now = new Date(Date.now());
                    var datetimee = ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2) ;
                    $('#create_modal1 input[name=start_date]').val(moment(start).format('YYYY-MM-DD'));
                    $('#create_modal1 input[name=start_time]').val(moment(start).format(datetimee));
                    $('#create_modal1 input[name=end_time]').val(moment(start).format(datetimee));
                    $('#create_modal1 input[name=end_date]').val(moment(end).format('YYYY-MM-DD'));

                    $('#create_modal1').modal('show');
                    save();
                    $('#calendarIO').fullCalendar('unselect');
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position
                    editDropResize(event);
                },
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
                    editDropResize(event);
                },
                eventClick: function(event, element)
                {
                    deteil(event);
                    editData(event);
                    deleteData(event);
                },
                events: JSON.parse(get_data)
            });
        });

        $(document).on('click', '.add_calendar', function(){
            $('#create_modal input[name=calendar_id]').val(0);
            $('#create_modal').modal('show');  
        })


        $(document).on('submit', '#form_create', function(){

            var element = $(this);
            var eventData;
            $.ajax({
                // url     : '<?php echo base_url(); ?>student/save',
                url     : '<?php echo base_url(); ?>patient/save',
                type    : element.attr('method'),
                data    : element.serialize(),
                dataType: 'JSON',
                beforeSend: function()
                {
                    element.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                },
                success: function(data)
                {
                    if(data.status)
                    { 

                        eventData = {

                            id          : data.id,
                            title       : $('#create_modal input[name=title]').val(),
                            patient_id      : $('#create_modal input[name=patient_id]').val(),
                            doctor_id      : $('#create_modal input[name=doctor_id]').val(),
                            doctor_name      : $('#create_modal input[name=doctor_name]').val(),
                            
                            // student_id      : $('#create_modal input[name=student_id]').val(),
                            // teacher_id      : $('#create_modal input[name=teacher_id]').val(),
                            // teacher_name      : $('#create_modal input[name=teacher_name]').val(),
                            status      : $('#create_modal input[name=status]').val(),
                            description : $('#create_modal textarea[name=description]').val(),
                            end_date : $('#create_modal input[name=end_date]').val(),
                            start       : moment($('#create_modal input[name=start_date]').val()).format('YYYY-MM-DD'),
                            start_time       : moment($('#create_modal input[name=start_time]').val()).format('HH:MM'),
                            end_time       : moment($('#create_modal input[name=end_time]').val()).format('HH:MM'),
                            end         : moment($('#create_modal input[name=end_date]').val()).format('YYYY-MM-DD'),
                            color       : $('#create_modal select[name=color]').val()
                        };
                        $('#calendarIO').fullCalendar('renderEvent', eventData, true); // stick? = true
                        $('#create_modal').modal('hide');
                        element[0].reset();
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                    }
                    else
                    {
                        element.find('.alert').css('display', 'block');
                        element.find('.alert').html(data.notif);
                    }
                    element.find('button[type=submit]').html('Submit');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    element.find('button[type=submit]').html('Submit');
                    element.find('.alert').css('display', 'block');
                    element.find('.alert').html('Wrong server, please save again');
                }         
            });
            return false;
        })

        function editDropResize(event)
        {
            start = event.start.format('YYYY-MM-DD HH:MM');
            if(event.end)
            {
                end = event.end.format('YYYY-MM-DD HH:MM');
            }
            else
            {
                end = start;
            }
         
            $.ajax({
                url     : '<?php echo base_url(); ?>patient/save',
                // url     : '<?php echo base_url(); ?>student/save',
                type    : 'POST',
                data    : 'calendar_id='+event.id+'&description='+event.description+'&end_date='+event.end_date+'&title='+event.title+'&start_date='+start+'&start_time='+start_time+'&end_time='+end_time+'&end_date='+end,
                dataType: 'JSON',
                beforeSend: function()
                {
                },
                success: function(data)
                {
                    if(data.status)
                    {   
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html('Data success update');

                    }
                    else
                    {
                        $('.notification').removeClass('alert-primary').addClass('alert-danger').find('p').html('Data cant update');
                    }
             
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $('.notification').removeClass('alert-primary').addClass('alert-danger').find('p').html('Wrong server, please save again');
                }         
            });
        }

        function save()
        {
            $('#form_create').submit(function(){
                var element = $(this);
                var eventData;
                $.ajax({
                    url     : '<?php echo base_url(); ?>patient/save',
                    // url     : '<?php echo base_url(); ?>student/save',
                    type    : element.attr('method'),
                    data    : element.serialize(),
                    dataType: 'JSON',
                    beforeSend: function()
                    {
                        element.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                    },
                    success: function(data)
                    {
                        if(data.status)
                        {   
                            eventData = {
                                id          : data.id,
                                title       : $('#create_modal input[name=title]').val(),
                                
                                patient_id      : $('#create_modal input[name=patient_id]').val(),
                                // student_id      : $('#create_modal input[name=student_id]').val(),
                                // teacher_id      : $('#create_modal input[name=teacher_id]').val(),
                                // teacher_name     : $('#create_modal input[name=teacher_name]').val(),
                                doctor_id      : $('#create_modal input[name=doctor_id]').val(),
                                doctor_name     : $('#create_modal input[name=doctor_name]').val(),
                                status      : $('#create_modal input[name=status]').val(),

                                description : $('#create_modal textarea[name=description]').val(),
                                end_date : $('#create_modal textarea[name=end_date]').val(),

                                start       : moment($('#create_modal input[name=start_date]').val()).format('YYYY-MM-DD HH-MM-SS'),
                                 start_time       : moment($('#create_modal input[name=start_time]').val()).format('h:i'),
                              end_time       : moment($('#create_modal input[name=end_time]').val()).format('HH-MM'),
                                end         : moment($('#create_modal input[name=end_date]').val()).format('YYYY-MM-DD HH:mm:ss'),
                                color       : $('#create_modal select[name=color]').val()
                            };
                            $('#calendarIO').fullCalendar('renderEvent', eventData, true); // stick? = true
                            $('#create_modal1').modal('hide');
                           $('#form_create')[0].reset();
                            $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                        }
                        else
                        {
                            element.find('.alert').css('display', 'block');
                            element.find('.alert').html(data.notif);
                        }
                        element.find('button[type=submit]').html('Submit');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        element.find('button[type=submit]').html('Submit');
                        element.find('.alert').css('display', 'block');
                        element.find('.alert').html('Wrong server, please save again');
                    }         
                });
                return false;
            })
        }

        function deteil(event)
        {
            $('#create_modal input[name=calendar_id]').val(event.id);
            $('#create_modal input[name=start_date]').val(moment(event.start).format('YYYY-MM-DD'));
            $('#create_modal input[name=start_time]').val(moment(event.start_time).format('HH:MM'));
            $('#create_modal input[name=end_time]').val(moment(event.end_time).format('HH:MM'));
            $('#create_modal input[name=end_date]').val(moment(event.end).format('YYYY-MM-DD'));
            $('#create_modal input[name=title]').val(event.title);
            $('#create_modal textarea[name=description]').val(event.description);
            $('#create_modal select[name=color]').val(event.color);
            $('#create_modal .delete_calendar').show();
            $('#create_modal').modal('show');
        }

        function editData(event)
        {
            $('#form_create').submit(function(){
                var element = $(this);
                var eventData;
                $.ajax({
                    url     : '<?php echo base_url(); ?>patient/save',
                    // url     : '<?php echo base_url(); ?>student/save',

                    type    : element.attr('method'),
                    data    : element.serialize(),
                    dataType: 'JSON',
                    beforeSend: function()
                    {
                        element.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                    },
                    success: function(data)
                    {
                        if(data.status)
                        {   
                            event.title         = $('#create_modal input[name=title]').val();
                            event.description   = $('#create_modal textarea[name=description]').val();
                            event.end_date   = $('#create_modal textarea[name=end_date]').val();
                            event.start         = moment($('#create_modal input[name=start_date]').val()).format('YYYY-MM-DD');
                            event.start_time         = moment($('#create_modal input[name=start_time]').val()).format('H:i');
                            event.end_time         = moment($('#create_modal input[name=end_time]').val()).format('H:i');
                            event.end           = moment($('#create_modal input[name=end_date]').val()).format('YYYY-MM-DD ');
                            event.color         = $('#create_modal select[name=color]').val();
                            $('#calendarIO').fullCalendar('updateEvent', event);

                            $('#create_modal').modal('hide');
                            element[0].reset();
                            $('#create_modal input[name=calendar_id]').val(0)
                            $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                        }
                        else
                        {
                            element.find('.alert').css('display', 'block');
                            element.find('.alert').html(data.notif);
                        }
                        element.find('button[type=submit]').html('Submit');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        element.find('button[type=submit]').html('Submit');
                        element.find('.alert').css('display', 'block');
                        element.find('.alert').html('Wrong server, please save again');
                    }         
                });
                return false;
            })
        }

        function deleteData(event)
        {
            $('#create_modal .delete_calendar').click(function(){
                $.ajax({
                    // url     : '<?php echo base_url(); ?>student/delete',
                    url     : '<?php echo base_url(); ?>patient/delete',

                    type    : 'POST',
                    data    : 'id='+event.id,
                    dataType: 'JSON',
                    beforeSend: function()
                    {
                    },
                    success: function(data)
                    {
                        if(data.status)
                        {   
                            $('#calendarIO').fullCalendar('removeEvents',event._id);
                            $('#create_modal').modal('hide');
                            $('#form_create')[0].reset();
                            $('#create_modal input[name=calendar_id]').val(0)
                            $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                        }
                        else
                        {
                            $('#form_create').find('.alert').css('display', 'block');
                            $('#form_create').find('.alert').html(data.notif);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        $('#form_create').find('.alert').css('display', 'block');
                        $('#form_create').find('.alert').html('Wrong server, please save again');
                    }         
                });
            })
        }

    </script>


    <script type="text/javascript">
  $("#update_attendance").hide();

function update_attendance() {

    $("#attendance_list").hide();
    $("#update_attendance_button").hide();
    $("#update_attendance").show();

}

// function select_section(teacher_id) {

//     var teacher = $(".teacher");
//     for (var i = teacher.length - 1; i >= 0; i--) {
//         teacher[i].style.display = "none";
//         if (teacher[i].value == class_id){
//             teacher[i].style.display = "block";
//             teacher[i].selected = "selected";
//         }
//     }
// }

function select_section(doctor_id) {

var doctor = $(".doctor");
for (var i = doctor.length - 1; i >= 0; i--) {
    doctor[i].style.display = "none";
    if (doctor[i].value == class_id){
        doctor[i].style.display = "block";
        doctor[i].selected = "selected";
    }
}
}
function get_doctor(doctor_id){
    $.ajax({
        url:        '<?php echo base_url();?>admin/get_doctor/' + doctor_id,
        success:    function(response){
            jQuery('#section_selector_holder').html(response);
        } 
    });
}

// function get_class_teacher(teacher_id){
//     $.ajax({
//         url:        '<?php echo base_url();?>admin/get_teacher_section1/' + teacher_id,
//         success:    function(response){
//             jQuery('#section_selector_holder').html(response);
//         } 
//     });
// }
</script>

