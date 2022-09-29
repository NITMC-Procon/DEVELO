@props(['project_data'])
<div>
    @foreach ($project_data as $project)
        <div style="display: flex; align-items: center; margin:5px; border:2px solid #AAA;">
            <h2>{{ $project[1] }}</h2>
            <a href="{{ route('admin.project.update',['id'=>$project[0]]) }}">編集</a>
            {{-- <a href="{{ route('admin.diary') }}"></a> --}}
            {{-- <a href="{{ route('admin.course.manage',['id'=>$project[0]])) }}"></a> --}}
        </div>
    @endforeach
</div>