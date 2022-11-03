<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div class="container" style="display: flex;justify-content:center;align-items:center;flex-direction:column">

<h2 style="color: rgb(228, 66, 66)">Your file has been accessed
...!</h2>
<p>Your file was accessed and downloaded; </p>
<ul>
    <li><span style="color:blue"> Time</span>: {{$time}}</li>
    <li><span style="color:blue"> User</span>: {{$demail}}</li>
    <li><span style="color:blue">File</span>: {{$file}} </li>
</ul>


    </div>
    <address style="color: rgb(67, 67, 224);float: right;">
        Best Regards,<br>
Team Encrypto.
    </address>

</body>
</html>
