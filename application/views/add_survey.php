<!-- add survey //-->
<script src="<?= base_url('assets/js/angularjs/angularjs-1.5.8.min.js')?>"></script>
<!-- angularjs module for survey -->

<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-clipboard"></i>Add Survey</h3>
			
		</div>
		
	</div>

	<div class="panel-body">
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
		<div class="tab-content">
				<form id="add-campaign-form" method="post" action="<?= site_url('Bl/add_survey')?>" class="validate" role="form" class="form-horizontal">

						
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label" for="title">Title</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="entypo-pencil"></i>
											</div>
											<input name="title" id="title" class="form-control" data-validate="required" placeholder="Enter title here..." />
										</div>
									</div>
								</div>								
							</div>
							
							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label class="control-label" for="description">Description</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="entypo-pad"></i>
											</div>
											<textarea class="form-control" data-validate="required" name="description" id="description" placeholder="Enter description here..."></textarea>
										</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label class="control-label" for="title">Keywords</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="entypo-book"></i>
											</div>
											<input id="keywords" name="keywords" type="text" value="" class="form-control tagsinput" placeholder="Enter tags here" />
										</div>
									</div>
								</div>								
							</div>
								
								
							
							
																			
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Save Survey</button>
								
							</div>
						
						
				</form>
				<!-- put in edit survey 
				<button class="btn btn-success" data-toggle="modal" data-target="#modal-survey">Add Questions</button>
				
				
				

	<div class="modal fade" id="modal-survey" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Survey</h4>
				</div>
				
				<div class="modal-body">
				
						<h3> Survey questions</h3>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/js/fileinput.js')?>" type="text/javascript"></script>
		
				
				//-->
		</div>
	</div>	
</div>

