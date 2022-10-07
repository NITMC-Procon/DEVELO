@props(["title","intro","user","status"=>"開発中","userId","created"=>"2022-02-27","updated"=>"2025-10-22"])
<div style="display: flex;">
    <div style="text-align:center;align-items:center;width:66.7%;border:1px solid black;">
        <div style="border-bottom: 2px solid black;">
            <h1 style="width:80%;margin:0 auto;word-wrap:break-word;">{{ $title }}</h1>
            <div style="display:inline-flex;">
                <a href="http://localhost/project/edit-history/1" style="display:inline-block;border:1px solid black;color:#AAA;font-size:0.7rem;width:auto;margin-top:auto;margin-bottom:auto;margin-right:1rem;">
                    公開日 {{ $created }} 最新の編集 {{ $updated }}
                </a>
                <p style="margin-right:1rem;">
                    開発状況 <span style="font-weight: bold;">{{ $status }}</span>
                </p>
                <a href="http://localhost/profile/view/1" style="display:inline-block;border:1px solid black;text-decoration:none;align-items:center;">
                    <img src="/img/usr-icon/{{ $userId }}.png" style="height:1rem;padding-right:0.2rem;vertical-align:middle;"><span>develo太郎</span> 
                </a>
            </div>
        </div>
        <p style="margin:0 auto;width:80%;word-wrap:break-word;overflow:auto;">
            @php
                print($intro);
            @endphp
        </p>
    </div>
</div>
