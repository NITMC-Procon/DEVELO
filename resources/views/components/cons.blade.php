@props(["name" => null,"id" => 0])

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <x-slot name="title">の内容が$titleに入る configヘルパは.envファイルの設定を取得する関数 --}}
    <title>{{ $title."-".config('app.name') }}</title>
    @vite([
        "resources/css/header.css",
        'resources/css/footer.css',
    ])
    {{ $styles }}
</head>
<body>
    <x-header :name=$name :id=$id />
    {{ $slot }}
    <x-footer />
</body>
</html>