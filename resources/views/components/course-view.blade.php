@props(['course_data'])
<div style="flex-basis:33.3%;height:31rem;overflow:scroll;">
    <h1 style="width:100%;height:3rem;border-bottom:2px solid black;text-align: center;">コースの一覧</h1>
    @foreach ($course_data as $data)
        <div style="margin:0.5rem;border:2px solid #444;background-color:rgb(254, 248, 146);">
            <h2 style="">{{ $data['title'] }}</h2>
            <p>リターン:{{ $data['return'] }}</p>
            <p><a href="{{ route('support.course',['id'=>$data['id']]) }}">このコースで支援する</a></p>
        </div>
    @endforeach
</div>