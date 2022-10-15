@props(["project_data"])
<div style="display: flex;flex-basis:66.7%">
    <div style="text-align:center;width:150%;align-items:center;border:1px solid black;">
        <div style="border-bottom: 2px solid black;">
            <h1 style="width:80%;margin:0 auto;word-wrap:break-word;">{{ $project_data['title'] }}</h1>
            <div style="display:inline-flex;">
                <a href="" style="display:inline-block;color:#AAA;font-size:0.7rem;width:auto;margin-top:auto;margin-bottom:auto;margin-right:1rem;">
                    公開日 {{ $project_data['created'] }} 最新の編集 {{ $project_data['updated'] }}
                </a>
                <p style="margin-right:1rem;">
                    開発状況 <span style="font-weight: bold;">{{ $project_data['status'] }}</span>
                </p>
                <a href="http://localhost/profile/view/1" style="display:inline-block;text-decoration:none;align-items:center;">
                    <img src="{{ url('storage/img/user-icon/'.$project_data['user_id']) }}.png" style="height:1rem;padding-right:0.2rem;vertical-align:middle;"><span>{{ $project_data['user_name'] }}</span> 
                </a>
            </div>
        </div>
        <p style="margin:0 auto;width:80%;word-wrap:break-word;overflow:auto;">
            @php
                print($project_data['intro']);
            @endphp
        </p>
    </div>
</div>
