<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>



    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span style="color: white">SignUp Deatils</span>

         </div>
    <div class="containter p-5">
        <div class="card mb-4">

            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{ $name }}</h5>
              <p class="text-muted mb-1">Email :{{ $email }}</p>
              <p class="text-muted mb-4">Password :{{ $password }} </p>

    </div>

    </div>


</body>
</html>
