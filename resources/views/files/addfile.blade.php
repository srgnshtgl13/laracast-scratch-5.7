@extends("layout.layout")
@section("title")
Add File
@endsection
@section("content")
<form action="{{route('addfilepost')}}" method="post" enctype="multipart/form-data">
	@csrf
	<input type="file" name="file">
	<button type="submit">Submit</button>
	
</form>
@endsection