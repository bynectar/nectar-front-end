@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<!-- Create Review -->
			{!! Form::open(['method'=>'get','action'=>['ReviewController@create']]) !!}
			 <button type="submit">New Review</button>                      
			{!! Form::close() !!}
			<br>

			<div class="panel panel-default">

				<div class="panel-heading">List Reviews</div>

				<div class="panel-body">
					
					<!-- Users Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Rating</th>
								<th>Content</th>
								<th>Thing</th>
								<th>Flags</th>
								<th>Votes</th>
								<th>Owner</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $reviews as $review )
							<tr>
								<td>{!! $review->title !!}</td>
								<td>{!! $review->rating['rating'] !!}</td>
								<td>{!! $review->content !!}</td>
								<td>{!! $review->thing['title'] !!}</td>
								<td>{!! $review->flags->count() !!}</td>
								<td>{!! $review->votes->count() !!}</td>
								<td>{!! $review->user['name'] !!}</td>
								<td>
									<!-- View Review -->
									<a href="{{ action('ReviewController@show', $review->id) }}"> View </a>|
									<!-- Edit Review -->
									<a href="{{ action('ReviewController@edit', $review->id) }}"> Edit </a>|
									<!-- Delete Review -->
									{!! Form::open(['method'=>'delete','action'=>['ReviewController@destroy',$review->id]]) !!}
									<button type="submit">Delete</button>                      
									{!! Form::close() !!}	
									<!-- Flag Review -->								
									{!! Form::open(['method'=>'store','action'=>['FlagController@store']]) !!}
									<input type="hidden" name="review_id" value="{{ $review->id }}">
									<input type="hidden" name="type" value="other">
									<button type="submit">Flag</button>                      
									{!! Form::close() !!}									
									<!-- Vote for Review -->								
									{!! Form::open(['method'=>'store','action'=>['VoteController@store']]) !!}
									<input type="hidden" name="review_id" value="{{ $review->id }}">
									<button type="submit">Vote</button>                      
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
