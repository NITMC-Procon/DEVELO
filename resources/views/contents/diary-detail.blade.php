<x-layout title="dairy-detail">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header  />
    <x-diary-detail :diary_data=$diary_data  />
    <x-footer />
</x-layout>