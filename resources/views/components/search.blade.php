@props(['projects','search'=>""])
<div class="main">
    <x-main-title>プロジェクトの検索</x-main-title>
    <div id="search-form">
        <form action="{{ route('search') }}" method="GET">
            <input type="search" name="search" placeholder="検索ワードを入力してください" value="{{ $search }}" class="form-text">
            <button type="submit">検索</button>  
        </form>
    </div>    
    <div id='search-result'>
        @foreach ($projects as $project)
            <div class="view">
                <img src="{{ url('storage/img/project-icon/'.$project['icon']) }}">
                <div>
                    <h2>{{ $project['title'] }}</h2>
                    <p>プロジェクトの概要:{{ $project['about'] }}</p>   
                </div>
                <a href="{{-- route('support.project',['id'=>$project['project_id']]) --}}">プロジェクトを見てみる</a>
            </div>
        @endforeach
    </div>
</div>
