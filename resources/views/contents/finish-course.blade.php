<x-layout title="finish-support">
    <x-slot name="styles">
        @vite([
            'resources/css/finish.css',
        ])
    </x-slot>
    <x-header  />
    <x-finish-course :data=$data  />
    <x-footer />
</x-layout>