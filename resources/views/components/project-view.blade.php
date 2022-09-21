<div style="display:flex;">
    <div>{{ $slot }}</div>
    <div style="height:18rem;width:3.8rem">
        <p>特殊要素<x-popup-menu title="特殊要素" id="special">
            文章中に色の異なる文字を追加出来たり、画像を載せたりできます。決定を押した時点で画像がサーバに送信されるため、サーバから画像を削除したい場合はマイページから行ってください。
        </x-popup-menu></p>
    </div>
</div>