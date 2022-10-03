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
    <x-edit-project main_title="プロジェクトの作成" mode="create"></x-edit-project>
    <x-footer />
</x-layout>