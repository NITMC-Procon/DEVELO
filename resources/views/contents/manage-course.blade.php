<x-layout title="manage-course">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header  />
    <x-manage-course :project_data=$project_data  />
    <x-footer />
</x-layout>