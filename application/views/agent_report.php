<?php
	//echo '<pre>';
	$query = $this->db->query('select u.userid, u.mobile, u.fullname, u.gender, u.address, u.pincode, (select count(*) from tblrespondant t where t.userid = u.userid) as survey_count from tbluserdetails u order by survey_count desc;');
	$result = $query->result_array();// || array();
	//print_r($result);
	//echo '</pre>';
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>Agent Report</h3>
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
					
					<th>Mobile Number</th>
					<th>Full Name</th>
					<th>Gender</th>
					<th>Address</th>
					
					<th>Survey Count</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach($result as $row):?>
				<tr>
					
					<td><?= $row['mobile']?></td>
					<td><?= $row['fullname']?></td>
					<td><?= $row['gender']?></td>
					<td><?= $row['address']?> - <?= $row['pincode']?></td>
					<td class="<?= ($row['survey_count'] > 0 ? 'text-info': 'text-danger')?>"><?= $row['survey_count']?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php else:?>
		<div class="error">No records found!</div>
	<?php endif;?>
	</div>
</div>
	
