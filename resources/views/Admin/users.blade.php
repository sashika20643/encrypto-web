@extends('layouts.layout')

@section('content')

<div class="containter ">
<div class="d-flex flex-row-reverse">
<a href="{{route('addUsers')}}" class="btn btn-primary"> Add New User</a>
</div>
<div class="d-flex flex-wrap"  style="background-color: #f4f5f7;min-height:80vh">
@foreach ($users as $user)
<section class="" style="background-color: #f4f5f7;">
    <div class="container py-1">
      <div class="row d-flex justify-content-center align-items-center ">
        <div class="col col-lg-10 mb-1 ">
          <div class="card mb-1" style="border-radius: .5rem;">
            <div class="row">
              <div class="col-md-4 gradient-custom text-center text-white ps-3"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; p-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                  alt="Avatar" class="img-fluid my-5" style="width: 80px;" />

                <i class="far fa-edit mb-1"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h6>{{$user->name}}</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div >


                    </div>
                  </div>
                  <div class="d-flex justify-content-start">

                    <!-- <a href="/admin/profile/view/{{{$user->id}}}" type="button" class="btn btn-primary mr-2">&nbsp;View&nbsp;&nbsp;</a> -->

                  </div>
                  <a  onclick="return confirm('Are you sure?')" href="/admin/dash/controller/user/delete/{{{$user->id}}}" type="button " class="btn btn-danger">Delete</a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endforeach
</div>
</div>

@endsection
