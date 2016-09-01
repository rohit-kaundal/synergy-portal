<!-- change pic -->
<div class="panel panel-primary">

	<div class="panel-heading">
		
		
	</div>
	<div class="panel-body">
		
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

<script src="<?= base_url('assets/js/fileinput.js')?>" type="text/javascript"></script>
	<script src="<?= base_url('assets/jcrop/jquery.Jcrop.min.js')?>" type="text/javascript"></script>
<!-- change pic end -->