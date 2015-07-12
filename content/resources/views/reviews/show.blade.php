@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $review->title }}</div>

				<div class="panel-body">
					
					<!-- User Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Rating</th>
								<th>Content</th>
								<th>Owner</th>
								<th>Thing</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $review->title }}</td>
								<td>{{ $review->rating['rating'] }}</td>
								<td>{{ $review->content }}</td>
								<td>{{ $review->user['name'] }}</td>
								<td>{{ $review->thing['title'] }}</td>
								<td>
									<!-- Edit Review -->
									{!! Form::open(['method'=>'get','action'=>['ReviewController@edit',$review->id]]) !!}
									 <button type="submit">Edit</button>                      
									{!! Form::close() !!}									
									<!-- Delete Review -->
									{!! Form::open(['method'=>'delete','action'=>['ReviewController@destroy',$review->id]]) !!}
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
