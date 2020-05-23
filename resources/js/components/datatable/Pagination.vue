<template>
    <nav aria-label="Page navigation example">
	  <ul class="pagination">
	    <li class="page-item" :class="{'disabled': data.current_page === 1}"><a class="page-link" href="#" @click="goPage(data.first_page_url)">FirstPage</a></li>
	    <li class="page-item" :class="{'disabled': !data.prev_page_url}"><a class="page-link" href="#" id="previous" @click="goPage(data.prev_page_url)">Previous</a></li>

	    <li class="page-item" :class="{'disabled': !(data.current_page > 3)}"><a class="page-link" href="#" @click="goPage(`${data.path}?page=${data.current_page-3}`)">{{!(data.current_page > 3) ? '...' : data.current_page-3}}</a></li>
	    <li class="page-item" :class="{'disabled': !(data.current_page > 2)}"><a class="page-link" href="#"@click="goPage(`${data.path}?page=${data.current_page-2}`)">{{!(data.current_page > 2) ? '...' :data.current_page-2}}</a></li>
	    <li class="page-item" :class="{'disabled': !(data.current_page > 1)}"><a class="page-link" href="#" @click="goPage(`${data.path}?page=${data.current_page-1}`)">{{!(data.current_page > 1) ? '...' : data.current_page-1}}</a></li>
	    
	    <li class="page-item"><a class="page-link text-danger" href="#">{{data.current_page}}</a></li>

	    <li class="page-item" :class="{'disabled': (data.total/data.per_page)<(data.current_page+1) }"><a class="page-link" href="#" @click="goPage(`${data.path}?page=${data.current_page+1}`)">{{(data.total/data.per_page)<(data.current_page+1) ? '...': data.current_page+1}}</a></li>
	    <li class="page-item" :class="{'disabled': (data.total/data.per_page)<(data.current_page+2) }"><a class="page-link" href="#" @click="goPage(`${data.path}?page=${data.current_page+2}`)">{{(data.total/data.per_page)<(data.current_page+2) ? '...': data.current_page+2}}</a></li>
	    <li class="page-item" :class="{'disabled': (data.total/data.per_page)<(data.current_page+3) }"><a class="page-link" href="#" @click="goPage(`${data.path}?page=${data.current_page+3}`)">{{(data.total/data.per_page)<(data.current_page+3) ? '...': data.current_page+3}}</a></li>
	    <li class="page-item" :class="{'disabled': !data.next_page_url}"><a class="page-link" href="#" id="next" @click="goPage(data.next_page_url)">Next</a></li>
	    <li class="page-item"><a class="page-link" href="#" @click="goPage(data.last_page_url)">LastPage</a></li>
	  </ul>
	</nav>
</template>
<script>
	export default{
		props: ['data'],
		data(){
			return{
				
			}
		},
		methods:{
			goPage(url){
				this.$emit('go-page',url);
			}
		},
		created(){
			
		}
	}
</script>