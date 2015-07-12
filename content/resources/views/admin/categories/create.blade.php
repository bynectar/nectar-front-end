@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">New Category</div>
				
				<div class="panel-body">
					
					<!-- if there are creation errors, they will show here -->
					{!! HTML::ul($errors->all()) !!}
					
					{!! Form::open(array('url' => 'admin/categories')) !!}
					
					    <div class="form-group">
					        {!! Form::label('title', 'Title') !!}
					        {!! Form::text('title', Input::old('title'), array('class' => 'form-control')) !!}
					    </div>
					
					    <div class="form-group">
					        {!! Form::label('description', 'Description') !!}
					        {!! Form::textarea('description', Input::old('description'), array('class' => 'form-control')) !!}
					    </div>
					
					    {!! Form::submit('Create Category', array('class' => 'btn btn-primary')) !!}
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
