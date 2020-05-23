@extends("layout.layout")
@section("title")
PDF Test
@endsection
@section("content")
<button class="btn btn-primary" onclick="window.location.href='{{route('downloadPdf')}}'">DownloadPdf</button>
<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Show Name</th>
        <th>Series</th>
        <th>Date</th>
    </thead>
    <tbody>
        @foreach($shows as $show)
        <tr>
            <td>{{$show->id}}</td>
            <td>{{$show->name}}</td>
            <td>{{$show->slug}}</td>
            <td>{{$show->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection