@props(['diary_data'])
<div class="main">
    <div class="main-title">
        <h1>開発日誌の管理</h1>
    </div>
    <a href="{{ route('admin.diary.create') }}">
        <div class="column">
            <h2>日誌の作成</h2>
            <p>新しい日誌を作成します。今日の進捗などをみんなに伝えましょう。</p>
        </div>
    </a>
    @foreach ($diary_data as $project)
        <div class="column">
            <h2 style="@if(mb_strlen($project[1]) > 12)zoom:50%;@endif">{{ $project[1] }}</h2>
            {{-- <a href="{{ route('admin.diary') }}"></a> --}}
            {{-- <a href="{{ route('admin.course.manage',['id'=>$project[0]])) }}"></a> --}}
        </div>
    @endforeach
</div>