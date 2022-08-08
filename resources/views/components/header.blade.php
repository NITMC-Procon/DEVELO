
<div class="header">
        <div class="logo">
            <a href="" class="logo-flex">
                <img src="img/system-icon/develo-logo.png" class="logo-img">
            </a>
        </div>
        <div class="header-menu">
            <a href="" class="header-menu-text">
                <p>活動日誌</p>
            </a>
        </div>
        <div class="header-menu">
            <a href="" class="header-menu-text">
                <p>検索</p>
            </a>
        </div>
        <div class="header-menu">
            <a href="" class="header-menu-text">
                <p>マイページ</p>
            </a>
        </div>
        <div class="header-menu">
            @if (empty(Auth::user()->name))
                <a href="{{ route("login") }}" class="header-menu-text">
                    <p>ログイン</p>
                </a>
            @else
                <a href="{{ route("user") }}" class="header-menu-text">
                    <div class="usr-outer">
                        <img src="img/usr-icon/{{ Auth::user()->id }}.png" class="usr-icon">
                        <p>
                            @php
                                $name = Auth::user()->name;
                                $name = strlen($name)>8 ? mb_substr($name,0,4) . "…" : $name;
                                echo($name);
                            @endphp
                        </p>
                    </div>
                </a>
            @endif
        </div>
    </div>