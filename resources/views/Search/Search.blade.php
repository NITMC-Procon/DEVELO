<x-layout title="search" >
    <x-slot name="styles">
        @vite([
            'resources/css/search.css',
        ])
    </x-slot>

    <x-header />
    <x-search :projects=$projects :search=$search/>
    <x-footer />
</x-layout>