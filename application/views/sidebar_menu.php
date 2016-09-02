<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
			
			<header class="logo-env">

				<!-- logo -->
				<div class="logo" >
					<a href="<?= site_url()?>">
						<img src="<?= base_url('assets/images/logo@2x.png')?>" width="221" alt="" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>

								
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>
			
									
			<!-- enter menu code herer // -->		

			<ul id="main-menu" class="main-menu">
				<li class="">
					<a href="<?= site_url()?>">
						<i class="entypo-gauge"></i>
						<span class="title">Dashboard</span>
					</a>
					
				</li>
				
				<li class="has-sub"><!-- Submenu start //-->
					<a href="">
						<i class="entypo-users"></i>
						<span class="title">User Management</span>
					</a>
					<ul>
						<li class="has-sub">
							<a href="#">
								<span class="title">Manage Users</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_user')?>">
										<span class="title">Create user</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_user')?>">
										<span class="title">Update user</span>
									</a>
								</li>
								
							</ul>
						</li>
						<li class="has-sub">
							<a href="#">
								<span class="title">Manage Roles</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_role')?>">
										<span class="title">Create role</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_role')?>">
										<span class="title">Edit role</span>
									</a>
								</li>
								
							</ul>

						</li>
						
					</ul>
				</li><!-- submenu end //-->

				<li class="has-sub"><!-- Submenu start //-->
					<a href="">
						<i class="entypo-book"></i>
						<span class="title">Master Data</span>
					</a>
					<ul>
						<li class="has-sub">
							<a href="#">
								<span class="title">Manage District</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_district')?>">
										<span class="title">Create district</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/update_district')?>">
										<span class="title">Update district</span>
									</a>
								</li>
								
							</ul>
						</li>

						<li class="has-sub">
							<a href="#">
								<span class="title">Manage Block</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_block')?>">
										<span class="title">Create block</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_block')?>">
										<span class="title">Edit block</span>
									</a>
								</li>
								
							</ul>
						</li>

						<li class="has-sub">
							<a href="#">
								<span class="title">Manage Company</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_company')?>">
										<span class="title">Create company</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_company')?>">
										<span class="title">Edit company</span>
									</a>
								</li>
								
							</ul>
						</li>
						<li class="has-sub">
							<a href="#">
								<span class="title">Manage UOM</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_uom')?>">
										<span class="title">Create UOM</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_uom')?>">
										<span class="title">Edit UOM</span>
									</a>
								</li>
								
							</ul>
						</li>
						
					</ul>
				</li><!-- submenu end //-->

				<li class="has-sub"><!-- Submenu start //-->
					<a href="">
						<i class="entypo-clipboard"></i>
						<span class="title">Survey Management</span>
					</a>
					<ul>
						<li class="has-sub">
							<a href="#">
								<span class="title">Manage Surveys</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_survey')?>">
										<span class="title">Create survey</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_survey')?>">
										<span class="title">Update survey</span>
									</a>
								</li>
								
							</ul>
						</li>

						<li class="has-sub">
							<a href="#">
								<span class="title">Manage Campaigns</span>
							</a>
							<ul>
								<li>
									<a href="<?= site_url('dashboard/add_campaign')?>">
										<span class="title">Create campaign</span>
									</a>
								</li>
								<li>
									<a href="<?= site_url('dashboard/edit_campaign')?>">
										<span class="title">Update campaign</span>
									</a>
								</li>
								
							</ul>


						</li>

						
						
					</ul>
				</li><!-- submenu end //-->

				<li class="has-sub"><!-- submenu start //-->
					<a href="#">
						<i class="entypo-chart-bar"></i>
						<span class="title">Reports</span>
					</a>
					<ul>
						<li>
							<a href="">
									<span class="title">Survey report</span>
							</a>
						</li>
						<li>
							<a href="">
									<span class="title">Agent report</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="">
					<a href="#">
						<i class="entypo-newspaper"></i>
						<span class="title">Settings</span>
					</a>
				</li>



			
			</ul>
	</div>
</div>