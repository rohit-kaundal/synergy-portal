<?php
	//echo '<pre>';
	$query = $this->db->query('select s.id, s.title, s.description, (select count(*) from tblrespondant t where t.surveyid = s.id) as responses from tblsurvey s');
	$result = $query->result_array();// || array();
	//print_r($result);exit;
	//echo '</pre>';
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>Survey Report</h3>
		</div>
		
	</div>

	<div class="panel-body">
	<script type="text/javascript">
		jQuery( window ).load( function() {
			var $table2 = jQuery( "#table-2" );
			
			// Initialize DataTable
			$table2.DataTable( {
				"sDom": "tip",
				"bStateSave": false,
				"iDisplayLength": 8,
				"aoColumns": [
					{ "bSortable": false },
					null,
					null,
					null,
					null
				],
				"bStateSave": true
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
			
			// Replace Checboxes
			$table2.find( ".pagination a" ).click( function( ev ) {
				replaceCheckboxes();
			} );
		} );
			
		// Sample Function to add new row
		var giCount = 1;
		
		/*function fnClickAddRow() {
			jQuery('#table-2').dataTable().fnAddData( [ '<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount + ".1", giCount + ".2", giCount + ".3", giCount + ".4" ] );
			replaceCheckboxes(); // because there is checkbox, replace it
			giCount++;
		}*/
		</script>
		
	<?php if($result): ?>
		
		<table class="table table-bordered table-striped datatable" id="table-2">
			<thead>
				<tr>
					
					<th>Survey</th>
					<th>Description</th>
					<th>Responses</th>					
				</tr>
			</thead>
			
			<tbody>
			<?php foreach($result as $row):?>
				<tr>
					
					
					<td><?= $row['title']?></td>
					<td><?= $row['description']?></td>
					
					<td class="<?= ($row['responses'] > 0 ? 'text-info': 'text-danger')?>"><?= $row['responses']?>
						<?php if($row['responses'] > 0):?>
							<a href="<?=site_url('dashboard/report_survey/'.$row['id']) ?>"><button class="btn-info"> Download</button></a>							
						<?php endif;?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php else:?>
		<div class="error">No records found!</div>
	<?php endif;?>
	</div>
</div>
	
