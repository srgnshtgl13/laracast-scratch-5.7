<template>
	<div class="card col-8 col-md-8">
	  <div class="card-body">
	    <h4 class="card-subtitle mb-2 text-muted">{{proj.title}}</h4>
	    <p class="card-text ml-5">{{proj.description}}</p>
	    <div>
	    	<hr>
	    	<h5>Add a new Task</h5>
    		<form @keydown="form.errors.clear($event.target.name)" @submit.prevent="addATask()">
              
                  <div class="form-group">
                    <label for="description" class="col-form-label">TaskDesc:</label>
                    <input type="text" name="description" v-model="form.description" class="form-control" required>
                    <small class="text-danger" v-if="form.errors.has('description')">{{form.errors.get('description')}}</small>

                  </div>
              
              
                <button type="submit" class="btn btn-primary" id="create-button" :disabled="form.errors.any()">Add A Task</button>
              
            </form>
	    </div>

	    <div v-if="projectTasks">
	    	<hr>
		    <h5>Project Tasks</h5>
		    
		    	
		    	<div class="ml-3" v-for="task in projectTasks">
		    		<!-- PATCH action="/tasks/{{task.id}}"-->
		    			
		    				<input type="checkbox" id="completed" name="completed" title="Mark as completed!" v-model="task.completed"
		    				@change.prevent="task.completed ? completeRequest(task) : InCompleteRequest(task)">
		    			<label for="completed" v-bind:class="{active : isActive, 'isCompleted': task.completed, 'text-success': task.completed}">
		    				{{task.description}}
		    			</label>
		    			
		    		
		    	</div>
		</div>
	  </div>
	  <div class="card-footer text-muted">
	  	{{proj.created_at}}
	  </div>
	</div>

</template>

<script>
	export default {
		props: ['project', 'tasks'],
		data(){
			return{
				  isActive: true,
				  form: new Form({
				  	description:'',
				  	
				  }),
				  projectTasks: this.tasks,
				  proj: this.project,
			}

		},
		methods:{
			completeRequest(task){	//send a request to complete the task
				
				axios.post(`/completed-task/${task.id}`,task)
					.then(response=>{
						console.log(response.data)
						this.isActive = !this.isActive
					})
					.catch(error=>{
						console.log(error.data)

					})
				
			},
			InCompleteRequest(task){	// send a request to incomplete the task
				axios.delete(`/completed-task/${task.id}`,task)
					.then(response=>{
						console.log(response.data)
						this.isActive = !this.isActive
					})
					.catch(error=>{
						console.log(error.data)

					})

			},
			addATask(){
				this.form.post(`/tasks/${this.proj.id}`)
				.then(response=>{
					this.$emit("fire-task");
					//console.log("Project",response)
				})
				.catch(err=>{
					console.log(err)
				})
			},
			getTasks(){
				var id = this.proj.id
				axios.get(`/tasks/${id}`)
					.then(response=>{
						//console.log(response)
						this.projectTasks = response.data
					})
					.catch(err=>{
						console.log(err)
					})
			}

		},
		mounted(){
			this.getTasks()
		},
		created(){
			
			this.$on("fire-task",() => {
				this.getTasks();
			})
			
		}
		

	}
	
</script>
<style type="text/css" media="screen">
.isCompleted{
	text-decoration: line-through;
}
.isNotCompleted{
	text-decoration: none;
}
	
</style>