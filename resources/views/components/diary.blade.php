@props(['diary_data'])
<div class='main'>
    <x-main-title>開発日誌の管理:プロジェクトの選択</x-main-title>
    @foreach ($diary_data as $project)
        <a href="{{ route('admin.diary.managedetail')}}">
            <div class="column">
                <h2 style="@if(mb_strlen($project[1]) > 12)zoom:50%;@endif">{{ $project[1] }}</h2>
            </div>
        </a>
    @endforeach
    @if ($diary_data == [])
        <a href="{{ route('admin.project.manage') }}">
            <div class="column">
                <h2>プロジェクトの管理画面</h2><p>プロジェクトがまだありません。プロジェクトの管理画面に移動しますか？</p>
            </div>
        </a>
    @endif
</div>