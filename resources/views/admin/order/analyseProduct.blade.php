@if(count($analyseProduct) > 0)
<div class="row m-0 px-50" id="adminUserTableList">
	<table class="table table-hover" id="list_type">
		<thead>
			<tr>
				<th colspan="4" class="text-center"><h3>Type: {{ title_case($orderType) }}<h3></th>
			</tr>
			<tr>
				<th scope="col">STT</th>
				<th scope="col">Product</th>
				<th scope="col">Time</th>
			</tr>
		</thead>
		<tbody>
			<?php $stt = 1;?>
			@foreach ($analyseProduct as $record)
			<tr>
				<td>{{ $stt++ }}</td>
				<td>{{ $record->name }}</td>
				<td>{{ $record->time }}</td>
				<td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class="row m-0 px-50" id="adminUserTableList">
		<h4>{{ 'No Data' }}</h4>
	</div>
@endif