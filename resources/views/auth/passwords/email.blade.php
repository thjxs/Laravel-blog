@extends('default')
@section('title', 'Password Reset')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Password Reset</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					<form class="form-horizontal" method="post" action="{{ route('password.email') }}">
						{{ csrf_field() }}
						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">Email: </label>
							<div class="col-md-6">
								<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Send password reset email
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection