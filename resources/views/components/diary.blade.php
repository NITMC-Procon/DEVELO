@props(['project_diary'])
@php
    use App\Models\Project;
@endphp
<div>
    <h1>プロジェクト一覧</h1><br>
    @foreach ($project_diary as $project)
        <div style="display: flex; align-items: center; margin:5px;height:2rem;" class="project-name">
            <h2 style="display:inline-block;width:25%">　
            <a href="{{ route('admin.diary.update',['id'=>$project[0]]) }}" style="width:10%;text-decoration:none;color:inherit;">{{ $project[1] }}</a>
            </h2>
        </div>
    @endforeach
    @if ($project_diary == [])
    <div class="main-title">
        <h1>プロジェクトの管理</h1>
    </div>
    <p style="margin-left: 2rem;">プロジェクトがまだありません。開発物について説明し、世の人々にデータ支援を求めましょう。</p>
    <div style="display: flex; align-items: center; margin:5px;height:2rem; border:2px solid #AAA;">
        <h2 style="display:inline-block;width:25%;">新しいプロジェクトの作成</h2>
        <a href="{{ route('admin.project.create') }}" style="width:10%;">作成</a>
    </div>
    @endif
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <br>
</div>