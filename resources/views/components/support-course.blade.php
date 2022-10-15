@props(['course_data','user_data','pack','a'=>''])
<x-main-title>コースの支援:{{ $pack['project']."=>".$pack['course'] }}</x-main-title>
<div class="main">
    <div class='main-left'>
        <div class='main-left-top'>
            <h2>収集するプロフィール</h2>
            @foreach ($user_data as $data)
                @if ($data['is-collect'])
                    <p class="is-collect"><img src="{{ url('img/system-icon/profile-collect.png') }}">{{ $data['name'] }}</p>
                @else
                    @php
                        $a = $a." ".$data['name'];
                    @endphp
                @endif
            @endforeach
            @if ($a??false)
                
                <script>
                    if(window.confirm('以下のプロフィールを設定してください:'+"{{ $a }}"))window.location.href="{{ route('profile.view') }}";
                    else history.back();
                </script>

            @endif
        </div>
        <div class="main-left-bottom">
            <h3>現在の回答数</h3>
            <p><span id='c'>0</span>/<span id='m'>{{ count($course_data) }}</span>問</p>
            <button type="button" id='submit'>回答の送信</button>
        </div>
    </div>
    <div class="main-right">
        <form action="{{ route('manage.support.store',['id' => $pack['id']]) }}" method="post" name='forms'>
            @csrf
            @foreach ($course_data as $q => $data)
                <div class='content'>
                    @if ($data['type'] == 'text')
                        <p>{{ $q }}:{{ $data['content']['text-sent'] }}({{ (($data['content']["text-words-high"]??999)<($data['content']["text-words-low"]??0))?($data['content']["text-words-high"]??999):($data['content']["text-words-low"]??0) }}~{{ $data['content']["text-words-high"]??999 }}文字)</p>
                        <textarea class='ans' name="{{ $q }}" maxlength="{{ $data['content']["text-words-high"]??999 }}" minlength="{{ (($data['content']["text-words-high"]??999)<($data['content']["text-words-low"]??0))?($data['content']["text-words-high"]??999):($data['content']["text-words-low"]??0) }}" cols="30" rows="10"></textarea>
                    @elseif ($data['type'] == 'select')
                        <p>{{ $q }}:{{ $data['content']['select-sent'] }}</p>
                        <select class='ans' name="{{ $q }}">
                            <option value="">未選択</option>
                            @for ($i=1;$i<=$data['content']["select-quantity"];$i++)
                                <option value="{{ $i }}">{{ $data['content']['select-text'.$i] }}</option>
                            @endfor
                        </select>
                    @endif    
                </div>
            @endforeach
        </form>
    </div>
</div>