@extends('layouts.layout')

@section('content')
<div class="d-flex  justify-reverse">


    <button class="btn btn-primary  popup-btn"> Add New Acess</button>
    </div>


<h3></h3>
<div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-5">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
            <th class="text-secondary "></th>
            <th class="text-secondary "></th>
            <th class="text-secondary "></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user )
            <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="{{asset('/assets/img/team-4.jpg')}}" class="avatar avatar-sm me-3" alt="user1">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{$user->user_id}}</h6>
                      <p class="text-xs text-secondary mb-0">{{$user->id}}</p>
                    </div>
                  </div>
                </td>



                <td class="align-middle">
                    <a href="/dash/controller/access/remove/{{$user->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Delete
                    </a>
                  </td>
              </tr>
            @endforeach



        </tbody>
      </table>
    </div>
  </div>
  <div class="popup-wrap pw" id="popup">
    <div class="popup-box pb">
        <h3 class="mb-3">Add User</h3>
        <form class="form-inline" action = "{{Route('addAccess')}}" method = "POST">
            @csrf
            <input class="form-control mr-sm-2 mb-3 " type="search" name="file_id" value="{{$file->id}}" name="email" placeholder="Enter Email" aria-label="Search" style="display: none">
            <input class="form-control mr-sm-2 mb-3 " type="search" name="email" placeholder="Enter Email" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add</button>
          </form> 
      <a class="close-btn popup-close pcu" href="#">x</a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="{{asset('Js/fadein.js')}}"></script>

@endsection
