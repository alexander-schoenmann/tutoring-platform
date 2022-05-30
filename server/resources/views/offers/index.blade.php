<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<ul>
    <h1>Offers</h1>
    @foreach($offers as $offer)
        <li>
            <a href="offers/{{$offer->id}}">
                {{$offer->title}}
                {{$offer->description}}
            </a>
        </li>
    @endforeach
</ul>
</body>
</html>
