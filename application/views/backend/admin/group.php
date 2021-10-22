<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_group');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/groups/create' , array('group' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

								<!-- <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name_numeric');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name_numeric"/ required>
                                </div>
                            </div> -->

								
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
                    <button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add_group');?></button>
					</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('list_group');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
				
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('group_name');?></div></th>
                    		<!-- <th><div><?php echo get_phrase('numeric_name');?></div></th> -->
                    		<th><div><?php echo get_phrase('doctor');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; $groups =  $this->db->get('group')->result_array();
                    foreach($groups as $key => $groups):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
							<td><?php echo $groups['name'];?></td>
							<!-- <td><?php echo $groups['name_numeric'];?></td> -->
							<td><?php echo $this->crud_model->get_type_name_by_id('doctor', $groups['doctor_id']);?></td>
							<td>
							
				    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_group/<?php echo $groups['group_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/groups/delete/<?php echo $groups['group_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
					 
			
                           
        					</td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>
				</div>
			</div>
		</div>
	</div>
</div>
			
            <!----TABLE LISTING ENDS--->
            