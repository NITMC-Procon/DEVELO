<div class="main">
    {{-- 現在のページの位置関係を表示 --}}
    <div class="main-now">

    </div>
    {{-- タイトル表示 ここではプロジェクトの作成 --}}
    <div class="main-title">
        <h1>プロジェクトの作成</h1>
    </div>
    <p>プレビュー</p><button type="button" id="text-preview">「プロジェクトの説明」プレビュー</button>
    <div class="main-content-wrapper">
        <div>
            {{-- プレビューエリア --}}
            <div class="main-preview">

                <span id="preview"></span>
                

            </div>
            <form>
                <div id="main_intro_menu">
                    <p>特殊機能</p>
                    <ul>
                        <li><button type="button" id="add-img" value="img" onclick="addImg();">画像の追加</button></li>
                        <div id="with-image">
                            <li id="img-area"><input type="file" name="img"  id="img"></li>
                            <li><input type="text" placeholder="画像の説明" id="alt"></li>    
                        </div>
                        <div id="without-image">
                            <li><input type="text" placeholder="テキスト" id="text"></li>
                            <li><input type="url" name="url" id="url" placeholder="url"></li>
                            <li>
                                <select name="color" id="color" onchange="showColor();">
                                    <option>色の選択</option>
                                    <option value="#F00">red</option>
                                    <option value="#0F0">green</option>
                                    <option value="#00F">blue</option>
                                    <option value="#FF0">yellow</option>
                                    <option value="option">optional color</option>
                                </select>
                                <input type="color" name="color" id="color_picker">
                                <p id="selected-color">preview</p>
                                <p id="url-preview"></p>
                            </li>
                        </div>
                        <li><button type="button"  id="menu-submit">決定</button></li>
                    </ul>
                </div>
            </form>
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
            <form id="main_forms" action="{{ route('save-project') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- プロジェクトのタイトル
                    jsの関数はwindow.(関数名) = function(){[...]}とかくと読み込める --}}
                <input type="text" name="title" maxlength="20" placeholder="プロジェクトのタイトル" value="{{ old("title") }}" onkeyup="showLength(value,'title');" required>
                <p><span id='title'>0</span>/20文字</p>
                {{-- 開発状況 --}}
                <select name="status">
                    {{-- validate前の値の保持 --}}
                    <option value=0 @if(old("status") == "0") selected @endif>開発状況</option>
                    <option value=1 @if(old("status") == "1") selected @endif>構想中</option>
                    <option value=2 @if(old("status") == "2") selected @endif>開発中</option>
                    <option value=3 @if(old("status") == "3") selected @endif>開発終了</option>
                    <option value=4 @if(old("status") == "4") selected @endif>停止中</option>
                </select><br>
                <textarea name="about" placeholder="概略の内容はプロジェクトの検索時に表示されます" maxlength="50" oninput="showLength(value,'about')" value="{{ old("about") }}"  cols="30" rows="10">{{ old('about') }}</textarea>
                <p><span id='about'>0</span>/50文字</p>
                <br>
                <input type="file" name="project-icon" id="project-icon"><br>
                <p><span id="intro">0</span>/5000文字</p>
                <textarea name="intro" id="intro-text" cols="50" rows="30" maxlength="5000" oninput="showLength(value,'intro')">{{ old('intro') }}</textarea>
                <br><button type="submit" id="form-submit">内容の保存(＊まだ公開されません)</button>
                <input type="hidden" name="date" id="date" value="{{ old('date') }}">
                
            </form>
        </div>
    </div>
    
    
</div>