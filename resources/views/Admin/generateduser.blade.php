@extends('layouts.layout')

@section('content')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span style="color: white">User Generated successfully</span>

     </div>
<div class="containter p-5">
    <div class="card mb-4">

        <div class="card-body text-center">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
          <h5 class="my-3">{{ $name }}</h5>
          <p class="text-muted mb-1">Email :{{ $email }}</p>
          <p class="text-muted mb-4">Password : xxxxxxxxxx </p>
          <div class="d-flex justify-content-center mb-2">
            <a href="{{Route('users')}}" type="button" class="btn btn-outline-primary ms-1">Back</a>




          </div>
</div>

</div>

@endsection
