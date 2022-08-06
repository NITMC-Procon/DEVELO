@props(["name"=>null,"id"=>null])

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
            <a href="" class="header-menu-text">
                @if ($name === Null)
                    <p>ログイン</p>
                @else
                    <div class="usr-outer">
                        <img src="img/usr-icon/{{ $id }}.png" class="usr-icon">
                        <p>{{ $name }}</p>
                    </div>
                @endif
            </a>
        </div>
    </div>