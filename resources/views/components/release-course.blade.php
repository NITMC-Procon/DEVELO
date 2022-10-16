@props(['data'])
<x-main-layout title='コースの公開設定{{ $data[1] }}'>
    @if ($data[3])
        <p>コースは公開中です。</p>
    @elseif ($data[2])
        <p>コースが公開可能です。公開しますか？<a href="{{ route('manage.course.release',['id'=>$data[0]]) }}">公開する</a></p>
    @else
        <p>コースは公開出来ません。</p>
    @endif
</x-main-layout>