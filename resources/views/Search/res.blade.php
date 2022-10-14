<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($many as $m)
    @foreach($Projects[$m] as $value)
        <div>
            {{$value['title']}}
            <br>
        </div>
    @endforeach
    @endforeach

    <br><br><br><br><br>
    <a href="/">トップページに戻る</a>
    </body>
</html>