<!DOCTYPE html>
    <head>
        <title>Title Here</title>
		 <link rel="icon"  sizes="16x16" href="<?php echo base_url();?>uploads/logo.png">
        <meta charset="utf-8" />
		<link href="<?php echo base_url(); ?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >
		<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/bootstrap.css"/>
    	<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/react-select.css"/>
	
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="A complete and most powerful school system management system for all. Purchase and enjoy">
		<meta content=" Optimum Linkup - Online Education & Learning Courses HTML CSS Responsive Template" name="description">
		<meta name="author" content="Optimum Linkup Computers">
		<meta name="keywords" content="multi school system, multi branch school, ofine school, super school, html rtl, html dir rtl, 
		rtl website template, bootstrap 4 rtl template, rtl bootstrap template, admin panel template rtl, admin panel rtl, html5 rtl, academy training course css template, 
		classes online training website templates, courses training html5 template design, education training rwd simple template, educational learning management jquery html, 
		elearning bootstrap education template, professional training center bootstrap html, institute coaching mobile responsive template, 
		marketplace html template premium, learning management system jquery html, clean online course teaching directory template, 
		online learning course management system, online course website template css html, premium lms training web template, training course responsive website"/>
	
    </head>
    <body>
        <style type="text/css">
      
            .navbar-inverse {
                background-color: #2f4371;
                border-color: #2f4371;
            }
            .navbar-header h4 {
                margin: 0;
                padding: 10px 15px;
                color: #c4c2c2;
            }
            .navbar-right h5 {
                margin: 0;
                padding: 0px 0px;
                color: #c4c2c2;
            }
            .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
                border-color: transparent;
            }
        </style>

							<!-- Select * From Jitsi with Jitsi ID -->
                            <?php 
                            $select = $this->db->get_where('jitsi', array('jitsi_id' => $jitsi_id))->result_array();
                            foreach ($select as $key => $row):
							$user = explode('-', $row['user_id']);
							$user_type = $user[0];
							$user_id = $user[1];
							$HostName =  $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row();
                            $accountType = $this->session->userdata('login_type');
                            ?>

		<!-- Nav For Top Fix navbar-fixed-top -->
        <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <h4 style="color:white"><i class="fa fa-plus"></i> Meeting Title : <?=$row['title']?></h4>
                </div>
                <div class="navbar-form navbar-right">
                    <h5 style="color:white"> HOST BY : 
					<img src="<?=$this->crud_model->get_image_url($user_type, $user_id)?>" HostImageclass="img-circle" height="30" width="30"/> <?=$HostName->name?>
					&nbsp;&nbsp;&nbsp;<a href="<?=base_url()?><?=$accountType.'/'.'jitsi'?>" style="color:white"> Back </a></h5>
<!-- <h5 style="color:#fff;"> <?php // echo $accountType ?></h5> -->
                    

                </div>
            </div>
        </nav>
		
		<!-- Container That Render Jitsi -->
		<div id="container" style="width:100%;height:100vh">

	<!-- Meet Jitsi API -->	
	<script src="https://8x8.vc/external_api.js"></script>

<?php
 if ($accountType == 'teacher') {
    //echo '<script>alert("This Teacher Acc")</script>';
    //$this->load->view('backend/index', 'refresh');
}

 if ($accountType == 'student') {
  //echo '<script>alert("This Student Acc")</script>';
  //$this->load->view('backend/index', 'refresh');
 }

?>

	<script>
		var domain = "8x8.vc";



    
        var options = {

			userInfo : { 
				email : '<?=$accountType->email;?>' , 
				displayName : ' <?=
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>',
                
				moderator: true,
			},
			//roomName: "<?php echo $row['room'];?>",
			roomName: "vpaas-magic-cookie-42d22ece486642bc99184ffbe1010e24/<?= $row['room'];?>",
			width: "100%",
			height: "100%",
           //jwt: "eyJraWQiOiJ2cGFhcy1tYWdpYy1jb29raWUtNDJkMjJlY2U0ODY2NDJiYzk5MTg0ZmZiZTEwMTBlMjQvOTNkNWY4LVNBTVBMRV9BUFAiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJqaXRzaSIsImV4cCI6MTYyODI2NDYxMiwibmJmIjoxNjI4MjU3NDA3LCJpc3MiOiJjaGF0Iiwicm9vbSI6IioiLCJzdWIiOiJ2cGFhcy1tYWdpYy1jb29raWUtNDJkMjJlY2U0ODY2NDJiYzk5MTg0ZmZiZTEwMTBlMjQiLCJjb250ZXh0Ijp7ImZlYXR1cmVzIjp7ImxpdmVzdHJlYW1pbmciOmZhbHNlLCJvdXRib3VuZC1jYWxsIjpmYWxzZSwic2lwLW91dGJvdW5kLWNhbGwiOmZhbHNlLCJ0cmFuc2NyaXB0aW9uIjpmYWxzZSwicmVjb3JkaW5nIjpmYWxzZX0sInVzZXIiOnsibW9kZXJhdG9yIjp0cnVlLCJuYW1lIjoiVGVzdCBVc2VyIiwiaWQiOiJhdXRoMHw2MDg2OWE2YmRlM2U4ZDAwNzFlMDk4MGYiLCJhdmF0YXIiOiIiLCJlbWFpbCI6InRlc3QudXNlckBjb21wYW55LmNvbSJ9fX0.W7Qgajnt0IwAnDr8jGaJPUCfj8EqnaN6PiVx_9eY5n1M5PnQ6jlefBmaGqDwDThLxjcTt7MtqYxL7GMkKMWBx3Rw43Zgan8wXtOWhiFk_GjkgyTmSfpZo_DsINgYt_o_8ii-NtrgnXAp6uN6w0ANE747VI6Dqmm84dkvDd3e1xrZ7OBu7HDF5KPRieGW24YMBE39S4_OeNEY8ev_Hue1MKJvOuImXPye9nKva8A5j13D-3Kz94E_RgOs5knHvSVcq3GRUALODj_jmzIMEuWhNVBWJzViJEhBAyAL3Ys0WResQzDuKvQIMggo8hK1JrmzhsuJS_o9Ftg6ct7h1cWzhg",
			parentNode: document.querySelector('#container'),

			configOverwrite: {
			doNotStoreRoom: false,
            startVideoMuted: 0,
            startWithVideoMuted: true,
            startWithAudioMuted: true,
            enableWelcomePage: false,
            prejoinPageEnabled: false,
            disableRemoteMute: true,
            remoteVideoMenu: {
                disableKick: false,
            },

			},
            
			interfaceConfigOverwrite: {
			filmStripOnly: true,
           //TOOLBAR_BUTTONS: [],
           TOOLBAR_BUTTONS: ['microphone', 'camera', 'desktop', 'participant', 'fullscreen', 'fodeviceselection', 'hangup', 'chat','sharevideo', 'raisehand','tileview','videobackgroundblur',],
			}
 

		}
    

		var api = new JitsiMeetExternalAPI(domain, options);
			api.executeCommand('subject', '<?php echo $row['title'];?>');

	</script>


	<?php endforeach;?>

		
    </body>
</html>

    