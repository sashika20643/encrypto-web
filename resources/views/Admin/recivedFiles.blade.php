@extends('layouts.layout')

@section('content')

<h3>Access Given Files</h3>

<div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Size</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
            <th class="text-secondary opacity-7"></th>
            <th class="text-secondary opacity-7"></th>
          </tr>
        </thead>
        <tbody>
            @if(!$files)
            No files to show
            @endif
            @foreach ($files as $file )
            <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="{{asset('/assets/img/cue.png')}}" class="avatar avatar-sm me-3" alt="user1">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{$file->first_name}}</h6>
                      <p class="text-xs text-secondary mb-0">{{$file->id}}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ (float)($file->size)/1000}}KB</p>
                  <p class="text-xs text-secondary mb-0">{{$file->size}}B</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">{{$file->type}}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{$file->created_at }}</span>
                </td>
                <td class="align-middle">
                  <a href="/dash/controller/file/download/{{$file->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Download
                  </a>
                </td>
                <td class="align-middle">
                    <a href="/dash/controller/file/view/{{$file->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </a>
                  </td>
              </tr>
            @endforeach



        </tbody>
      </table>
    </div>
  </div>


</div>


@endsection
