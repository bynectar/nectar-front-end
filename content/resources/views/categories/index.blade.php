@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

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
									<!-- Open Category -->
									{!! Form::open(['method'=>'get','action'=>['CategoryController@show',$category->id]]) !!}
									 <button type="submit">View</button>                      
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
