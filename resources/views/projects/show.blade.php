@extends("layout.layout")
@section("title")
{{$project->title}}
@endsection
@section("content")
	@if(Session::has('message'))
		<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show mt-2 mb-2 col-8 col-md-8" role="alert">
		  <strong>{{ Session::get('message') }}</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	@endif

	
	<show-component :project='@json($project)' :tasks='@json($project->tasks)'></show-component>

@endsection

<script>
	// also we can use this instead of send the data as props
	var abc = @json($project)
</script>