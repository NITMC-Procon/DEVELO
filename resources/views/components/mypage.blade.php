<div class='main'>
    <x-main-title>マイページ</x-main-title>
    <a href="{{ route('admin.project.manage') }}">
        <div class="column">
            <h2>プロジェクトの管理</h2><p>プロジェクトの管理画面に移ります。プロジェクトの作成、編集、公開、更新が行えます。</p>
        </div>
    </a>
    <a href="{{ route('admin.course.manage') }}">
        <div class="column">
            <h2>コースの管理</h2><p>コースの管理画面に移ります。コースの作成、編集、公開、更新が行えます。</p>
        </div>
    </a>
    <a href="{{ route('admin.diary.manage') }}">
        <div class='column'>
            <h2>開発日誌の管理</h2><p>開発日誌の管理画面に移ります。開発日誌の作成、編集、公開、更新が行えます。</p>
        </div>
    </a>
</div>