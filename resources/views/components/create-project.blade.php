<div class="main">
    {{-- 現在のページの位置関係を表示 --}}
    <div class="main-now">

    </div>
    {{-- タイトル表示 ここではプロジェクトの作成 --}}
    <div class="main-title">
        <h1>プロジェクトの作成</h1>
    </div>
    {{-- form タグで各情報のインプット --}}
    <div class="main-forms">
        {{-- /save-project(未作成) にデータを送信 --}}
        <form action="/save-project" method="post">
            @csrf
            {{-- プロジェクトのタイトル
                jsの関数はwindow.(関数名) = function(){[...]}とかくと読み込める --}}
            <input type="text" name="title" maxlength="20" placeholder="プロジェクトのタイトル" value="{{ old("title") }}" onkeyup="showLength(value,'title');" required>
            <p><span id='title'>0</span>/20文字</p>
            {{-- 開発状況 --}}
            <select name="status">
                {{-- CreateProjectController でvalue=0なら入力しなおしのバリデーションチェック
                    バリデーションチェック前の値を保持 --}}
                <option value="0" @if(old("status") == "0") selected @endif>開発状況</option>
                <option value="1" @if(old("status") == "1") selected @endif>構想中</option>
                <option value="2" @if(old("status") == "2") selected @endif>開発中</option>
                <option value="3" @if(old("status") == "3") selected @endif>開発終了</option>
                <option value="4" @if(old("status") == "4") selected @endif>停止中</option>
            </select><br>
            <textarea name="about" placeholder="概略の内容はプロジェクトの検索時に表示されます" maxlength="50" oninput="showLength(value,'about')" value="{{ old("about") }}"  cols="30" rows="10"></textarea>
            <p><span id='about'>0</span>/50文字</p>
            <br>
            <p><span id="intro">0</span>/1000文字</p>
            <textarea name="intro" cols="50" rows="30" maxlength="1000" oninput="showLength(value,'intro')"></textarea>
            <input type="submit">
        </form>
    </div>
</div>