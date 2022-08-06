@props(["title"=>""])

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title."-".config('app.name') }}</title>
    @vite([
        "resources/css/header.css",
        'resources/css/footer.css',
    ])
    {{ $styles }}
</head>
<body>
    {{ $slot }}
</body>
</html>