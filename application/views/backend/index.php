<?php 
$system_name    = $this->db->get_where('settings', array('type' => 'system_name', 'type' => 'school_id'))->row()->description;
$system_address = $this->db->get_where('settings', array('type' => 'address', 'type' => 'school_id'))->row()->description;
$footer         = $this->db->get_where('settings', array('type' => 'footer', 'type' => 'school_id'))->row()->description;
$text_align     = $this->db->get_where('settings', array('type' => 'text_align', 'type' => 'school_id'))->row()->description;
$loginType      = $this->session->userdata('login_type');
$school_id     = $this->session->userdata('school_id');
$running_year   = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
?>
<?php include 'css.php'; ?>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
    

	<?php include 'header.php'; ?>
	<?php include $loginType.'/navigation.php';?>
	<?php include 'page_info.php';?>
	<?php include $loginType.'/'.$page_name.'.php';?>
		
       			
	<?php  include 'dashboard.php'; ?>
				
				
                <!-- .right-sidebar -->
                <div class="right-sidebar" style="background:url(<?php echo base_url(); ?>assets/images/10.png); opacity: 0.9;">
                    <div class="slimscrollright">
                        <div class="rpanel-title">Current Mesage Thread<span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                          
                            <ul class="m-t-20 chatonline">

                            <?php 
                            $user_array = ['superadmin', 'admin', 'student', 'teacher', 'parent', 'hrm', 'hostel', 'accountant', 'librarian'];
                            for($i= 0; $i < sizeof($user_array); $i++):
                            $user_lists = $this->db->get($user_array[$i])->result_array();
                            ?>
                        <?php foreach($user_lists as $key => $user_list):?>
                            <?php $login_status = $user_list['login_status'];?>
                                <li>
                                   <?php echo $user_list['name'];?>
                                   <span class="pull-right">
                                   <?php if($login_status == '1'): ?>
                                   <?php echo '<i class="fa fa-circle" style="color:green"></i>';?>
                                   <?php endif;?>
                                   <?php if($login_status == '2'): ?>
                                   <?php echo '<i class="fa fa-circle" style="color:red"></i>';?>
                                   <?php endif;?>
                                   
                                   
                                   </span>
                                </li>
                        <?php endforeach;?>
                        <?php endfor;?>

                            
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
			
			
			<?php /* <div class="fabs">
                
  	<div class="chat">
	
    	<div class="chat_header">
			  <div class="chat_option">
					<div class="header_img">

      					<?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>


						<img src="<?php echo base_url() . $face_file;?>"/>
					</div>
					<span id="chat_head">
 							<?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                                ?>

					</span> <br> <span class="agent"><?php echo $this->session->userdata('login_type');?></span> <span class="online"><i class="fa fa-circle" style="color:green"></i></span>
			   		<span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i class="fullscreen zmdi zmdi-window-maximize"></i></span>
			  </div>
    	</div>
		
		<div class="chat_body chat_login">
			<a id="chat_first_screen" class="fab"><i class="zmdi zmdi-arrow-right"></i></a>
			<p>We make it simple and seamless for businesses and people to talk to each other. Ask us anything</p>
		</div>
	
		<div id="chat_converse" class="chat_conversion chat_converse">

				<div class="refresh">
						<?php $select_all_messages_from_general_message_table = $this->crud_model->get_general_messages();
							foreach ($select_all_messages_from_general_message_table as $key => $all_message_selected):

									$user = explode('-', $all_message_selected['user_id']);
									$user_login_type = $user_list[0];
									$user_login_id = $user_list[1];
								?>
								<?php if($all_message_selected['user_id'] != $this->session->userdata('login_type') . '-'. $this->session->userdata('login_user_id')):?>
									<span class="chat_msg_item chat_msg_item_admin">
											<div class="chat_avatar">
											<img src="<?php echo $this->crud_model->get_image_url($user_login_type, $user_login_id);?>"/>
											</div>
											<?php echo $all_message_selected['message'];?>
									</span>
									<?php endif;?>
									
									<?php if($all_message_selected['user_id'] == $this->session->userdata('login_type'). '-'. $this->session->userdata('login_user_id')):?>
									<span class="chat_msg_item chat_msg_item_user">
											<?php echo $all_message_selected['message'];?>
									</span>
										<?php endif;?>
									
								<?php endforeach;?>

			</div>
		</div>

		<div class="fab_field">
		  <a id="fab_camera" class="fab"><i class="zmdi zmdi-camera"></i></a>
		  <a id="fab_send" class="fab submit"><i class="zmdi zmdi-mail-send "></i></a>
		  <input type="hidden" id="user_id" name="user_id"  value="<?php echo $this->session->userdata('login_type'). '-'. $this->session->userdata('login_user_id');?>">
		  
		  <textarea id="chatSend" onclick="this.value=''" name="chatSend" placeholder="Send a message" class="chat_field chat_message" required></textarea>
			
		</div>
	
  </div>

    <a id="prime" class="fab"><i class="prime zmdi zmdi-comment-outline"></i></a>
</div> 
					*/ ?>
								
         <?php //include 'footer.php'; ?>
		 

		
        </div>
        <!-- /#page-wrapper -->
    </div>

<script src="<?php echo base_url();?>js/optimumajax.js"></script>
<script>
	$(document).ready(function() {
		$(".submit").click(function(event) {
		event.preventDefault();
		var chatSend = $("textarea#chatSend").val();
		var user_id = $("input#user_id").val();
				jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "admin/chatRoomMessage",
				dataType: 'json',
				data: {chatSend: chatSend, user_id: user_id},
					success: function(res) {
						if (res)
						{
						// echo some message here
						}
					}
			});
	});
});
	</script>

 <?php include 'modal.php'; ?>

 <?php include 'js.php'; ?>