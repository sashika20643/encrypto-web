@extends('layouts.Admin')

@section('content')


<div class="containter ">
    <div class="d-flex flex-row-reverse">
    <button class="btn btn-primary  popup-btn"> Upload File</button>
    </div>

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
                      <a href="javascript:;" onclick="setval({{$file->id}});" class="popup-down text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Download
                      </a>
                    </td>
                    <td class="align-middle">
                        <a onclick="return confirm('Are you sure?')" href="/dash/controller/file/delete/{{$file->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          delete
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


<div class="popup-wrap pw" id="popup">
    <div class="popup-box pb">
        <div class="container" id="ppcont">
        <p id="success" style="color: green"></p>
      <h4 id="title" class="mb-3"> Select file </h4>
      <br>
      {{-- <form action = "http://127.0.0.1:5000/upload" method = "POST"  enctype = "multipart/form-data"> --}}






          <form action = "{{Route('fileuploadController')}}" method = "POST"  enctype = "multipart/form-data">
            @csrf
            <input class="form-control mb-3" type = "file" id="inputfile" name = "file"  required />

                <span class="me-2 text-xs font-weight-bold" id="ptxt">0%</span>

            <div class="progress">
                <div class="progress-bar bg-gradient-info" role="progressbar" id ="pgress" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
              </div>
            <input class="form-control mb-3" type="password" name="password" id="password"  style="display: none" required>
            <br>
            <button  id="encryptb"  class="btn btn-success" type="submit" value="submit" style="display:none;color:black;: rgb(234, 210, 175)"> Encrypt</button>
{{-- <button type="submit" value="submit"> Upload</button> --}}
</form>
<button id="upload" class="btn btn-success" style="color:black">upload</button>
</div>
<img src="{{asset('assets/img/lottie1.gif')}}" alt="" srcset="" id="gif" style="display:none;max-height: 270px;">
      <a class="close-btn popup-close pcu" href="#">x</a>
    </div>
  </div>



{{-- Download popup --}}

<div class="popup-wrap popup-wrapd" id="popup">
    <div class="popup-box popup-boxd">
        <div class="container" id="ppcont">

            <h3>Enter password to download</h3>
          <form action = "{{Route('fileDownload')}}" method = "POST"  enctype = "multipart/form-data">
            @csrf
            <input class="form-control mb-3" type="password" name="password" id="dpassword"   required>
            <input class="form-control mb-3" type="text" name="id" id="fileid"   style="display: none">
            <br>
            <button  id="download"  class="btn btn-success" type="submit" value="submit" style="color:black;: rgb(234, 210, 175)"> Download</button>
          </form>

</div>
<a class="close-btn popup-close pc" href="#">x</a>
    </div>
  </div>

  <script src="{{asset('Js/fadein.js')}}"></script>



  <script>

function setval(id){
$('#fileid').val(id);
}


    $('#upload').on('click', function() {
    var file_data = $('#inputfile').prop('files')[0];
    var first_name=file_data.name;
    var size=file_data.size;
    var last_name='{{Auth::user()->id}}'+'{{time()}}'+'jpg';
    var password=$('#password').val();
    var type=first_name.split('.').pop();
    var form_data = new FormData();

    form_data.append('file', file_data);

$.ajax({            type: 'POST',
					url: 'http://127.0.0.1:5000/upload', // point to server-side URL
					dataType: 'json', // what to expect back from server
					cache: false,
                    contentType: false,
					processData: false,
                    data: form_data,
                    xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100 +'%';
                $('#pgress').css('width',percentComplete);
                $('#ptxt').html(percentComplete);
                //Do something with upload progress here
                console.log(percentComplete)
            }
       }, false);
       return xhr;
    },


					complete: function (response) { // display success response
						console.log(response);
                        $('#pgress').hide();
                        $('#ptxt').hide();
                        $('#inputfile').hide();
                        $('#upload').hide();
                        $('#password').show();
                        $('#encryptb').show();
                        $('#success').html("uploaded to server Sucessfully...");
                        $('#title').html("Input password to encrypt");

					},

				});







});

$('#encryptb').on('click', function() {
    $('#ppcont').hide();
    $('#gif').show();

});

  </script>
@endsection
