<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-flow-tree"></i>Campaign List</h3>
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
		
		<script type="text/javascript">
		jQuery( window ).load( function() {
			var $table2 = jQuery( "#table-2" );
			
			// Initialize DataTable
			$table2.DataTable( {
				"sDom": "tip",
				"bStateSave": false,
				"pagingType": "full_numbers",
				
				
			});
			
			// Highlighted rows
			$table2.find( "tbody input[type=checkbox]" ).each(function(i, el) {
				var $this = $(el),
					$p = $this.closest('tr');
				
				$( el ).on( 'change', function() {
					var is_checked = $this.is(':checked');
					
					$p[is_checked ? 'addClass' : 'removeClass']( 'highlight' );
				} );
			} );
			
			
		} );
			
		
		</script>
		
		
		
		<table class="table table-bordered table-striped datatable" id="table-2">
			<thead>
				<tr>
					<th>ID</th>
					<th>Survey Title</th>
					<th>Agents</th>
					<th>Date Range</th>
					<th>Back Limit</th>
					<th>Actions</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
				$campaing_list = $this->campaign_model->get_formattedlist();
				if(!empty($campaing_list)):
			?>
			<?php foreach($campaing_list as $campaign):?>
				<tr>
					<td><?=$campaign['id']?></td>
					<td><?=$campaign['survey_title']?></td>
					<td><?= implode('<br/>', $campaign['agents'])?></td>
					<td><?= date('d M Y', strtotime($campaign['start_date'])) ?> to <?= date('d M Y', strtotime($campaign['end_date'])) ?> </td>
					<td><?= $campaign['back_limit'] ?></td>
					
					<td>
						<a href="<?= site_url('dashboard/edit_campaign').'/'.$campaign['id'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							Edit
						</a>
						
						<a href="<?= site_url('dashboard/delete_campaign').'/'.$campaign['id'] ?>" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="entypo-cancel"></i>
							Delete
						</a>
						
						
					</td>
				</tr>
				<?php endforeach;?>
			<?php else: ?>
				<div class="alert alert-danger">No records found !!!</div>
			<?php endif; ?>	
				
				
			</tbody>
		</table>
		
		
		
		
		
		
	</div>
</div>
	
<script src="<?= base_url('assets/js/datatables/datatables.min.js')?>"></script>