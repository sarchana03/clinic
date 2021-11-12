<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Appointment Schedule List');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Start_date</th>
                                <th>Start-Time End_Time</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                             <tr><?php $no = 1; $get_calendar_from_model = $this->crud_model->list_all_appointment_list_model_and_order_with_id(); foreach ($get_calendar_from_model as $key => $calendar):?>
                                <td><?php echo $no++ ; ?></td>
                                <td><?php echo $calendar['patient_name'];?></td>
                                <td><?php echo $calendar['doctor_name'];?></td>
                                <td><?php $wop = $calendar['start_date']; print date("Y-m-d", strtotime($wop))?></td>
                                <td><?php $wop = $calendar['start_date']; print date("h:i a", strtotime($wop))?> - <?php $wop = $calendar['end_time']; print date("h:i a", strtotime($wop))?></td>
                                <td><?php echo $calendar['status'];?></td>
                                
                             </tr>
                            <?php  endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

        
                        
