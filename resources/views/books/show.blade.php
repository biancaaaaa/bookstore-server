<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KWM</title>
</head>
<body>
<h1>{{$book->title}}</h1>
<p><b>Description: </b>{{$book->description}}</p>
<p><b>ISBN:</b> {{$book->isbn}}</p>
</body>
</html>
