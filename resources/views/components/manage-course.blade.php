@props(['project_data'])
<div class='main'>
    <x-main-title>コースの管理:プロジェクトの選択</x-main-title>
    @foreach ($project_data as $project)
        <a href="{{ route('admin.course.manage',['id'=>$project[0]]) }}">
            <div class="column">
                <h2 style="@if(mb_strlen($project[1]) > 12)zoom:50%;@endif">{{ $project[1] }}</h2><p style="max-width: 30rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">プロジェクトの概要:{{ $project[2] }}</p>
            </div>
        </a>
    @endforeach
    @if ($project_data == [])
        <a href="{{ route('admin.project.manage') }}">
            <div class="column">
                <h2>プロジェクトの管理画面</h2><p>プロジェクトがまだありません。プロジェクトの管理画面に移動しますか？</p>
            </div>
        </a>
    @endif
</div>