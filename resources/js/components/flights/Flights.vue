<template>
	<div class="container">
		<div class="row">
			<div class="col-8">
				<select id="selectHowMuch" @change="selectHowMuch">
			    	<option value="10">10</option>
			    	<option value="20">20</option>
			    	<option value="30">30</option>
			    	<option value="2000">2000</option>
			    </select>
				<pagination :data="response" v-on:go-page="goToPage"></pagination>

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
	    </table>
	</div>
</template>
<script>
	import Pagination from '../datatable/Pagination';
	export default{
		components: {pagination: Pagination},
		data() {
			return{
				flights: [],
				response: {},
			}
		},
		methods: {
			fetchFlights(url = "/getFlightsData"){
				axios.get(url).then(res =>{
					// this.flights = res.data.data;
					console.log(res.data);
					this.response = res.data;
					this.dtblInit(res.data.data);
				});
			},
			dtblInit(data){
				let table = $('#table_id').DataTable({
			    	data: data,
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
				        'copy',
				        {
				        	text: 'Create',
				            action: function ( e, dt, node, config ) {
				                window.location.href = "/flights/create";
				            }
				        },
				    ],
				    paging: false,
				    destroy: true,
					searching: false,
					"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			            $(nRow).attr("href", "/flights/" + aData.id + "/");
			            $(nRow).css( 'cursor', 'pointer' );
			            $(nRow).click(function(){
			                window.location = $(this).attr('href');
			                return false;
			            });
			        },
				});
			},
			goToPage(pageUrl){
				this.fetchFlights(pageUrl);
			},
			selectHowMuch(e){
				let val = parseInt(e.target.value);
				this.fetchFlights(`/getFlightsData/${val}`);

			}
		},
		created(){

		},
		mounted(){
			this.fetchFlights();

		}
	}
</script>