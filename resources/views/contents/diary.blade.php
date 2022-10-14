<x-layout title="diary-project">
    <x-slot name="styles">
        @vite([
            "resources/css/diary-project.css",
        ])
    </x-slot>
    <x-header />
    <x-diary  :project_diary=$projects_diary/>
    <x-footer />
</x-layout>