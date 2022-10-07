@props(['title'=>'title'])
<div class="main-title">
    <h1 @php if(mb_strlen($title)>20)echo 'style="zoom:50%;"'@endphp>公開プロジェクトの更新:{{ $title }}</h1>
</div>