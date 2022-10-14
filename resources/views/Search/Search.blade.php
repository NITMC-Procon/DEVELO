<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>検索ページ</title>
</head>
<body>
    検索フォームです。探したいプロジェクとのワードを入力してください<br>

    <form action="/search" method="GET">
        @csrf
        <input type="search" name="search" placeholder="検索ワードを入力してください" value="@if (isset($search)){{$search}} @endif">
        <button type="submit">検索</button>  
    </form>
    
    <br><br>

    
</body>
</html>