<x-layout title="home" >
    <x-slot name="styles">
        @vite([
            "resources/css/main.css",
        ])
    </x-slot>

    <x-header />
    
    <x-homepage :latestprojects=$latestprojects :myprojects=$myprojects/>
    
    <x-footer />
</x-layout>