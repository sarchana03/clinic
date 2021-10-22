<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_sub_group');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/sub_group/create' , array('group' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

								<!-- <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nick_name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nick_name"/ required>
                                </div>
                            </div> -->

                    
                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('group');?></label>
                    <div class="col-sm-12">
                    <select name="group_id" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('select_group');?></option>

                    <?php $group =  $this->db->get('group')->result_array();
                    foreach($group as $key => $group):?>
                    <option value="<?php echo $group['group_id'];?>"><?php echo $group['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>

								
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('doctor');?></label>
                    <div class="col-sm-12">
                    <select name="doctor_id" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('select_doctor');?></option>

                    <?php $doctor =  $this->db->get('doctor')->result_array();
                    foreach($doctor as $key => $doctor):?>
                    <option value="<?php echo $doctor['doctor_id'];?>"><?php echo $doctor['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add_sub_group');?></button>
					</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('list_sub_group');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                    
                    <div class="tabs-vertical-env">
                        <ul class="nav tabs-vertical">

                        <?php $groupss =  $this->db->get('group')->result_array();
                        foreach($groupss as $key => $groupss):?>  

                        <li class="<?php if($groupss['group_id']== $group_id) echo 'active';?>">

                            <a class="btn btn-info btn-rounded btn-sm" href="<?php echo base_url();?>admin/sub_groups/<?php echo $groupss['group_id'];?>" style="color:white">

                                <?php echo get_phrase('group');?>: <?php echo $groupss['name'];?>
                            </a>

                        </li>  
                        <?php endforeach;?>  
                        </ul>
                        <hr>
				
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('group_name');?></div></th>
                    		<!-- <th><div><?php echo get_phrase('nick_name');?></div></th> -->
                    		<!-- <th><div><?php echo get_phrase('teacher');?></div></th> -->
                    		<th><div><?php echo get_phrase('doctor');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; $sub_groups =  $this->db->get_where('sub_group', array('doctor_id' => $doctor_id))->result_array();
                    foreach($sub_groups as $key => $sub_groups):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
							<td><?php echo $sub_groups['name'];?></td>
							<!-- <td><?php echo $sub_groups['nick_name'];?></td> -->
                            <td><?php echo $this->crud_model->get_type_name_by_id('doctor', $sub_groups['doctor_id']);?></td>
							<td>
							
				    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_sub_group/<?php echo $sub_groups['sub_group_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/sub_group/delete/<?php echo $sub_groups['sub_group_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
					 
			
                           
        					</td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>
				</div></div>
			</div>
		</div>
	</div>
</div>
			
            <!----TABLE LISTING ENDS--->
            