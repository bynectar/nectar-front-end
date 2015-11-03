@extends('app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<!-- Create Review -->
			{!! Form::open(['method'=>'get','action'=>['ImageController@create']]) !!}
			 <button type="submit">New Image</button>                      
			{!! Form::close() !!}
			<br>
		</div>

		<div class="col-md-10">

			<div class="panel panel-default">

				<div class="panel-heading">List Images</div>

				<div class="panel-body">
					
					<!-- Users Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Image Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $images as $image )
							<tr>
								<td>{!! $image->name !!}</td>
								<td>
									<!-- View Flower -->
									<a href="{{ action('ImageController@show', $image->id) }}"> View </a>|
									<!-- Edit Flower -->
									<a href="{{ action('ImageController@edit', $image->id) }}"> Edit </a>|
									<!-- Delete Flower -->
									{!! Form::open(['method'=>'delete','action'=>['ImageController@destroy',$image->id]]) !!}
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
		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Sort Images
				</div>
				<div class="panel-body">
					{!! Form::open(array('method' => 'GET','action' => 'ImageController@index')) !!}
					
					    <div class="form-group">
					        {!! Form::label('sort_by', 'Sort By') !!}
					        {!! Form::select('sort_by',array(''=>'Select Value','name'=>'Name','created_at'=>'Created At','updated_at'=>'Updated Date'), Input::get('sort_by'), array('class' => 'form-control')) !!}
					    </div>
					
					    <div class="form-group">
					        {!! Form::label('sort_order', 'Sort Order') !!}
					        {!! Form::select('sort_order',array(''=>'Select Order','ASC'=>'Ascending','DESC'=>'Descending'), Input::get('sort_order'), array('class' => 'form-control')) !!}
					    </div>
					
					    {!! Form::submit('Sort Images', array('class' => 'btn btn-primary')) !!}
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
