<template>
    <div class="container">
            <div v-if="successMessage" class="alert alert-success alert-dismissible fade show mt-2 mb-2 col-6 col-md-6 offset-3" role="alert">
              <p><strong>{{ successMessage }}</strong> Created!</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        <!-- Button trigger modal -->
        <button v-if="$userinfo.name()" type="button" class="btn btn-success" title="Add a project" data-toggle="modal" @click.prevent="openModal"><i class="fa fa-plus"></i></button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form @keydown="form.errors.clear($event.target.name)">
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" name="title" id="title" v-model="form.title" class="form-control" required>
                        <small class="text-danger" v-if="form.errors.has('title')">{{form.errors.get('title')}}</small>

                      </div>
                      <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" v-model="form.description" required></textarea>
                        <small class="text-danger" v-if="form.errors.has('description')">{{form.errors.get('description')}}</small>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="create-button" :disabled="form.errors.any()" @click.prevent="sendSave()">Save changes</button>
                  </div>
                </form>
            </div>
          </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-6 mb-1" v-for="project in projects.data">
                <div class="card">
                  <div class="card-body" id="card-body">
                    <h5 class="card-title" :key="project.id">{{project.title}}</h5>
                    <a class="btn btn-primary" :href="`/projects/${project.id}`" title="Details"> <i class="fa fa-book"></i> </a>
                    <a v-if="$role.isSuperUser()" class="btn btn-primary" :href="`/projects/${project.id}/edit`" title="Edit"> <i class="fa fa-edit"></i> </a>
                  </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {

                projects: {},
                form: new Form({
                    title: "",
                    description: ""
                }),
                successMessage: "",
            }


        },
        methods:{
            fetchAll(){
                axios.get('/projectsall')
                .then(response => {
                    this.projects = response
                })

            },
            sendSave(){
                // axios.post('/projects',this.$data.form)
                //     .then(this.onSuccess)
                //     .catch(error=>this.form.errors.record(error.response.data.errors))
                this.form.post('/projects')
                    .then(response=>{
                        this.onSuccess(response)
                    })
                    .catch(error=>{console.log(error)})
            },
            onSuccess(response){
                $('#exampleModal').modal('hide')
                this.$emit("AfterInsert")
                this.successMessage = response.message
            },
            openModal(){
                $('#exampleModal').modal('show')
                this.form.errors.clear()
                
                
            },

        },
        mounted() {
            this.fetchAll()
        },
        created(){
            // Custom Event
            this.$on("AfterInsert", ()=>{
                this.fetchAll()
            })
            
            //console.log(this.$userinfo.name())
            //console.log(this.$role.isUser())
            //console.log(navigator) // get the browser name,version, ... etc

        }
    }
</script>
