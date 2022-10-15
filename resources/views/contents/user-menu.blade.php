<x-layout title="UserMenu">
    <x-slot name='styles'>
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header></x-header>
    <x-user_menu></x-user_menu>
    <x-footer></x-footer>
</x-layout>