<x-main-title>ユーザメニュー</x-main-title>
<div class="main">
    <div class="column">
        <h2>プロフィールの設定</h2><p>プロフィールの設定を行います。設定された内容はコースの支援時に収集されることがあります。</p>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <input type="submit" value="logout">
    </form>
</div>


