<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Flight</title>
	<link rel="stylesheet" href="/css/app.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.css"/>
</head>
<body>
	<div id="app">
		{{-- @foreach ($flights as $chunk)
		    <div class="row">
		        @foreach ($chunk as $flight)
		            <div class="col-xs-4">name: {{ $flight->name }}, slug: {{ $flight->slug }}</div>
		        @endforeach
		    </div>
		@endforeach --}}
		{{-- <div class="row">
			<div class="col-8 float-right">
				<select id="selectHowMuch">
			    	<option value="10">10</option>
			    	<option value="20">20</option>
			    	<option value="30">30</option>
			    </select>
			    <nav aria-label="Page navigation example">
				  <ul class="pagination">
				    <li class="page-item"><a class="page-link" href="#" id="previous">Previous</a></li>
				    <li class="page-item"><a class="page-link" href="#">1</a></li>
				    <li class="page-item"><a class="page-link" href="#">2</a></li>
				    <li class="page-item"><a class="page-link" href="#">3</a></li>
				    <li class="page-item"><a class="page-link" href="#" id="next">Next</a></li>
				  </ul>
				</nav>
			</div>
			
		</div>
		<table id="table_id" class="display nowrap" style="width:100%">
	        <thead>
	            <tr>
	                <th>ID</th>
	                <th>Name</th>
	                <th>Slug</th>
	            </tr>
	        </thead>
	    </table> --}}
	    <flights-component></flights-component>
	    

	</div>

	<script src="/js/app.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.js"></script>


	{{-- <script>
		let pagination = {
			first_page_url: '',
			prev_page_url: '',
			next_page_url: '',
			last_page_url: '',
		};
		getData();

		document.getElementById('selectHowMuch').addEventListener('change', (e)=>{
			// console.log(typeof e.target.value);
			let val = parseInt(e.target.value);
			getData(`/getFlightsData/${val}`);
		})
	    if(!isNaN(pagination.prev_page_url)){
		    $("#previous").on('click', function(){
		    	getData(pagination.prev_page_url);
		    })
	    }
	    if(!isNaN(pagination.next_page_url)){
		    $("#next").on('click', function(){
		    	getData(pagination.next_page_url);
		    })
	    }

		function getData(url = "{{route('getFlightsData')}}"){
			$.ajax({
				type: "GET",
				url: url,
				success: (res) => {
					pagination.first_page_url = res.first_page_url;
					pagination.prev_page_url = res.prev_page_url;
					pagination.next_page_url = res.next_page_url;
					pagination.last_page_url = res.last_page_url;
					$('#table_id').DataTable({
				    	data: res.data,
				    	columns: [
					        { data: 'id' },
					        { data: 'name' },
					        { data: 'slug' },
					    ],
					    dom: 'Bfrtip',
					    buttons: [
					        'colvis',
					        'excel',
					        'print',
					        'copy'
					    ],
					    paging: false,
					    destroy: true,
    					searching: false,
					});
				},
			});
		}
	</script> --}}
</body>
</html>