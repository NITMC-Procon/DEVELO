@props(['data'])
@php
    $title = "コースの作成:".$data['title'];
@endphp
<x-main-layout :title=$title>
    <div style="display: flex;">
        <div id="main-viewer" class="main-right">
            @if (isset($data['project_content_json']))
                
            @else
                <div class="question-pointer">
                    <p>Q1</p>
                </div>
            @endif
            
            
        </div>
        <form name="editor-form" class="main-left" method="post" action="{{ route('manage.course.store',['id'=>$data['id']]) }}">
            @csrf
            <div id="main-setting" class="1">
                <label for="course-title">タイトル</label>
                <x-popup-menu id='title-popup' title="コースのタイトル">プロジェクト画面で表示したい、コースのタイトルを記入します。<br><span class="red">入力必須</span></x-popup-menu><br>
                <input type="text" name="title" id="course-title"><br>
                <p>
                    収集するプロフィール
                    <x-popup-menu title="収集するプロフィール" id="profile-popup">
                        支援時に収集するプロフィールを設定します。設定したプロフィールは、コース作成時の条件分岐に用いることができます。
                    </x-popup-menu>
                </p>
                <label><input type="checkbox" name="profile[]" id="yo" class="attributes"><span>年齢層</span></label>
                <label><input type="checkbox" name="profile[]" id="ad" class="attributes"><span>住まい</span></label>
                <label><input type="checkbox" name="profile[]" id="se" class="attributes"><span>性別</span></label>
                <p>質問の作成</p>
                <div id="course-menu">
                    <div class="question-indicator">
                        <p>作成中の質問</p><b><span id="question-count">Q1</span></b>
                    </div>
                    <img src="{{ url('img/system-icon/coursemenu-text.png') }}">
                    <img src="{{ url('img/system-icon/coursemenu-select.png') }}">
                    <img src="{{ url('img/system-icon/coursemenu-if.png') }}">
                </div>
                <div id="edit">
                    <div id="text-editor" class="editor">
                        <p>
                            質問内容
                            <x-popup-menu title="質問内容" id="text-popup">
                                回答してほしい質問を記述します。また、回答の最小文字数、最大文字数を設定できます(0~300文字)。決定を押すことにより保存できます。
                            </x-popup-menu>
                            <textarea name="text-sent" id="text-sent" cols="50" rows="4" maxlength="100"></textarea>
                        </p>
                        
                        <p>文字数<input type="number" name="text-words-low" class="text-words" min="0" max="300" value="0">~<input type="number" name="text-words-high" class="text-words" min="1" max="300" value="300"></p>
                        
                        <button type="button" id="text-confirm" class="confirm">決定</button>
                    </div>
                    <div id="select-editor" class="editor">
                        <p>
                            質問内容
                            <x-popup-menu title="質問内容" id="select-popup">
                                回答してほしい質問を記述します。その後。回答の選択肢の個数と内容を設定します。<br>また、選択肢に「その他」および記述回答を設定できます。その際、回答の文字数を制限することができます。<br>決定を押すことにより保存できます。
                            </x-popup-menu>
                            <textarea name="text-sent" id="text-sent" cols="50" rows="4" maxlength="100"></textarea>
                        </p>
                        <p>
                            選択肢<br>
                            個数:
                            <select name="select-quantity" id="select-quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            「その他」を選択肢に含む <input type="checkbox" name="other" id="other">
                        </p>
                        <div id='question-edit'>
                        </div>
                        <button type="button" id="select-confirm" class="confirm">決定</button>
                    </div>
                    <div id="if-editor" class="editor">
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
                            <label><input type="radio" name="choice">20歳以上か否か</label>
                        </div>
                        <div id='se-choice' class="choice">

                        </div>
                        <div id='ad-choice' class="choice">

                        </div>
                        <button type="button" id="if-confirm" class="confirm">決定</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</x-main-layout>