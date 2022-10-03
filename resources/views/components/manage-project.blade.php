@props(['project_data'])
@php
    use App\Models\Project;
@endphp
<div>
    @foreach ($project_data as $project)
        <div style="display: flex; align-items: center; margin:5px;height:2rem; border:2px solid #AAA;">
            <h2 style="display:inline-block;width:25%;@if(mb_strlen($project[1]) > 12)zoom:50%;@endif">{{ $project[1] }}</h2>
            <a href="{{ route('admin.project.update',['id'=>$project[0]]) }}" style="width:10%;">編集</a>
            <a href="{{ route('admin.project.setrelease',['id'=>$project[0]]) }}" style="width:10%;">公開設定</a>
            
            {{-- <a href="{{ route('admin.diary') }}"></a> --}}
            {{-- <a href="{{ route('admin.course.manage',['id'=>$project[0]])) }}"></a> --}}
        </div>
    @endforeach
    @if ($project_data == [])
    <div class="main-title">
        <h1>プロジェクトの管理</h1>
    </div>
    <p style="margin-left: 2rem;">プロジェクトがまだありません。開発物について説明し、世の人々にデータ支援を求めましょう。</p>
    <div style="display: flex; align-items: center; margin:5px;height:2rem; border:2px solid #AAA;">
        <h2 style="display:inline-block;width:25%;">新しいプロジェクトの作成</h2>
        <a href="{{ route('admin.project.create') }}" style="width:10%;">作成</a>
    </div>
    @endif
</div>