<x-layout title="diary-project">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header />
    <x-diary  :diary_data=$diary_data/>
    <x-footer />
</x-layout>