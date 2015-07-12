@extends('admin.admin')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<!-- Create Review -->
			{!! Form::open(['method'=>'get','action'=>['ReviewController@create']]) !!}
			 <button type="submit">New Review</button>                      
			{!! Form::close() !!}
			<br>
		</div>

		<div class="col-md-10">

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
								<th>Comments</th>
								<th>Owner</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $reviews as $review )
							<tr>
								<td>{!! $review->title !!} {!! $review->deleted_at !!}</td>
								<td>{!! $review->rating['rating'] !!}</td>
								<td>{!! $review->content !!}</td>
								<td>{!! $review->thing['title'] !!}</td>
								<td>{!! $review->flags_count !!}</td>
								<td>{!! $review->votes_count !!}</td>
								<td>{!! $review->comments()->count() !!}</td>
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
									{!! Form::open(['method'=>'store','action'=>['Admin\FlagController@store']]) !!}
									<input type="hidden" name="review_id" value="{{ $review->id }}">
									<input type="hidden" name="type" value="other">
									<button type="submit">Flag</button>                      
									{!! Form::close() !!}									
									<!-- Vote for Review -->								
									{!! Form::open(['method'=>'store','action'=>['Admin\VoteController@store']]) !!}
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
		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Sort Reviews
				</div>
				<div class="panel-body">
					{!! Form::open(array('method' => 'GET','action' => 'Admin\ReviewController@index')) !!}
					
					    <div class="form-group">
					        {!! Form::label('sort_by', 'Sort By') !!}
					        {!! Form::select('sort_by',array(''=>'Select Value','created_at'=>'Created At','updated_at'=>'Updated Date','deleted_at'=>'Deleted Date','votes_count'=>'Vote Count','flags_count'=>'Flag Count','deleted_at'=>'Deleted Date'), Input::get('sort_by'), array('class' => 'form-control')) !!}
					    </div>
					
					    <div class="form-group">
					        {!! Form::label('sort_order', 'Sort Order') !!}
					        {!! Form::select('sort_order',array(''=>'Select Order','ASC'=>'Ascending','DESC'=>'Descending'), Input::get('sort_order'), array('class' => 'form-control')) !!}
					    </div>
					
					    <div class="form-group">
					        {!! Form::label('with_trashed', 'Show Trashed') !!}
					        {!! Form::checkbox('with_trashed', 'true', Input::get('with_trashed')) !!}
					    </div>
					
					    {!! Form::submit('Sort Reviews', array('class' => 'btn btn-primary')) !!}
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
