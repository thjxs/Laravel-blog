<form action="{{ route('statuses.store') }}" method="post">
	@include('shared._errors')
	{{ csrf_field() }}
	<textarea class="form-control" rows="3" placeholder="Say Something" name="content">
		{{ old('content') }}
	</textarea>
	<button type="submit" class="btn btn-primary pull-right">Submit</button>
</form>