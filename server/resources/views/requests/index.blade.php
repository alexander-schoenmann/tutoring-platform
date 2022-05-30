<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<ul>
    <h1>Requests</h1>
    @foreach($requests as $request)
        <li>
            <p>{{$request->id}}, {{$request->description}}</p>
        </li>
    @endforeach
</ul>
</body>
</html>
