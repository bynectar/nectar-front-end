@extends('app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<!-- Create Review -->
			{!! Form::open(['method'=>'get','action'=>['FlowerController@create']]) !!}
			 <button type="submit">New Flower</button>                      
			{!! Form::close() !!}
			<br>
		</div>

		<div class="col-md-10">

			<div class="panel panel-default">

				<div class="panel-heading">List Flowers</div>

				<div class="panel-body">
					
					<!-- Users Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Common Name 1</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $flowers as $flower )
							<tr>
								<td>{!! $flower->common_name_1 !!}</td>
								<td>
									<!-- View Flower -->
									<a href="{{ action('FlowerController@show', $flower->id) }}"> View </a>|
									<!-- Edit Flower -->
									<a href="{{ action('FlowerController@edit', $flower->id) }}"> Edit </a>|
									<!-- Delete Flower -->
									{!! Form::open(['method'=>'delete','action'=>['FlowerController@destroy',$flower->id]]) !!}
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
					Sort flowers
				</div>
				<div class="panel-body">
					{!! Form::open(array('method' => 'GET','action' => 'FlowerController@index')) !!}
					
					    <div class="form-group">
					        {!! Form::label('sort_by', 'Sort By') !!}
					        {!! Form::select('sort_by',array(''=>'Select Value','common_name_1'=>'Name','created_at'=>'Created At','updated_at'=>'Updated Date'), Input::get('sort_by'), array('class' => 'form-control')) !!}
					    </div>
					
					    <div class="form-group">
					        {!! Form::label('sort_order', 'Sort Order') !!}
					        {!! Form::select('sort_order',array(''=>'Select Order','ASC'=>'Ascending','DESC'=>'Descending'), Input::get('sort_order'), array('class' => 'form-control')) !!}
					    </div>
					
					    {!! Form::submit('Sort Flowers', array('class' => 'btn btn-primary')) !!}
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
