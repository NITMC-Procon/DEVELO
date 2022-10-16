@props(['course_data'])
<div class="main">
    <div class="main-title">
        <h1 style="@if (mb_strlen($course_data['project_title']) > 12)zoom:50%;@endif">コースの管理:{{ $course_data['project_title'] }}</h1>
    </div>
    <a href="{{ route('admin.course.create',$course_data['project_id']) }}">
        <div class="column">
            <h2>新規コースの作成</h2>
            <p>新しいコースを作成します。より良いモノを作るために支援を呼びかけましょう。</p>
        </div>
    </a>
    @php
        unset($course_data['project_id']);
        unset($course_data['project_title'])
    @endphp
    @foreach ($course_data as $course)
        <div class="column">
            <h2 style="@if(mb_strlen($course[1]) > 12)zoom:50%;@endif">{{ $course[1] }}</h2>
            {{-- <a href="{{ route('admin.course.update',['id'=>$course[0]]) }}" style="width:10%;">編集</a> --}}
            <a href="{{ route('admin.course.release.set',['id'=>$course[0]]) }}" style="width:10%;">公開設定</a>
            {{-- <a href="{{ route('admin.course.release.update',['id'=>$course[0]]) }}" style='width:10%;'>更新</a> --}}
            {{-- <a href="{{ route('admin.diary') }}"></a> --}}
            {{-- <a href="{{ route('admin.course.manage',['id'=>$course[0]])) }}"></a> --}}
        </div>
    @endforeach
</div>