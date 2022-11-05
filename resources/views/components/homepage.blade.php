@props(['latestprojects','myprojects'])
<div class="main">
    <div class="published-projects">
        <h1 class="div-title">公開中のプロジェクト</h1>
        @foreach ($myprojects as $project)
        @php
            $url = 'storage/img/project-icon/'.$project['icon'];
            $id = $project['project_id'];
            $title = $project['title'];
        @endphp
            <x-home-project :url=$url :id=$id :title=$title />
        @endforeach
        
    </div>
    <div class="div-url">
        <a href="{{ route('admin.project.manage') }}">
            <p><span>>></span>プロジェクトの管理</p>
        </a>
    </div>
    <div class="notable-projects">
        <h1 class="div-title">注目のプロジェクト</h1>
        @foreach ($latestprojects as $project)
            <x-home-project :url=$url :id=$id :title=$title />
        @endforeach
    </div>
    <div class="div-url">
        <a href="https://github.com/NITMC-Procon/DEVELO">
            <p><span>>></span>注目のプロジェクト</p>
        </a>
    </div>
    <div class="new-projects">
        <h1 class="div-title">新規のプロジェクト</h1>
        @foreach ($latestprojects as $project)
            <x-home-project :url=$url :id=$id :title=$title />
        @endforeach
    </div>
    <div class="div-url">
        <a href="{{ route('search') }}">
            <p><span>>></span>プロジェクトの検索</p>
        </a>
    </div>
</div>