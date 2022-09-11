<x-layout title="update-project">
    <x-slot name="styles">
        @vite([
            "resources/css/update-project.css",
            "resources/js/update-project.js"
        ])
    </x-slot>
    <x-header  />
    <x-update_project :project_data=$project_data/>
    <x-footer />
</x-layout>