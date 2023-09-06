<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email from {{config('app.name')}} contact page</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,400;0,600;0,700;1,300;1,400;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    <div style="width:768px; margin:0 auto; text-align:center; font-family: 'Roboto Slab', serif; border:1px solid #000000; background-color:#fffffd; padding:20px; border-radius:10px;">
        <h1 style="font-size:30px;">{{config('app.name')}}</h1>
        
        <h2>Message details</h2>
        
        <strong>Name:</strong>
        <br>
        {{$data->name}}
        <br>
        <br>
        <strong>Email:</strong>
        <br>
        {{$data->email}}
        <br>
        <br>
        <strong>Phone:</strong>
        <br>
        {{$data->phone}}
        <br>
        <br>
        <strong>Subject:</strong>
        <br>
        {{$data->subject}}
        <br>
        <br>
        <strong>Message:</strong>
        <br>
        <div style="margin:0 40px;">{{$data->message}}</div>
        <br>
        
        <strong style="text-decoration: underline;">Thank you</strong>
    </div>
</body>
</html>



