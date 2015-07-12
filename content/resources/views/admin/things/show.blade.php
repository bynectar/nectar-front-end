@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">

				<div class="panel-heading">{{ $thing->title }}</div>

					<!-- Category Info -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Category</th>
								<th>Owner</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $thing->title }}</td>
								<td>{{ $thing->description }}</td>
								<td>{{ $thing->category['title'] }}</td>
								<td>{{ $thing->user['name'] }}</td>
								<td>
									<!-- Delete Category -->
									{!! Form::open(['method'=>'delete','action'=>['ThingController@destroy',$thing->id]]) !!}
									 <button type="submit">Delete</button>                      
									{!! Form::close() !!}									
								</td>
							</tr>
						</tbody>
					</table>

				</div>

				<div class="panel-heading">Reviews</div>

				<div class="panel-body">
					
					<!-- Category Info -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Rating</th>
								<th>Description</th>
								<th>Owner</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $thing->reviews as $review )
							<tr>
								<td>{{ $review->title }}</td>
								<td>{{ $review->rating['rating'] }}</td>
								<td>{{ $review->content }}</td>
								<td>{{ $review->user['name'] }}</td>
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
							@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
