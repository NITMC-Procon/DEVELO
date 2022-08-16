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
        @error('title')
            <p style="color:red;">"title" exceeds the limit.</p>
        @enderror
        @error('status')
            <p style="color:red;">"status" is not selected correctly.</p>
            <p>{{ old('status') }}</p>
        @enderror
        @error('about')
            <p style="color:red;">"about" exceeds the limit.</p>
        @enderror
        @error('intro')
            <p style="color:red;">"intro" exceeds the limit.</p>
        @enderror
        {{-- /save-project(未作成) にデータを送信 --}}
        <form action="{{ route('save-project') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- プロジェクトのタイトル
                jsの関数はwindow.(関数名) = function(){[...]}とかくと読み込める --}}
            <input type="text" name="title" maxlength="20" placeholder="プロジェクトのタイトル" value="{{ old("title") }}" onkeyup="showLength(value,'title');" required>
            <p><span id='title'>0</span>/20文字</p>
            {{-- 開発状況 --}}
            <select name="status">
                {{-- CreateProjectController でvalue=0なら入力しなおしのバリデーションチェック
                    バリデーションチェック前の値を保持 --}}
                <option value=null @if(old("status") == "0") selected @endif>開発状況</option>
                <option value=1 @if(old("status") == "1") selected @endif>構想中</option>
                <option value=2 @if(old("status") == "2") selected @endif>開発中</option>
                <option value=3 @if(old("status") == "3") selected @endif>開発終了</option>
                <option value=4 @if(old("status") == "4") selected @endif>停止中</option>
            </select><br>
            <textarea name="about" placeholder="概略の内容はプロジェクトの検索時に表示されます" maxlength="50" oninput="showLength(value,'about')" value="{{ old("about") }}"  cols="30" rows="10">{{ old('about') }}</textarea>
            <p><span id='about'>0</span>/50文字</p>
            <br>
            <input type="file" name="project-icon"><br>
            <p><span id="intro">0</span>/1000文字</p>
            <textarea name="intro" class="intro" cols="50" rows="30" maxlength="1000" oninput="showLength(value,'intro')">{{ old('intro') }}</textarea>
            <input type="submit">
            <div id="main_intro_menu">
                <p>特殊機能</p>
                <ul>
                    <li><button type="button" id="add-img" onclick="addImg();">add img</button></li>
                    <div id="with-image">
                        <li><button>画像の選択</button></li>
                        <li><input type="file" name="img" enctype="multipart/form-data"></li>
                        <li><input type="text" placeholder="画像の説明"></li>    
                    </div>
                    <div id="without-image">
                        <li><input type="text" placeholder="テキスト"></li>
                        <li>
                            <select name="color" id="color" onchange="showColor();">
                                <option>色の選択</option>
                                <option value="#F00">red</option>
                                <option value="#0F0">green</option>
                                <option value="#00F">blue</option>
                                <option value="#FF0">yellow</option>
                                <option value="option">optional color</option>
                            </select>
                            <input type="text" placeholder="color code" id="optional-color">
                            <p id="selected-color">選択中の色</p>
                    </div>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    
</div>