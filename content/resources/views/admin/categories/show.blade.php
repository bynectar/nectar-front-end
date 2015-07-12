@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $category->title }}</div>

				<div class="panel-body">
					
					<!-- Category Info -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Content</th>
								<th>Owner</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $category->title }}</td>
								<td>{{ $category->description }}</td>
								<td>{{ $category->user['name'] }}</td>
								<td>
									<!-- Delete Category -->
									{!! Form::open(['method'=>'delete','action'=>['CategoryController@destroy',$category->id]]) !!}
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
