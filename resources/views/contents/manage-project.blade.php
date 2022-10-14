<x-layout title="mynage-project">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header  />
    <x-manage-project :project_data=$projects_data  />
    <x-footer />
</x-layout>