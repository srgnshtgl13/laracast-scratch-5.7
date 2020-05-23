@extends("layout.layout")
@section("title")
{{$project->title}} | Edit
@endsection
@section("content")
	<h5>Edit the <strong>{{$project->title}}</strong></h5>

	<div class="modal-body">
		<form method="POST" action="/projects/{{$project->id}}">
			@method('PATCH')
		    	@csrf
		      <div class="form-group">
		        <label for="recipient-name" class="col-form-label">Title:</label>
		        <input type="text" name="title" id="title" class="form-control" value="{{$project->title}}">

		      </div>
		      <div class="form-group">
		        <label for="message-text" class="col-form-label">Description:</label>
		        <textarea class="form-control" id="desc" name="description">{{$project->description}}</textarea>
		      </div>
		  <div class="modal-footer float-left">
		    <button type="submit" class="btn btn-primary" id="update">Update</button>
		    <!-- Button trigger modal -->
		    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
			  Delete
			</button>

		  </div>
		</form>  
	</div>
	<!-- Delete Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Delete!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	Are you sure you wanna delete <strong>{{$project->title}}</strong> project?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <form method="post" action="/projects/{{$project->id}}">
	        	@method('DELETE')
		    	@csrf
		    	<button type="submit" class="btn btn-danger" id="delete">Delete</button>
		    </form>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- /Delete Modal -->  
@endsection
