		
		<script type="text/javascript">
		jQuery(document).ready(function($) 
		{
			// Sample Toastr Notification
			setTimeout(function()
			{			
				var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
					//"toastClass": "black",
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "2000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
		
				toastr.info("Welcome <?= $this->session->userdata('user_details')['fullname'] ?> admin dashboard", "Account Panel", opts);
			}, 3000);
			
			// Sparkline Charts
			$(".top-apps").sparkline('html', {
			    type: 'line',
			    width: '50px',
			    height: '15px',
			    lineColor: '#ff4e50',
			    fillColor: '',
			    lineWidth: 2,
			    spotColor: '#a9282a',
			    minSpotColor: '#a9282a',
			    maxSpotColor: '#a9282a',
			    highlightSpotColor: '#a9282a',
			    highlightLineColor: '#f4c3c4',
			    spotRadius: 2,
			    drawNormalOnTop: true
			 });
		
			$(".monthly-sales").sparkline([1,5,6,7,10,12,16,11,9,8.9,8.7,7,8,7,6,5.6,5,7,5,4,5,6,7,8,6,7,6,3,2], {
				type: 'bar',
				barColor: '#ff4e50',
				height: '55px',
				width: '100%',
				barWidth: 8,
				barSpacing: 1
			});	
			
			$(".pie-chart").sparkline([2.5,3,2], {
			    type: 'pie',
			    width: '95',
			    height: '95',
			    sliceColors: ['#ff4e50','#db3739','#a9282a']
			});
		    
		    
			$(".daily-visitors").sparkline([1,5,5.5,5.4,5.8,6,8,9,13,12,10,11.5,9,8,5,8,9], {
			    type: 'line',
			    width: '100%',
			    height: '55',
			    lineColor: '#ff4e50',
			    fillColor: '#ffd2d3',
			    lineWidth: 2,
			    spotColor: '#a9282a',
			    minSpotColor: '#a9282a',
			    maxSpotColor: '#a9282a',
			    highlightSpotColor: '#a9282a',
			    highlightLineColor: '#f4c3c4',
			    spotRadius: 2,
			    drawNormalOnTop: true
			 });
		
		
			$(".stock-market").sparkline([1,5,6,7,10,12,16,11,9,8.9,8.7,7,8,7,6,5.6,5,7,5], {
			    type: 'line',
			    width: '100%',
			    height: '55',
			    lineColor: '#ff4e50',
			    fillColor: '',
			    lineWidth: 2,
			    spotColor: '#a9282a',
			    minSpotColor: '#a9282a',
			    maxSpotColor: '#a9282a',
			    highlightSpotColor: '#a9282a',
			    highlightLineColor: '#f4c3c4',
			    spotRadius: 2,
			    drawNormalOnTop: true
			 });
		
			 
			 $("#calendar").fullCalendar({
				header: {
					left: '',
					right: '',
				},
				
				firstDay: 1,
				height: 200,
			});
		});
		
		
		function getRandomInt(min, max) 
		{
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}
		</script>
		
		<?php
		// if validation errors
		$err = $this->session->flashdata('err');
		if($err){
			foreach( $err as $er){
		
		?>
		<div class="row">
			<div class="alert alert-danger"><?= $er?></div>
		</div>
		<?php
			}
			}
			// check for success msg and print it
			$msg = $this->session->flashdata('msg');
			if($msg){
				echo '<div class="row">';
				echo '<div class="alert alert-success"><strong>Well done!</strong> '.$msg.'</div>';
				echo '</div>';
			}

			// check for msgbox msg and output the javascript accordingly
			$msgbox = $this->session->flashdata('msgbox');
			if($msgbox):
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-bottom-left",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
			};
		
			toastr.success("<?= $msgbox ?>", "Success", opts);
		});
			
		</script>
		<?php endif; ?>
		<div class="col-md-6">
				<div class="tile-stats tile-neon-red">
					<div class="icon"><i class="entypo-chat"></i></div>
					<?php 
						$q = $this->db->get('tblcampaign');
						$rows = $q->num_rows() ? $q->num_rows() : 0;
					?>
					<div class="num" data-start="0" data-end="<?=$rows?>" data-postfix="" data-duration="1400" data-delay="0">
					0
					</div>
					
					<h3>Campaigns</h3>
					<p>Total Campaigns</p>
				</div>	
				
				<br />
				<?php 
						$q = $this->db->get('tblrespondant');
						$rows = $q->num_rows() ? $q->num_rows() : 0;
					?>
				
				<div class="tile-stats tile-primary">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="<?= $rows ?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
					
					<h3>Total Responses</h3>
					<p>Responses till date</p>
				</div>	
				
					
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-4">
				<div class="tile-stats tile-white stat-tile">
					<h3>15% more</h3>
					<p>Survey statistics</p>
					<span class="daily-visitors"></span>
				</div>		
			</div>
		
			<div class="col-md-3 col-sm-4">
				<div class="tile-stats tile-white stat-tile">
					<h3>32 Surveys</h3>
					<p>Avg. surveys per day</p>
					<span class="monthly-sales"></span>
				</div>		
			</div>
		
		
			<div class="col-md-3 col-sm-4">
				<div class="tile-stats tile-white stat-tile">
					<h3>-0.0102</h3>
					<p>Stock Market</p>
					<span class="stock-market"></span>
				</div>		
			</div>
		
		
			<div class="col-md-3 col-sm-4">
				<div class="tile-stats tile-white stat-tile">
					<h3>61.5%</h3>
					<p>Crop share</p>
					<span class="pie-chart"></span>
				</div>		
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-md-12">
				
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						var map = $("#map-2");
						
						map.vectorMap({
							map: 'in_mill',
							zoomMin: '3',
							backgroundColor: '#f4f4f4',
							focusOn: { x: 0.2, y: 0, scale: 1 },
						    markers: [
						      {latLng: [30.7333, 76.7794], name: 'Chandigarh'},
						      {latLng: [31.1048, 77.1734], name: 'Shimla'},
						      {latLng: [28.7041, 77.1025], name: 'New Delhi'},
						    ],
						    markerStyle: {
						      initial: {
						        fill: '#ff4e50',
						        stroke: '#ff4e50',
							    "stroke-width": 6,
							    "stroke-opacity": 0.3,
		    				      }
						    },	
							regionStyle: 
								{
								  initial: {
								    fill: '#e9e9e9',
								    "fill-opacity": 1,
								    stroke: 'none',
								    "stroke-width": 0,
								    "stroke-opacity": 1
								  },
								  hover: {
								    "fill-opacity": 0.8
								  },
								  selected: {
								    fill: 'yellow'
								  },
								  selectedHover: {
								  }
								}					
						});
					});
				</script>
				
				<div class="tile-group tile-group-2">
					<div class="tile-left tile-white">
						<div class="tile-entry">
							<h3>Surveyor Map</h3>
							<span>Where do our agents come from</span>
						</div>
						<ul class="country-list">
							<li><span class="badge badge-secondary">3</span>  Chandigarh</li>
							<li><span class="badge badge-secondary">2</span>  Shimla</li>
							<li><span class="badge badge-secondary">1</span>  New Delhi</li>
						</ul>
					</div>
					
					<div class="tile-right">
						
						<div id="map-2" class="map"></div>
						
					</div>
					
				</div>
				
			</div>
		
		
		
			
		</div>
		
		
		

		
		

		
	
	
	
		
