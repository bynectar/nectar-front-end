@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $user['name']; ?></div>
					<div class="panel-body">

						<!-- if there are creation errors, they will show here -->
						{!! HTML::ul($errors->all()) !!}
						
						{!! Form::model($user, array('route' => array('users.update', $user['id']), 'method' => 'PUT')) !!}
						
						    <div class="form-group">
						        {!! Form::label('name', 'Name') !!}
						        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('email', 'Email') !!}
						        {!! Form::email('email', Input::old('email'), array('class' => 'form-control')) !!}
						    </div>
						
						    {!! Form::submit('Update User', array('class' => 'btn btn-primary')) !!}
						
						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
