<div style="display:flex;">
    <div>{{ $slot }}</div>
    <div id="special-menu" style="height:18rem;width:5.5rem;margin:2px;border:2px solid black;">
        <p>特殊要素<x-popup-menu title="特殊要素" id="special">
            文章中に色の異なる文字を追加出来たり、画像を載せたりできます。決定を押した時点で画像がサーバに送信されるため、サーバから画像を削除したい場合はマイページから行ってください。
        </x-popup-menu></p>
        <img src="{{ url('storage/img/icon/specialmenu-image.png') }}" id="insert-image" class="button" style="width: 100%;" alt="画像の挿入">
        <img src="{{ url('storage/img/icon/specialmenu-text.png') }}" id="insert-text" class="button" salt="テキスト" style="width:100%;">
        
    </div>
</div>
<div class="menu-view insert-image" style="list-style:none;display:none;position:absolute;background-color:#F9FFF9;padding:0.5rem;border:2px black solid;">
    <img src='{{ url('storage/img/icon/setsumei-close.png') }}' style="height:1rem;position:relative;left:-0.5rem;top:-0.5rem;" class="Close"><br>
    <p><span >画像の挿入</span><x-popup-menu title="画像の挿入" id="insert-img-intro">文章中に画像を挿入出来ます。画像は中心にそろえて配置されます。「挿入」を押した時点でサーバに画像が送信されるため、画像をサーバから削除したい場合はマイページから行ってください。</x-popup-menu></p>
    <li id="img-area"><input type="file" name="img"  id="img"></li>
    <li><input type="text" placeholder="画像の説明" id="alt"></li>
    <li><button type="button">挿入</button></li>    
</div>
<div class="menu-view insert-text" style="list-style:none;display:none;position:absolute;background-color:#F9FFF9;padding:0.5rem;border:2px black solid;word-wrap:break-word;">
    <img src='{{ url('storage/img/icon/setsumei-close.png') }}' style="height:1rem;position:relative;left:-0.5rem;top:-0.5rem;" class="Close"><br>
    <li><p id="selected-color" style="width:9rem;word-wrap:break-word;">preview</p></li>
    <li><input type="text" placeholder="テキスト" id="text"></li>
    <li><input type="url" name="url" id="url" placeholder="url"></li>
    <li>
        <label>文字色の選択<br><input type="color" id="color_picker"></label>
        <p id="url-preview"></p>
    </li>
    <li><button type="button">挿入</button></li>
</div