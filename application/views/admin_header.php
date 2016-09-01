<?php
	$details = $this->userauth->get_user_details();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Admin Dashboard" />
	<meta name="author" content="" />

	<link rel="icon" href="<?= base_url('assets/images/favicon.ico')?>">

	<title>All About Farmers<?= (isset($title)? ' | '.$title:"")?></title>

	<link rel="stylesheet" href="<?= base_url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/font-icons/entypo/css/entypo.css')?>">
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">//-->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/neon-core.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/neon-theme.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/neon-forms.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/custom.css')?>">

	<script src="<?= base_url('assets/js/jquery-1.11.3.min.js')?>"></script>
	
	<script type="text/javascript">
		jQuery.noConflict();
	</script>

	<!--[if lt IE 9]><script src="<?= base_url('assets/js/ie8-responsive-file-warning.js')?>"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body <?= (isset($effect)?$effect:'') ?>" data-url="http://neon.dev">
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	
	<?php
		$this->load->view('sidebar_menu');
	?>
	<div class="main-content">
	<div class="row">
		
			<!-- Profile Info and Notifications -->
			<div class="col-md-6 col-sm-8 clearfix">
		
				<ul class="user-info pull-left pull-none-xsm">
		
					<!-- Profile Info -->
					<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url('assets/images/thumb-1@2x.png')?>" alt="" class="img-circle" width="44" />
							<?= $details['fullname'] ?> <!-- print user logged in info here //-->
						</a>
		
						<ul class="dropdown-menu">
		
							<!-- Reverse Caret -->
							<li class="caret"></li>
		
							<!-- Profile sub-links -->
							<li>
								<a href="#" data-toggle="modal" data-target="#modal-profile">
									<i class="entypo-user"></i>
									Edit Profile
								</a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#modal-pic">
									<i class="entypo-camera"></i>
									Change Profile Pic
								</a>
							</li>
		
								
							<li>
								<a href="<?= site_url('dashboard/changemypassword')?>">
									<i class="entypo-key"></i>
									Change Password
								</a>
							</li>
		
							<li>
								<a href="<?= site_url('dashboard/logout') ?>">
									<i class="entypo-logout"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
		
				</ul>
				
				<ul class="user-info pull-left pull-right-xs pull-none-xsm">
		
					<!-- Raw Notifications -->
					<li class="notifications dropdown">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="entypo-attention"></i>
							<span class="badge badge-info">6</span>
						</a>
		
						<ul class="dropdown-menu">
							<li class="top">
								<p class="small">
									<a href="#" class="pull-right">Mark all Read</a>
									You have <strong>3</strong> new notifications.
								</p>
							</li>
							
							<li>
								<ul class="dropdown-menu-list scroller">
									<li class="unread notification-success">
										<a href="#">
											<i class="entypo-user-add pull-right"></i>
											
											<span class="line">
												<strong>New user registered</strong>
											</span>
											
											<span class="line small">
												30 seconds ago
											</span>
										</a>
									</li>
									
																		
									<li class="notification-primary">
										<a href="#">
											<i class="entypo-user pull-right"></i>
											
											<span class="line">
												<strong>Privacy settings have been changed</strong>
											</span>
											
											<span class="line small">
												3 hours ago
											</span>
										</a>
									</li>
									
									<li class="notification-danger">
										<a href="#">
											<i class="entypo-cancel-circled pull-right"></i>
											
											<span class="line">
												Avinash cancelled the event
											</span>
											
											<span class="line small">
												9 hours ago
											</span>
										</a>
									</li>
									
									<li class="notification-info">
										<a href="#">
											<i class="entypo-info pull-right"></i>
											
											<span class="line">
												The server is status is stable
											</span>
											
											<span class="line small">
												yesterday at 10:30am
											</span>
										</a>
									</li>
									
									<li class="notification-warning">
										<a href="#">
											<i class="entypo-rss pull-right"></i>
											
											<span class="line">
												New surveys waiting approval
											</span>
											
											<span class="line small">
												last week
											</span>
										</a>
									</li>
								</ul>
							</li>
							
							<li class="external">
								<a href="#">View all notifications</a>
							</li>
						</ul>
		
					</li>
		
					<!-- Message Notifications -->
					
		
					<!-- Task Notifications -->
					
		
				</ul><!-- menus of notifications disabled //-->
		
			</div>
		
		
			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
				<ul class="list-inline links-list pull-right">
		
					<!-- Language Selector -->
					<li class=" language-selector">
		
						Language: &nbsp;
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
							<img src="<?= base_url('assets/images/flags/flag-uk.png')?>" width="16" height="16" />
						</a>
		
							
					</li>
		
					<li class="sep"></li>
		
					
					<li class= "hidden">
						<a href="#" data-toggle="chat" data-collapse-sidebar="1">
							<i class="entypo-chat"></i>
							Chat
		
							<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
						</a>
					</li>
		
					
		
					<li>
						<a href="<?= site_url('dashboard/logout') ?>">
							Log Out <i class="entypo-logout right"></i>
						</a>
					</li>
				</ul>
		
			</div>
		
		</div>
		<hr/>
		
	<!-- Modal 6 Profile Edit)-->
	<div class="modal fade" id="modal-profile" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Profile</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="row">
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="field-1" class="control-label">Name</label>
								
								<input type="text" class="form-control" id="field-1" placeholder="John">
							</div>	
							
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="field-2" class="control-label">Surname</label>
								
								<input type="text" class="form-control" id="field-2" placeholder="Doe">
							</div>	
						
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="field-3" class="control-label">Address</label>
								
								<input type="text" class="form-control" id="field-3" placeholder="Address">
							</div>	
							
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="field-4" class="control-label">City</label>
								
								<input type="text" class="form-control" id="field-4" placeholder="Boston">
							</div>	
							
						</div>
						
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="field-5" class="control-label">Country</label>
								
								<input type="text" class="form-control" id="field-5" placeholder="United States">
							</div>	
						
						</div>
						
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="field-6" class="control-label">Zip</label>
								
								<input type="text" class="form-control" id="field-6" placeholder="123456">
							</div>	
						
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group no-margin">
								<label for="field-7" class="control-label">Personal Info</label>
								
								<textarea class="form-control autogrow" id="field-7" placeholder="Write something about yourself"></textarea>
							</div>	
							
						</div>
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</div>
	</div><!-- model end -->
	
<!-- change pic -->
<!-- Modal 6 Pic Edit)-->
	<div class="modal fade" id="modal-pic" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Change pic</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="row">
						<div class="col-md-3">
							
							<form action="<?= site_url('dashboard/upload_pic') ?>" method="post" onsubmit="return checkCoords();" target="_blank">
											<input type="hidden" id="x" name="x" />
											<input type="hidden" id="y" name="y" />
											<input type="hidden" id="w" name="w" />
											<input type="hidden" id="h" name="h" />
											<input type="submit" value="Crop Image" class="btn btn-large btn-primary" />
						</form>
						
							<div class="form-group">
												<!--<label class="col-sm-3 control-label">Set Profile Pic</label>//-->
												
												<div class="col-sm-5">
													
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
															<img src="<?= base_url('assets/images/thumb-1@2x.png')?>" alt="..." class="img-responsive img-rounded" >
														</div>
														<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px"></div>
														<div>
															<span class="btn btn-white btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" name="..." accept="image/*">
															</span>
															<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
													
												</div>
						
						
						
						</div>
						
						</div>
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/js/fileinput.js')?>" type="text/javascript"></script>
	<!-- model pic end -->

	