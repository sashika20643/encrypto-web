
@extends('layouts.layout')

@section('content')
<div class="container py-5">

    <div class="row d-flex justify-content-center ">
    <div class="col-lg-4 mr-3">
        <h2>Change Password</h2>
        <form action="{{route('changepwcontroller')}}" method="POST">
            @csrf
      <div class="mb-3">
        <label for="" class="form-label">Current Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="current password">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">New Password</label>
        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="newpassword" placeholder="New Password">
        @error('new_password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="confirmpassword" placeholder="Confirm New Password">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>
<button type="submit"  class="btn btn-primary" >Change Password</button>
        </form>
    </div>
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{asset('assets/img/team-2.jpg')}}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ Auth::user()->name }}</h5>

            <p class="text-muted mb-1">{{ Auth::user()->email }}</p>

            <div class="d-flex justify-content-center mb-2">

              {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form> --}}

  <button onclick="event.preventDefault();document.getElementById('logout-form').submit();" type="button" class="btn btn-outline-primary ms-1">Logout</button>


            </div>
          </div>
        </div>
      </div>



    @endsection
