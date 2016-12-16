<?php
	//echo '<pre>';
	$query = $this->db->query('select r.*, s.angular_form, s.title from tblrespondant r, tblsurvey s where s.id = r.surveyid and  r.id='.intval($id));
	$result = $query->result_array();// || array();
	//print_r($result); exit;
	//echo '</pre>';
	if(count($result) <=0){
		redirect(site_url('dashboard/report_agent'));
	}
	$qas = getResponseSheet(json_decode($result[0]['angular_form']), json_decode($result[0]['angular_form_response']), true);
	$qs = $qas[0];
	$ans = $qas[1];
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-clipboard"></i>Response ID #<?= $result[0]['id']?> (<?= $result[0]['title']?></h3>
			<h3><i class="entypo-mobile"></i><?= $result[0]['mobileid']?></h3>
			<h3><i class="entypo-user"></i><?= $result[0]['fullname']?></h3>
			<h3><i class="entypo-clock"></i><?= date('l jS \of F Y h:i:s A', strtotime($result[0]['dateofsurvey']))?></h3>
			<h3><i class="entypo-location"></i><?= $result[0]['address']?> - <?= $result[0]['pincode']?></h3>
			<h3><i class="entypo-compass"></i><?= $result[0]['latitude'] ? $result[0]['latitude'] : '0'?>, <?= $result[0]['longitude'] ? $result[0]['longitude'] : '0' ?></h3>

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
					
					<th>Questions ?</th>
					<th>Answers</th>
					
				</tr>
			</thead>
			
			<tbody>
			
						<?php foreach($qs as $index => $val):?>
							<tr>
								<td><?= $qs[$index]?></td>
								<td><?= $ans[$index]?></td>
							</tr>
						<?php endforeach; ?>	
			
			</tbody>
		</table>
		
	<?php else:?>
		<div class="error">No records found!</div>
	<?php endif;?>
	</div>
</div>
	
