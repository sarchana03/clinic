<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo get_phrase('New School');?>
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;Add <?php echo get_phrase('New School');?> here<i
                            class="btn btn-primary btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
            </div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'superadmin/school_setting/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


			<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School ID');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="school_id" value="<?php echo $this->db->get('school', array('type' => 'school_id'))->row()->description;?>">
					</div>
				</div>


			<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School Name');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="school_name" value="<?php echo $this->db->get('school')->row()->description;?>">
					</div>
				</div>


		<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School Admin Email Address');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="school_admin_email" value="<?php echo $this->db->get('school')->row()->description;?>">
					</div>
				</div>


	<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School Admin Password');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="password" value="<?php echo $this->db->get('school')->row()->description;?>">
					</div>
				</div>


		<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School Location');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="location" value="<?php echo $this->db->get('school')->row()->description;?>">
					</div>
				</div>

                	<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School Phone');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="phone" value="<?php echo $this->db->get('school')->row()->description;?>">
					</div>
				</div>



                	<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('School Email');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="school_email" value="<?php echo $this->db->get('school')->row()->description;?>">
					</div>
				</div>

    
	<div class="form-group">
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('language'); ?></label>
                    <div class="col-sm-12">
                        <select name="language" class="form-control select2">
                            <?php
                            $fields = $this->db->list_fields('language');
                            foreach ($fields as $key => $field) {
                                if ($field == 'phrase_id' || $field == 'phrase')
                                    continue;

                                $current_default_language = $this->db->get('school', array('type' => 'language'))->row()->description;
                                ?>
                                <option value="<?php echo $field; ?>"
                                        <?php if ($current_default_language == $field) echo 'selected'; ?>> <?php echo $field; ?> </option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
				


	        <div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Text Alignment');?></label>
					<div class="col-sm-12">
						
						<select name="text_align" class="form-control">
							<?php $align =  $this->db->get('school', array('type' => 'text_align'))->row()->description;?>
								<option value="left-to-right" <?php if ($align == 'left-to-right') echo 'selected';?>> Left to right</option>
								<option value="right-to-left" <?php if ($align == 'right-to-left') echo 'selected';?>> Right to left</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Running Session');?></label>
					<div class="col-sm-12">
						

					<select name="session" class="form-control select2" >
                          <?php $running_session = $this->db->get('school', array('type' => 'session'))->row()->description; ?>
                          <option value=""><?php echo get_phrase('select_running_session');?></option>
                          <?php for($i = 0; $i < 10; $i++):?>
                              <option value="<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>"
                                <?php if($running_session == (2019+$i).'-'.(2019+$i+1)) echo 'selected';?>>
                                  <?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>
                              </option>
                          <?php endfor;?>
                          </select>


					</div>
				</div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i
                                class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
                    </div>

                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_schools');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">

                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="80">
                                    <div><?php echo get_phrase('photo');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('name');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('email');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('sex');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('address');?></div>
                                </th>
                                <th>
                                    <div><?php echo get_phrase('options');?></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($select_librarian as $key => $librarian):	?>

                            <tr>
                                <td><img src="<?php echo  $this->crud_model->get_image_url('librarian', $librarian['librarian_id']) ;?>"
                                        class="img-circle" width="30" height="30"></td>
                                <td><?php echo $librarian['name'];?></td>
                                <td><?php echo $librarian['email'];?></td>
                                <td><?php echo $librarian['sex'];?></td>
                                <td><?php echo $librarian['address'];?></td>
                                <td>

                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_librarian/<?php echo $librarian['librarian_id'];?>')"
                                        class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                    <a onclick="confirm_modal('<?php echo base_url();?>admin/librarian/delete/<?php echo $librarian['librarian_id'];?>')"
                                        class="btn btn-danger btn-circle btn-xs" style="color:white"><i
                                            class="fa fa-times"></i></a>
                                    <a
                                        href="<?php echo base_url() . 'uploads/librarian_image/' . $librarian['file_name'];?>"><button
                                            class="btn btn-success btn-circle btn-xs"><i
                                                class="fa fa-download"></i></button>
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
</div>