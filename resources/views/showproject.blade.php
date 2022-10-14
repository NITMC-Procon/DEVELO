<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    あなたの最新の投稿<br>
    {{$mine['title']}}
    <br>
    {{$mine['about']}}    
    
    <br><br><br><br>

    最近追加されたプロジェクト（最新のもの5件を表示しています）<br>
    @foreach ($many as $m)
        @foreach ($newproject[$m] as $project)
            {{$project['title']}}
        <br><br>
        @endforeach
    @endforeach
</body>
</html>