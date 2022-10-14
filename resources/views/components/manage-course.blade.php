@props(['course_data'])
<div>
    <div class="main-title">
        <h1>コースの管理</h1>
    </div>
    @foreach ($course_data as $course)
        <div style="display: flex; align-items: center; margin:5px;height:2rem; border:2px solid #AAA;">
            <h2 style="display:inline-block;width:25%;@if(mb_strlen($course[1]) > 12)zoom:50%;@endif">{{ $course[1] }}</h2>
            {{-- <a href="{{ route('admin.course.update',['id'=>$course[0]]) }}" style="width:10%;">編集</a> --}}
            {{--<a href="{{ route('admin.course.setrelease',['id'=>$course[0]]) }}" style="width:10%;">公開設定</a>  --}}
            {{-- <a href="{{ route('admin.course.release.update',['id'=>$course[0]]) }}" style='width:10%;'>更新</a> --}}
            {{-- <a href="{{ route('admin.diary') }}"></a> --}}
            {{-- <a href="{{ route('admin.course.manage',['id'=>$course[0]])) }}"></a> --}}
        </div>
    @endforeach
    @if ($course_data == [])
    <p style="margin-left: 2rem;">コースがまだありません。リターンを用意し、支援者にデータ収集を呼びかけましょう。</p>
    <div style="display: flex; align-items: center; margin:5px;height:2rem; border:2px solid #AAA;">
        <h2 style="display:inline-block;width:25%;">新しいコースの作成</h2>
        <a href="{{ route('admin.course.create',['id'=>$course_data['id']]) }}" style="width:10%;">作成</a>
    </div>
    @endif
</div>