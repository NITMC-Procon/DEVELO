@props(['main_title','mode','project_diary'])
<div class="main">
    {{-- プロジェクト公開用リンクからの遷移 --}}
    @if (session('message'))
        <script>
            window.onload = ( ) => {
                alert("{{ session('message') }}")
            }
        </script>
    @endif
    {{-- 現在のページの位置関係を表示 --}}
    <div class="main-now">

    </div>
    {{-- タイトル表示 ここではプロジェクトの作成 --}}
    <div class="main-title">
        <h1 @php if($mode == 'update')if(mb_strlen($project_diary['title'])>20)echo 'style="zoom:50%;"'@endphp>{{ $main_title }}@if($mode == 'update'):{{ $project_diary['title'] }}@endif</h1>
    </div>
    <div class="main-content-wrapper">
        <div>
            {{-- プレビューエリア --}}
            
            <div class="main-preview">
                <div class="preview_intro"><b>現在のプレビュー</b><x-popup-menu title="現在のプレビュー" id='preview_popup' type="center">現在入力している内容から、プロジェクト支援画面で表示される画面を確認できます。内容はサーバには保存されません。</x-popup-menu></div>
                <span id="preview"></span>
                <button type="button" id="text-preview">プレビュー</button>

            </div>
        </div>
        {{-- form タグで各情報のインプット --}}
        <div class="main-forms">
            @error('status')
                <p style="color:red;">「開発状況」が設定されていません</p>
            @enderror
            @error('about')
                <p style="color:red;">「概要」が記入上限を超えています</p>
            @enderror
            @error('text')
                <p style="color:red;">「日誌の説明」が記入上限を超えています。</p>
            @enderror
            {{-- /save-project(未作成) にデータを送信 --}}
            <form id="main_forms" name="main_forms" action="{{ route('manage.diary.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- プロジェクトのタイトル
                    jsの関数はwindow.(関数名) = function(){[...]}とかくと読み込める --}}
                <label for="title-text">タイトル<x-popup-menu id="title-intro" title="タイトル" >作成する日誌のタイトルを入力します。開発物の名前や目的などを端的に表現し、一目で印象付けられるタイトルを考えましょう。<br><span style="color:red;">入力必須</span></x-popup-menu></label><br>
                    <input type="text" id="title-text" name="title" maxlength="40" placeholder="日誌のタイトル" value="{{ (old("title") ?? (isset($project_diary['title']) ? $project_diary['title'] : "")) }}" oninput="showLength(value,'title');" required>
                    <span id='title'>0</span>/40文字
                <br>
                <label for="project-icon">開発の様子</label><x-popup-menu id="icon-intro" title="アイコン">ランキング掲載時などに表示される画像です。未選択の場合は標準の画像が表示されます。</x-popup-menu><br>
                    <input type="file" name="project-icon" id="project-icon">
                <br>
                
                <label for="intro-text">説明</label><x-popup-menu id="intro-intro" title="説明">プロジェクトの支援ページに表示されるプロジェクトの説明文です。プロジェクトの動機や今後の予定、コースの紹介など、支援者に対して過不足のない説明ができるように工夫を凝らしましょう。<br><span style="color:red;">プロジェクト公開時入力必須</span></x-popup-menu>
                    <br>
                    <textarea name="text" id="intro-text" cols="50" rows="30" maxlength="5000" oninput="showLength(value,'aaaaa');">{{ (old("text") ?? (isset($project_diary['text']) ? $project_diary['text'] : "")) }}</textarea>
                    <span id="aaaaa">0</span>/10000文字
                <br><button type="submit" id="form-submit">内容の保存(＊まだ公開されません)</button>
                <input type="hidden" name="date" id="date" value="{{ $mode == "create" ? old('date') : $diary_data['date']; }}">
                <div value="{{ (old("created_at") ?? (isset($diary_data['created_at']) ? $diary_data['created_at'] : "")) }}"></div>
                
            </form>
        </div>
    </div>
    
</div>