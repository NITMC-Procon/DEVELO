<x-layout title="create-project">
    <x-slot name="styles">
        @vite([
            "resources/css/edit-project.css",
            "resources/js/edit-project.js",
            "resources/js/popup-menu.js",
            "resources/js/special-menu.js"
        ])
    </x-slot>
    <x-header/>
    <x-update-diary main_title="開発日誌の作成" mode="create" ></x-update-diary>
    <x-footer />
</x-layout>