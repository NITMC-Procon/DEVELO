<x-layout title="home" >
    <x-slot name="styles">
        @vite([
            "resources/css/main.css",
        ])
    </x-slot>

    <x-header />
    <x-homepage />
    <x-footer />
</x-layout>