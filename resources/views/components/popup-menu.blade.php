@props(["id"=>"","title"=>"","type"=>""])

{{-- クリックすると説明を表示するコンポーネントです。popup-menu-premiseコンポーネントが必須です。 --}}
    <img src='{{ url('img/system-icon/setsumei.png') }}' style="height:1rem;position:relative;left:0.2rem;top:0.1rem;" id="{{ $id }}" class="synchroBtn">
    <div style="display:none;border:2px solid #AAA;background-color:#F9FFF9;height:auto;width:20rem;position:absolute;z-index:4;" class="synchro {{ $id }} {{ $type }}">
        <img src='{{ url('img/system-icon/setsumei-close.png') }}' style="height:1rem;position:relative;" class="synchroClose"><br>
        <div style="margin:0px 2rem;position:relative;top:-0.5rem;">
            <h2 style="border-bottom:2px #888 solid;margin:0px;text-align:center;white-space:nowrap;font-size:100%;" class="menu-title">{{ $title }}</h2>
            <p style="width:16rem;">{{ $slot }}</p>
        </div>
    </div>