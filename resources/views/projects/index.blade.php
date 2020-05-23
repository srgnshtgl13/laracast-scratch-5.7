@extends("layout.layout")
@section("title")
Projects
@endsection
@section("content")

<p>Projects</p>
@if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show mt-2 mb-2 col-8 col-md-8" role="alert">
      <strong>{{ Session::get('message') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif
<index-component />


@endsection

<script>
	var ps = @json($projects);
</script>
