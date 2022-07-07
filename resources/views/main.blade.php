@extends('layouts.layout')
@section('id',$id)
@section('name',$name)
@section('content')
<head>
    @vite([
        "resources/css/main.css",
    ])
</head>
<div class="main">
    <div class="published-projects">
        <h1 class="div-title">公開中のプロジェクト</h1>
    </div>
    <div class="div-url">
        <a href="">
            <p><span>>></span>プロジェクトの管理</p>
        </a>
    </div>
    <div class="notable-projects">
        <h1 class="div-title">注目のプロジェクト</h1>
    </div>
    <div class="div-url">
        <a href="">
            <p><span>>></span>注目のプロジェクト</p>
        </a>
    </div>
    <div class="new-projects">
        <h1 class="div-title">新規のプロジェクト</h1>
    </div>
    <div class="div-url">
        <a href="">
            <p><span>>></span>プロジェクトの検索</p>
        </a>
    </div>
</div>

@endsection
