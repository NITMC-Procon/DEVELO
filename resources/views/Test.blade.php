<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="/DBtest" method="POST">
        @csrf
        <input type="text" name="title" placeholder="タイトル" required>
        <input type="text" name="body" placeholder="本文" required>
        <input type = "submit">
        </form>
        
</body>
</html>