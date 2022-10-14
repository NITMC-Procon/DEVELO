
<div class="header">
        <div class="logo">
            {{-- ロゴ。ホームに戻る --}}
            <a href="{{ route('home') }}" class="logo-flex">
                <img src="/img/system-icon/develo-logo.png" class="logo-img">
            </a>
        </div>
        <div class="header-menu">
            {{-- 活動日誌閲覧(作成中) --}}
            <a href="{{ route('admin.diary.manage') }}" class="header-menu-text">
                <p>活動日誌</p>
            </a>
        </div>
        <div class="header-menu">
            {{-- プロジェクト検索(未作成) --}}
            <a href="{{ route('search') }}" class="header-menu-text">
                <p>検索</p>{{--  --}}
            </a>
        </div>
        <div class="header-menu">
            <a href="{{ route('mypage') }}" class="header-menu-text">
                <p>マイページ</p>
            </a>
        </div>
        <div class="header-menu">
            {{-- ユーザメニューのところ 非ログインならログインボタン。既ログインなら名前 --}}
            @if (empty(Auth::user()->name))
                <a href="{{ route("login") }}" class="header-menu-text">
                    <p>ログイン</p>
                </a>
            @else
                <a href="{{ route("user") }}" class="header-menu-text">
                    <div class="usr-outer">
                        <img src="{{ url('/storage/img/user-icon/'.Auth::user()->id.'.png') }}" class="usr-icon">
                        <p>
                            @php
                                $name = Auth::user()->name;
                                $name = strlen($name)>16 ? mb_substr($name,0,4) . "…" : $name;
                                echo($name);
                            @endphp
                        </p>
                    </div>
                </a>
            @endif
        </div>
    </div>