	<div class="row m-0">
		<div class="col-auto py-3 px-5">
			<form action="{{ route('admin.user.bulkAction') }}" class="row" id="adminUserBulkActionForm" method="post">
				@csrf
				<select name="action" class="col-auto pl-3 py-0 mr-3">
					<option value="none">No Action</option>
					<option value="activate">Activate</option>
					<option value="deactivate">DeActivate</option>
					<option value="destroy">Solf Delete</option>
					<option value="restore">Restore</option>
					<option value="forceDelete">Permanently Delete</option>
				</select>
				<input type="submit" value="Bulk Action" class="col-auto btn btn-dark">
			</form>
		</div>
	</div>
