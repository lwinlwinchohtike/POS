@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-3">
		@include("backend.sidebar")            
	</div>
	<div class="col-md-9">
		<div class="panel panel-danger">
			<div class="panel-heading">Role Management</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<h3>Unauthorized Access</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection