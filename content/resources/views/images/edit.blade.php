@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-body">

						<!-- if there are creation errors, they will show here -->
						{!! HTML::ul($errors->all()) !!}
						
						{!! Form::model($flower, array('route' => array('flowers.update', $flower['id']), 'method' => 'PUT', 'files'=>true)) !!}
						
						    <div class="form-group">
						        {!! Form::label('common_name_1', 'Common Name 1') !!}
						        {!! Form::text('common_name_1', Input::old('common_name_1'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('common_name_2', 'Common Name 2') !!}
						        {!! Form::text('common_name_2', Input::old('common_name_2'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('common_name_3', 'Common Name 3') !!}
						        {!! Form::text('common_name_3', Input::old('common_name_3'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('latin_name', 'Latin Name') !!}
						        {!! Form::text('latin_name', Input::old('latin_name'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('description', 'Description') !!}
						        {!! Form::textarea('description', Input::old('description'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('branches', 'Branches') !!}
						        {!! Form::checkbox('branches', Input::old('branches'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('berries', 'Berries') !!}
						        {!! Form::checkbox('berries', Input::old('berries'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('foliage', 'Foliage') !!}
						        {!! Form::checkbox('foliage', Input::old('foliage'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('spring', 'Spring') !!}
						        {!! Form::checkbox('spring', Input::old('spring'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('summer', 'Summer') !!}
						        {!! Form::checkbox('summer', Input::old('summer'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('fall', 'Fall') !!}
						        {!! Form::checkbox('fall', Input::old('fall'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('winter', 'Winter') !!}
						        {!! Form::checkbox('winter', Input::old('winter'), array('class' => 'form-control')) !!}
						    </div>
						    
						    <hr>
						    
						    <div class="form-group">
						        {!! Form::label('image_title', 'Image Title') !!}
						        {!! Form::text('image_title', Input::old('image_title'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('image_desc', 'Image Description') !!}
						        {!! Form::textarea('image_desc', Input::old('image_desc'), array('class' => 'form-control')) !!}
						    </div>
						
						    <div class="form-group">
						        {!! Form::label('image_file', 'Picture') !!} - {{$flower['image']}}
						        {!! Form::file('image_file') !!}
						    </div>
						
						    {!! Form::submit('Update Flower', array('class' => 'btn btn-primary')) !!}
						
						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
