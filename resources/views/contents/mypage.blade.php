<x-layout title="mypage">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header  />
    <x-mypage />
    <x-footer />
</x-layout>