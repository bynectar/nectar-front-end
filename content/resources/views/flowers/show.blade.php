@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $flower->title }}</div>

				<div class="panel-body">
					
					<!-- User Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Common Name 1</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $flower->common_name_1 }}</td>
								<td>
									<!-- Edit Review -->
									{!! Form::open(['method'=>'get','action'=>['FlowerController@edit',$flower->id]]) !!}
									 <button type="submit">Edit</button>                      
									{!! Form::close() !!}									
									<!-- Delete Review -->
									{!! Form::open(['method'=>'delete','action'=>['FlowerController@destroy',$flower->id]]) !!}
									 <button type="submit">Delete</button>                      
									{!! Form::close() !!}									
								</td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
