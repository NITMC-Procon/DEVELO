@props(['data'])
@php
    $title = "コースの作成:".$data['title'];
@endphp
<x-main-layout :title=$title>
    <div style="display: flex;">
        <div id="main-viewer" class="main-right">
            @if (isset($data['project_content_json']))
                @php
                    $content = $data['project_content_json'];
                @endphp
                <script>
                     result_sequence = JSON.parse({{ $content }});
                </script>
                @foreach (json_encode($content) as $q => $file)
                    <div class="question-pointer" id="{{ $q }}" >
                        <p>{{ $q }}</p>
                        <img src="{{ url('img/system-icon/courseviewer-'.$q['type'].'.png') }}" class="viewer-icon" data-value="{{ $q['type'] }}">
                    </div>
                @endforeach
                <div class="question-pointer" id="{{ 'Q'.count(json_encode($content)) }}" >
                    <p>{{ 'Q'.count(json_encode($content)) }}</p>
                    <img src="{{ url('img/system-icon/courseviewer-add.png') }}" class="viewer-icon" data-value="add">
                </div>
            @else
                <div class="question-pointer" id="Q1">
                    <p>Q1</p>
                    <img src="{{ url('img/system-icon/courseviewer-add.png') }}" class="viewer-icon" data-value="add">
                </div>
            @endif
        </div>
        <div class="main-left">
            @csrf
            <div class="first main-setting">
                <div class='flex-container'>
                    <div>
                        <label for="course-title">タイトル</label>
                        <x-popup-menu id='title-popup' title="コースのタイトル">プロジェクト画面で表示したい、コースのタイトルを記入します。<br><span class="red">入力必須</span></x-popup-menu><br>
                        <input type="text" name="title" id="course-title" required><br>
                        <p>
                            収集するプロフィール
                            <x-popup-menu title="収集するプロフィール" id="profile-popup">
                                支援時に収集するプロフィールを設定します。設定したプロフィールは、コース作成時の条件分岐に用いることができます。
                            </x-popup-menu>
                        </p>
                        <label><input type="checkbox" value='yearsold' id="yo" class="attributes"><span>年齢層</span></label>
                        <label><input type="checkbox" value='address' id="ad" class="attributes"><span>住まい</span></label>
                        <label><input type="checkbox" value='gender' id="se" class="attributes"><span>性別</span></label>
                    </div>
                    <button type="button" class="submit-button next" data-n='second'>リターンの設定</button>
                </div>
                
                <p>質問の作成</p>
                <div id="course-menu">
                    <div class="question-indicator">
                        <p>作成中の質問</p><b><span id="question-count">Q1</span></b>
                    </div>
                    <img src="{{ url('img/system-icon/coursemenu-text.png') }}" id="type-text" class='type-selector'>
                    <img src="{{ url('img/system-icon/coursemenu-select.png') }}" id="type-select" class='type-selector'>
                    <img src="{{ url('img/system-icon/coursemenu-if.png') }}" id="type-if" class='type-selector'>
                </div>
                <form id='edit-form' name="forms">
                    <div id="edit">
                        <div id="text-editor" class="editor type-text">
                            <p>
                                質問内容
                                <x-popup-menu title="質問内容" id="text-popup">
                                    回答してほしい質問を記述します。また、回答の最小文字数、最大文字数を設定できます(0~300文字)。決定を押すことにより保存できます。
                                </x-popup-menu>
                                <textarea name="text-sent" id="text-sent" class="sent fill" cols="50" rows="4" maxlength="100"></textarea>
                            </p>
                            
                            <p>文字数<input type="number" name="text-words-low" class="text-words fill" min="0" max="300" value="0">~<input type="number" name="text-words-high" class="text-words fill" min="1" max="300" value="300"></p>
                            
                            <button type="button" id="text-confirm" class="confirm">決定</button>
                        </div>
                        <div id='add-editor' class="editor" style="display: flex;">
                            <p>質問の種類が選択されていません。<br>上のメニューから選択してください。</p>
                        </div>
                        <div id="select-editor" class="editor type-select">
                            <p>
                                質問内容
                                <x-popup-menu title="質問内容" id="select-popup">
                                    回答してほしい質問を記述します。その後。回答の選択肢の個数と内容を設定します。<br>また、選択肢に「その他」および記述回答を設定できます。その際、回答の文字数を制限することができます。<br>決定を押すことにより保存できます。
                                </x-popup-menu>
                                <textarea name="select-sent" id="select-sent" class="sent fill" cols="50" rows="4" maxlength="100"></textarea>
                            </p>
                            <p>
                                選択肢<br>
                                個数:
                                <select name="select-quantity" id="select-quantity" class="fill">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                「その他」を選択肢に含む <input type="checkbox" name="other" id="other" class="fill">
                            </p>
                            <div id='question-edit'>
                            </div>
                            <button type="button" id="select-confirm" class="confirm">決定</button>
                        </div>
                        <div id="if-editor" class="editor type-if">
                            <p>
                                条件分岐
                                <x-popup-menu title="条件分岐" id="if-popup">
                                    収集するプロフィールから、質問内容を変えることができます。
                                </x-popup-menu>
                            </p>
                            <div id="if-selector">
                                <p>何れかのプロフィールを収集してください。</p>
                            </div>
                            <div id='yo-choice' class="choice">
                                <label><input type="radio" name="choice" value='u20' class="fill">20歳以上か否か</label>
                            </div>
                            <div id='se-choice' class="choice">

                            </div>
                            <div id='ad-choice' class="choice">

                            </div>
                            <button type="button" id="if-confirm" class="confirm">決定</button>
                        </div>
                    </div>
                    <input type="hidden" name="date" id="date" value="{{ $data['date']??old('date') }}">
                </form>
            </div>
            <div class="second main-setting">
                <p>
                    リターン(複数選択)
                    <x-popup-menu title='リターンの設定' id='return-popup'>リターンの設定を行います。コースの完遂後に支援者に渡されるファイルを選びましょう。Ctrl+クリックで複数のファイルを選択出来ます。</x-popup-menu>
                </p>
                <form name='returncontents'enctype="multipart/form-data">
                    <input type="file" id='return-file' multiple>
                </form>
                <br>
                <div id='file_intro'>
                    <p>各リターンの説明<x-popup-menu title='各リターンの説明' id='return-intro-popup'>各リターンについての説明を記入します。コースの選択画面で表示されるため、ファイルの内容が分かるように、短い文で説明しましょう。</x-popup-menu></p>
                </div>
                <button type="button" class="submit-button next" data-n='first' style='width:8rem;'>戻る</button>
                <button type='button' class="submit-button" id='submit' style='width:8rem;'>内容の保存</button>
            </div>
        </div>
    </div>
    <span id="url-add" data-url='{{ url('img/system-icon/courseviewer-add.png') }}'></span>
    <span id="url-text" data-url='{{ url('img/system-icon/courseviewer-text.png') }}'></span>
    <span id="url-select" data-url='{{ url('img/system-icon/courseviewer-select.png') }}'></span>
    <span id="url-if" data-url='{{ url('img/system-icon/courseviewer-if.png') }}'></span>
    <span id="url-post" data-url='{{ route('manage.course.store',['id'=>$data['id']]) }}'></span>
    <span id='url-save-return' data-url='{{ route('manage.returncontent.store',['id'=>$data['id']]) }}'></span>
    
</x-main-layout>