@props(['title'=>'title'])

<div class="main" style="display: flex;flex-flow:column;">
    <div class="main-title">
        <h1 @php if(mb_strlen($title)>20)echo 'style="zoom:50%;"'@endphp>{{ $title }}</h1>
    </div>
    <div class="main-content">
        {{ $slot }}
    </div>
    
</div>