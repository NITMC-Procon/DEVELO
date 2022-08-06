<x-layout title="home" >
    <x-slot name="styles">
        @vite([
            "resources/css/main.css",
        ])
    </x-slot>

    <x-header :name=$name :id=$id />
    <x-homepage />
    <x-footer />
</x-layout>