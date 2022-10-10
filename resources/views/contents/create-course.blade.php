<x-layout title="create-course">
    <x-slot name="styles">
        @vite([
            'resources/css/edit-course.css',
            'resources/js/edit-course.js',
            "resources/js/popup-menu.js",
        ])
    </x-slot>
    <x-header/>
    <x-edit-course :data=$data ></x-edit-course>
    <x-footer />
</x-layout>