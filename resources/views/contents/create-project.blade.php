<x-layout title="create-project">
    <x-slot name="styles">
        @vite([
            "resources/css/create-project.css",
            "resources/js/create-project.js",
            "resources/js/popup-menu.js",
            "resources/js/special-menu.js"
        ])
    </x-slot>
    <x-header/>
    <x-create-project />
    <x-footer />
</x-layout>