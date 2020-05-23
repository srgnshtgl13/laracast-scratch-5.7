@extends("layout.layout")
@section("title")
Add Ip
@endsection
@section("content")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('addip.submit')}}" method="post">
	@csrf
	<input type="text" class="form-input ip_address" id="ipv4" name="ipv4" placeholder="xxx.xxx.xxx.xxx" data-mask="9999.9999.9999.9999"/>
	<button type="submit">Submit</button>
	
</form>
@endsection

@section('js')
	<script>
		// var ipv4_address = $('#ipv4');
		
	</script>
@endsection