@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $user['name']; ?></div>
				
					<!-- if there are creation errors, they will show here -->
					{{ HTML::ul($errors->all()) }}
					
					{{ Form::open(array('url' => 'users')) }}
					
					    <div class="form-group">
					        {{ Form::label('name', 'Name') }}
					        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
					    </div>
					
					    <div class="form-group">
					        {{ Form::label('email', 'Email') }}
					        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
					    </div>
					

						<div class="form-group">
					        {{ Form::label('password', 'Password') }}
					        {{ Form::password('password', Input::old('password'), array('class' => 'form-control')) }}
						</div>

						<div class="form-group">
					        {{ Form::label('password_confirmation', 'Password Confirmation') }}
					        {{ Form::password('password_confirmation', Input::old('password_confirmation'), array('class' => 'form-control') }}
						</div>


					    {{ Form::submit('Create User', array('class' => 'btn btn-primary')) }}
					
					{{ Form::close() }}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
