<?php $class = $this->db->get_where('group', array('group_id' => $param2))->result_array();
foreach ($group as $key => $group):?>
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_group');?></div>
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/groups/update/' . $param2 , array('group' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $class['name'];?>">
                                </div>
                            </div>

								<!-- <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name_numeric');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name_numeric" value="<?php echo $class['name_numeric'];?>">
                                </div>
                            </div> -->

								
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('doctor');?></label>
                    <div class="col-sm-12">
                                    <select name="doctor_id" class="form-control select2" required>
                                     <option value=""><?php echo get_phrase('select_doctor');?></option>

                    <?php $doctor =  $this->db->get('doctor')->result_array();
                    foreach($doctor as $key => $doctor):?>

                    <option value="<?php echo $doctor['doctor_id'];?>"
                    <?php if($class['doctor_id'] == $doctor['doctor_id']) echo 'selected';?>>
                    <?php echo $doctor['name'];?>
                    </option>

                    <?php endforeach;?>
                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-edit"></i>&nbsp;<?php echo get_phrase('edit_group');?></button>
							</div>
							
                    </form>                
                </div>                
		</div>
	</div>
</div>
<?php endforeach;?>