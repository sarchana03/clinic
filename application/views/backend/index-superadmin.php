<?php 
$school_name    = $this->db->get('school', array('type' => 'school_name'))->row()->description;
$school_address = $this->db->get('school', array('type' => 'location'))->row()->description;
$text_align     = $this->db->get('school', array('type' => 'text_align'))->row()->description;
$loginType      = $this->session->userdata('login_type');
$school_id     = $this->session->userdata('school_id');
$running_year   = $this->db->get('school', array('type' => 'session'))->row()->description;
?>
<?php include 'css.php'; ?>

    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>  -->
    <div id="wrapper">
    

	<?php include 'header-superadmin.php'; ?>
	
	<?php //include $loginType.'/navigation.php';?>
	<?php include 'page_info-superadmin.php';?>
	<?php include $loginType.'/'.$page_name.'.php';?>
		  			
	<?php include 'dashboard.php'; ?>
				
                <!-- .right-sidebar -->
                
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
			
			
					
								
         <?php //include 'footer.php'; ?>
		 

		
        </div>
        <!-- /#page-wrapper -->
    </div>




 <?php include 'modal.php'; ?>

 <?php include 'js.php'; ?>