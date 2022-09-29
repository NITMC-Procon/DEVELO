<div class="main">
    {{-- 現在のページの位置関係を表示 --}}
    <div class="main-now">

    </div>
    {{-- タイトル表示 ここではプロジェクトの作成 --}}
    <div class="main-title">
        <h1>プロジェクトの作成</h1>
    </div><button type="button" id="text-preview">「プロジェクトの説明」プレビュー</button>
    <div class="main-content-wrapper">
        <div>
            {{-- プレビューエリア --}}
            <div class="main-preview">

                <span id="preview"></span>
                

            </div>
        </div>
        {{-- form タグで各情報のインプット --}}
        <div class="main-forms">
            @error('title')
                <p style="color:red;">「プロジェクトのタイトル」が入力されていません</p>
            @enderror
            @error('status')
                <p style="color:red;">「開発状況」が設定されていません</p>
            @enderror
            @error('about')
                <p style="color:red;">「概要」が記入上限を超えています</p>
            @enderror
            @error('intro')
                <p style="color:red;">「プロジェクトの説明」が記入上限を超えています。</p>
            @enderror
            {{-- /save-project(未作成) にデータを送信 --}}
            <form id="main_forms" action="{{ route('manage.project.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- プロジェクトのタイトル
                    jsの関数はwindow.(関数名) = function(){[...]}とかくと読み込める --}}
                <label for="title-text">タイトル<x-popup-menu id="title-intro" title="タイトル" >作成するプロジェクトのタイトルを入力します。開発物の名前や目的などを端的に表現し、一目で印象付けられるタイトルを考えましょう。<br><span style="color:red;">入力必須</span></x-popup-menu></label><br>
                    <input type="text" id="title-text" name="title" maxlength="40" placeholder="プロジェクトのタイトル" value="{{ old("title") }}" oninput="showLength(value,'title');" required>
                    <span id='title'>0</span>/40文字
                <br>
                {{-- 開発状況 --}}
                <label>開発状況<x-popup-menu id="status-intro" title="開発状況">開発の進み具合を表すステータスを設定します。現在の状況に応じて適切に選択しましょう。<br><span style="color:red;">プロジェクト公開時入力必須</span></x-popup-menu><br>
                    <select name="status">
                        {{-- validate前の値の保持 --}}
                        <option value=0 @if(old("status") == "0") selected @endif>未選択</option>
                        <option value=1 @if(old("status") == "1") selected @endif>構想中</option>
                        <option value=2 @if(old("status") == "2") selected @endif>開発中</option>
                        <option value=3 @if(old("status") == "3") selected @endif>開発終了</option>
                        <option value=4 @if(old("status") == "4") selected @endif>停止中</option>
                    </select>
                </label><br>
                <label for="project-icon">アイコン</label><x-popup-menu id="icon-intro" title="アイコン">ランキング掲載時などに表示される画像です。未選択の場合は標準の画像が表示されます。</x-popup-menu><br>
                    <input type="file" name="project-icon" id="project-icon">
                <br>
                <label>概要<x-popup-menu id="about-intro" title="概要">検索時などに表示されるプロジェクトの説明文です。プロジェクトについて、興味を引くような説明を考えましょう。<br><span style="color:red;">プロジェクト公開時入力必須</span></x-popup-menu>
                    <br><textarea name="about" placeholder="概略の内容はプロジェクトの検索時に表示されます" maxlength="200" oninput="showLength(value,'about');"   cols="39" rows="15">{{ old('about') }}</textarea>
                    <span id='about'>0</span>/200文字
                </label><br>
                
                <label for="intro-text">説明</label><x-popup-menu id="intro-intro" title="説明">プロジェクトの支援ページに表示されるプロジェクトの説明文です。プロジェクトの動機や今後の予定、コースの紹介など、支援者に対して過不足のない説明ができるように工夫を凝らしましょう。<br><span style="color:red;">プロジェクト公開時入力必須</span></x-popup-menu>
                    <br>
                    <x-special-menu>
                    <textarea name="intro" id="intro-text" cols="50" rows="30" maxlength="5000" oninput="showLength(value,'aaaaa');">{{ old('intro') }}</textarea>
                    </x-special-menu>
                    <span id="aaaaa">0</span>/5000文字
                <br><button type="submit" id="form-submit">内容の保存(＊まだ公開されません)</button>
                <input type="hidden" name="date" id="date" value="{{ old('date') }}">
                
            </form>
        </div>
    </div>
</div>