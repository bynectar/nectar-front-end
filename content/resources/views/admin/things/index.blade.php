@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<!-- Create a New Thing -->
			{!! Form::open(['method'=>'get','action'=>['ThingController@create']]) !!}
			 <button type="submit">Request New Thing</button>                      
			{!! Form::close() !!}
			<br>

			<div class="panel panel-default">

				<div class="panel-heading">List Things</div>

				<div class="panel-body">
					
					<!-- Category Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Category</th>
								<th>Creator</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $things as $thing )
							<tr>
								<td>{!! $thing->title !!}</td>
								<td>{!! $thing->description !!}</td>
								<td>{!! $thing->category['title'] !!}</td>
								<td>{!! $thing->user['name'] !!}</td>
								<td>
									<!-- View This -->
									<a href="{{ action('ThingController@show', $thing->id) }}"> View </a>|
									<!-- Review This -->
									<a href="{{ action('ReviewController@create', array('thing_id' => $thing->id)) }}"> Review </a>|
									<!-- Edit Thing -->
									<a href="{{ action('ThingController@edit', $thing->id) }}"> Edit </a>
									<!-- Delete Thing -->
									{!! Form::open(['method'=>'delete','action'=>['ThingController@destroy',$thing->id]]) !!}
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
