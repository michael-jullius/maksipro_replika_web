@extends('layout')

@section('title', 'User')

@section('content')
<div class="container">
	<div class="card">
		<div class="text-center h1 text-dark mt-2 " style="font-weight: bold;">user</div>
		<div class="border m-4">
			<div class="d-flex">
				<div class="text-center h3 mt-4" style="text-align: left; width: 50%;">nama: </div>
				<div class="text-center h3 mt-4" >{{Auth::user()->name}}</div>
			</div>
			<div class="d-flex">
				<div class="text-center h3 mt-5 mb-5" style="text-align: left; width: 50%;">username: </div>
				<div class="text-center h3 mt-5 mb-5" >{{Auth::user()->username}}</div>
			</div>
			<div class="d-flex">
				<div class="text-center h3 mb-5" style="text-align: left; width: 50%;">password: </div>
				<button type="button" class="btn btn-primary mb-5"  data-toggle="modal" data-target="#exampleModalCenter">
				  Ubah Password
				</button>
			</div>
		</div>
	</div>		
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	 <div class="modal-dialog modal-dialog-centered" role="document">
	 	<form method="post" action="{{route('changePassword')}}">
	 		@csrf
		    <div class="modal-content">
		      	<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			         	 <span aria-hidden="true">&times;</span>
			        </button>
		      	</div>
		      	<div class="modal-body">
		      		<p>password baru:</p>
		      		<input type="password" name="password">
		      		<p>retype password:</p>
		      		<input type="password" name="retypepassword">
		      	</div>
		      	<div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
		      	</div>
		    </div>
		 </form>
	 </div>
</div>
@endsection