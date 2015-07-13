@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<!-- Create Category Request -->
			{!! Form::open(['method'=>'get','action'=>['CategoryController@create']]) !!}
			 <button type="submit">Request New Category</button>                      
			{!! Form::close() !!}
			<br>

			<div class="panel panel-default">

				<div class="panel-heading">List Categories</div>

				<div class="panel-body">
					
					<!-- Category Table -->
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Creator</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $categories as $category )
							<tr>
								<td>{!! $category->title !!}</td>
								<td>{!! $category->description !!}</td>
								<td>{!! $category->user['name'] !!}</td>
								<td>
									<!-- Edit Category -->
									{!! Form::open(['method'=>'get','action'=>['CategoryController@edit',$category->id]]) !!}
									 <button type="submit">Edit</button>                      
									{!! Form::close() !!}									
									<!-- Delete Category -->
									{!! Form::open(['method'=>'delete','action'=>['CategoryController@destroy',$category->id]]) !!}
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
