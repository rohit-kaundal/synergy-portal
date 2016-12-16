<?php
	//echo '<pre>';
	$query = $this->db->query('select u.userid, u.mobile as agent_mobile, u.fullname as agent_fullname, u.gender as agent_gender, u.address agent_address, u.pincode as agent_pincode, t.* from tblrespondant t, tbluserdetails u  where u.userid = t.userid and t.userid = '.intval($id).' order by dateofsurvey desc');
	$result = $query->result_array();// || array();
	//print_r(array_keys($result[0])); exit;
	//echo '</pre>';
	if(count($result) <=0){
		redirect(site_url('dashboard/report_agent'));
	}
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-clipboard"></i><?= $result[0]['agent_fullname']?> - Report (<?= count($result)?> respondants)</h3>
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
					
					<th>Respondant Number</th>
					<th>Respondant Full Name</th>
					<th>Date of Survey</th>
					<th>Address</th>
					<th>LAT/LONG</th>				
					<th>View Survey</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach($result as $row):?>
				<tr>
					
					<td><?= $row['mobileid']?></td>
					<td><?= $row['fullname']?></td>
					<td><?= date('l jS \of F Y h:i:s A', strtotime($row['dateofsurvey']))?></td>
					<td><?= $row['address']?> - <?= $row['pincode']?></td>
					<td><?= $row['latitude'] ? $row['latitude'] : '0'?>, <?= $row['longitude'] ? $row['longitude'] : '0' ?></td>
					<td><a href="<?= site_url('dashboard/survey_response/'.$row['id']) ?>"><button class="btn-danger">View Response</button></a></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php else:?>
		<div class="error">No records found!</div>
	<?php endif;?>
	</div>
</div>
	
