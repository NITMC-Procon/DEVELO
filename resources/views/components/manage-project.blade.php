@props(['project_data'])
<div class="main">
    <div class="main-title">
        <h1>プロジェクトの管理</h1>
    </div>
    <a href="{{ route('admin.project.create') }}">
        <div class="column">
            <h2>新しいプロジェクトの作成</h2><p>新しいプロジェクトを作成します。ここからあなたの開発を始めましょう。</p>
        </div>
    </a>
    @foreach ($project_data as $project)
        <div class="column">
            <h2 style="@if(mb_strlen($project[1]) > 12)zoom:50%;@endif">{{ $project[1] }}</h2>
            <p><a href="{{ route('admin.project.update',['id'=>$project[0]]) }}" style="width:10%;">編集</a></p>
            <p><a href="{{ route('admin.project.setrelease',['id'=>$project[0]]) }}" style="width:10%;">公開設定</a></p>
            @if ($project[2])
                <p><a href="{{ route('admin.project.release.update',['id'=>$project[0]]) }}" style='width:10%;'>更新</a></p>
            @endif
            {{-- <a href="{{ route('admin.diary') }}"></a> --}}
            {{-- <a href="{{ route('admin.course.manage',['id'=>$project[0]])) }}"></a> --}}
        </div>
    @endforeach
</div>