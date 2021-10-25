 <!--row -->



 <div class="dashboard-box">
     <div class="dashboard-box-in">
         <div class="r-icon-stats">
             <!-- <i class="ti-user bg-megna"></i> -->

             <i class="fa fa-heartbeat" aria-hidden="true"></i>
             <div class="bodystate">
                 <h4><?php echo $this->db->count_all_results('librarian');?></h4>
             </div>
         </div>
         <span class="text-muted"><?php echo get_phrase('Heart Rate');?></span>
     </div>
     <div>
     <div class="dashboard-box-in">
     <div class="r-icon-statsb">
                 <!-- <i class="ti-user bg-megna"></i> -->
                 <!-- <i class="fa fa-heartbeat" aria-hidden="true"></i> -->
                 <i class="fa fa-tint" aria-hidden="true"></i>



                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('publisher');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Blood Pressure');?></span>
     </div>
     </div>
     <div>
     <div class="dashboard-box-in">
     <div class="r-icon-statsw">
                 <!-- <i class="ti-user bg-megna"></i> -->


                 <i class="fa fa-user-plus" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('book');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('New Patients');?></span>
     </div> 
     </div>
     <div>
     <div class="dashboard-box-in">
     <div class="r-icon-statsy">
                 <!-- <i class="ti-user bg-megna"></i>
                                 -->
                 <i class="fa fa-inr" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4>
                         <?php 

                                    $check_daily_attendance = array('date' => date('Y-m-d'), 'status' => '1');
                                    $get_attendance_information = $this->db->get_where('attendance', $check_daily_attendance);
                                    $display_attendance_here = $get_attendance_information->num_rows();
                                    echo $display_attendance_here;
                                    ?>

                     </h4>
                     <!-- <span class="text-muted"><?php echo get_phrase('Clinic Earning');?></span> -->
                 </div>
             </div>
                     <span class="text-muted"><?php echo get_phrase('Clinic Earning');?></span>


     </div>
     </div>
 </div>

 <!-- <div class="row">
     <div class="col-md-3 col-sm-6">
         <div class="white-box-in blue-bg">
             <div class="r-icon-stats">
                 <i class="ti-user bg-megna"></i>

                 <i class="fa fa-heartbeat" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('librarian');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Heart Rate');?></span>
         </div>
     </div>
     <div class="col-md-3 col-sm-6">
         <div class="white-box-in green-bg">
             <div class="r-icon-statsb">
                 <i class="ti-user bg-megna"></i>
                 <i class="fa fa-heartbeat" aria-hidden="true"></i>
                 <i class="fa fa-tint" aria-hidden="true"></i>



                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('publisher');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Blood Pressure');?></span>
         </div>
     </div>
     <div class="col-md-3 col-sm-6">
         <div class="white-box-in dark-blue-bg">
             <div class="r-icon-statsw">
                 <i class="ti-user bg-megna"></i>


                 <i class="fa fa-user-plus" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('book');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('New Patients');?></span>
         </div>
     </div>

     <div class="col-md-3 col-sm-6">
         <div class="white-box-in pink-bg">
             <div class="r-icon-statsy">
                 <i class="ti-user bg-megna"></i>
                                
                 <i class="fa fa-inr" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4>
                         <?php 

                                    $check_daily_attendance = array('date' => date('Y-m-d'), 'status' => '1');
                                    $get_attendance_information = $this->db->get_where('attendance', $check_daily_attendance);
                                    $display_attendance_here = $get_attendance_information->num_rows();
                                    echo $display_attendance_here;
                                    ?>

                     </h4>
                     <span class="text-muted"><?php echo get_phrase('Clinic Earning');?></span>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Clinic Earning');?></span>
         </div>
     </div>




 </div> -->
 <!--/row -->
 <!-- .row -->
 <?php /*
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <div class="stats-row">


                                <!-- Styles -->
                                <style>
                                #chartdiv1 {
                                width: 100%;
                                height: 500px;
                                }

                                .amcharts-chart-div a{
                                    display:none !important;
                                }	

                                </style>

                                <!-- Chart code -->
                                <script>
                                am4core.ready(function() {

                                // Themes begin
                                am4core.useTheme(am4themes_animated);
                                // Themes end

                                // Create chart instance
                                var chart = am4core.create("chartdiv1", am4charts.PieChart);

                                // Add data
                                chart.data = [
                    
                    <?php $select_book = $this->db->get('book')->result_array(); //$this->crud_model->get_invoice_info();
                            foreach ($select_book as $key => $book_selected):?>

 {
 "country": "<?php echo $book_selected['name'];?>",
 "litres": <?php echo $book_selected['price'];?>
 },
 <?php endforeach;?>

 ];

 // Add and configure Series
 var pieSeries = chart.series.push(new am4charts.PieSeries());
 pieSeries.dataFields.value = "litres";
 pieSeries.dataFields.category = "country";
 pieSeries.innerRadius = am4core.percent(50);
 pieSeries.ticks.template.disabled = true;
 pieSeries.labels.template.disabled = true;

 var rgm = new am4core.RadialGradientModifier();
 rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
 pieSeries.slices.template.fillModifier = rgm;
 pieSeries.slices.template.strokeModifier = rgm;
 pieSeries.slices.template.strokeOpacity = 0.4;
 pieSeries.slices.template.strokeWidth = 0;

 chart.legend = new am4charts.Legend();
 chart.legend.position = "right";

 }); // end am4core.ready()
 </script>

 <!-- HTML -->
 <div id="chartdiv1"></div>


 </div>
 </div>
 </div>


 </div> */?>
 <!-- /.row -->

 <div class="row">
     <!-- <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"><?php echo get_phrase('Recently Added Doctors');?></h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <tr>
                            <?php $get_doctor_from_model = $this->crud_model->list_all_doctor_and_order_with_doctor_id();
                                    foreach ($get_doctor_from_model as $key => $doctor):?>
                                            <td><img src="<?php echo $doctor['face_file'];?>" class="img-circle" width="40px"></td>
                                            <td><?php echo $doctor['name'];?></td>
                                            <td><?php echo $doctor['email'];?></td>
                                            <td><?php echo $doctor['phone'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
     <div class="col-sm-12">
         <!-- <div class="white-box">
                            <h3 class="box-title m-b-0"><?php echo get_phrase('Recently Added Patients');?></h3>
                            <div class="table-responsive">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                            <?php $get_patient_from_model = $this->crud_model->list_all_patient_and_order_with_patient_id();
                                    foreach ($get_patient_from_model as $key => $patient):?>
                                            <td><img src="<?php echo $patient['face_file'];?>" class="img-circle" width="40px"></td>
                                            <td><?php echo $patient['name'];?></td>
                                            <td><?php echo $patient['email'];?></td>
                                            <td><?php echo $patient['phone'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

         <div class="panel panel-info">

             <div class="panel-body table-responsive">
                 <?php echo get_phrase('Recently Added Patients');?>
                 <hr class="sep-2">


                 <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                     <thead>
                         <tr>
                             <th>Image</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Phone</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <?php $get_patient_from_model = $this->crud_model->list_all_patient_and_order_with_patient_id();
                                    foreach ($get_patient_from_model as $key => $patient):?>
                             <td><img src="<?php echo $patient['face_file'];?>" class="img-circle" width="40px"></td>
                             <td><?php echo $patient['name'];?></td>
                             <td><?php echo $patient['email'];?></td>
                             <td><?php echo $patient['phone'];?></td>
                         </tr>
                         <?php endforeach;?>

                     </tbody>
                 </table>


             </div>
         </div>












     </div>
 </div>
 <!-- /.row -->