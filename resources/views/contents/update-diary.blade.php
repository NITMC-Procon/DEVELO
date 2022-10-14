<x-layout title="update-diary">
    <x-slot name="styles">
        @vite([
            "resources/css/project-diary.css",
            "resources/js/project-diary.js",
            "resources/js/popup-menu.js",
            "resources/js/special-menu.js"
        ])
    </x-slot>
    <x-header/>
    <x-update-diary main_title="開発日誌" mode="update" :project_diary=$project_diary></x-update-diary>
    <x-footer />
</x-layout>