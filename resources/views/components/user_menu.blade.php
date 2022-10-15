<x-main-title>ユーザメニュー</x-main-title>
<div class="main">
    <a href="{{ route('profile.view') }}">
        <div class="column">
            <h2>プロフィールの設定</h2><p>プロフィールの設定を行います。設定された内容はコースの支援時に収集されることがあります。</p>
        </div>
    </a>
    <a href='#'>
        <div class="column" id="logout">
            <h2>ログアウト</h2><p>ログアウトします。</p>
        </div>
    </a>
    
    
    <form method="POST" name='logout' action="{{ route('logout') }}" hidden>
        @csrf
        <input type="submit" value="logout">
    </form>
</div>
<script>
    document.querySelector('#logout').onclick = e => {
        e.preventDefault = null;
        document.logout.submit();
    }
</script>

