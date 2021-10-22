 <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="#"><b><img src="<?php echo base_url();?>uploads/logo.png" class="img-fluid" alt="home" /></b>
                    <?php echo $system_title = $this->db->get_where('settings' , array('type'=>'system_title'))->row()->description; ?>
                </a></div>
                   
            <ul class="nav navbar-top-links navbar-right pull-right">
               
                    
                    <!-- /.dropdown -->
                    <li class="dropdown">

                        
                    <a class="dropdown-toggle" href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i>  Logout</a>
                     </a>
                   
                        <!-- /.dropdown-user -->
                    </li>
                   
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>


<script type="text/javascript">
	$(document).ready(function(){
		$('.set_langs').on('click', function(){
		var lang_url = $(this).data('href');
			$.ajax({url: lang_url, success: function (result){
				location.reload();
			}});
		});
	});
</script>