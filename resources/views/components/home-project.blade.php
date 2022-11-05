@props(['title','url','id'])
<div style='border:1px solid #222;height:80%;width:20rem;position: relative;top:-10%;text-align:center;margin:0 1rem;'>
    <img src="{{ url($url) }}" style='height:40%;border:1px solid black;margin:0.5rem;'>
    <div>
        <h2 style='width:100%;'>{{ $title }}</h2>  
    </div>
    <a href="{{ route('support.project',['id'=>$id]) }}">プロジェクトを見てみる</a>
</div>