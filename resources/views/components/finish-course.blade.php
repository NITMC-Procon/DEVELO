@props(['data'])
<x-main-title>支援終了</x-main-title>
<div class="main" style="min-height:31rem;">
    <h2 style="text-align: center;margin-top:5rem;">支援が終了しました</h2>
    <p style="text-align: center;">プロジェクト名:{{ $data['project'] }}</p>
    <p style="text-align: center;">コース名:{{ $data['course'] }}</p>

    {{-- <ahref="route('') "></a>--}}
</div>