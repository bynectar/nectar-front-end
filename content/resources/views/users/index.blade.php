@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">List Users</div>

				<div class="panel-body">
					
					<!-- Users Table -->
					<table class="table">
						<thead>
							<tr>
								<?php
									echo '<th></th>';
									echo '<th>ID</th>';
									echo '<th>Name</th>';
									echo '<th>Email</th>';
									echo '<th>Created</th>';
									echo '<th>Updated</th>';
									echo '<th>Reviews</th>';
								?>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ( $users as $user ) {
								echo '<tr>';
								$user_link = action('UserController@edit', array('id' => $user['id']));
								echo '<td><a href="'.$user_link.'">Edit</a></td>';	
								//echo '<td><a href="">Edit</a></td>';	
								echo '<td>'.$user['id'].'</td>';	
								echo '<td>'.$user['name'].'</td>';	
								echo '<td>'.$user['email'].'</td>';	
								echo '<td>'.$user['created_at'].'</td>';	
								echo '<td>'.$user['updated_at'].'</td>';	
								echo '<td>'.count($user['reviews']).'</td>';	
								echo '</tr>';
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
