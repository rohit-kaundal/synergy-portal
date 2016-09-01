<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>UOM List</h3>
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
		
		function fnClickAddRow() {
			jQuery('#table-2').dataTable().fnAddData( [ '<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount + ".1", giCount + ".2", giCount + ".3", giCount + ".4" ] );
			replaceCheckboxes(); // because there is checkbox, replace it
			giCount++;
		}
		</script>
		
		
		
		<table class="table table-bordered table-striped datatable" id="table-2">
			<thead>
				<tr>
					<th>Headings</th>
					<th>Actions</th>
				</tr>
			</thead>
			
			<tbody>
			
				<tr>
					<td>heading</td>
					<td>
						<a href="#" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							Edit
						</a>
						
						<a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="entypo-cancel"></i>
							Delete
						</a>
						
						
					</td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
	
