<x-layout title="create-project">
    <x-slot name="styles">
        @vite([
            "resources/css/create-project.css"
        ])
    </x-slot>
    <x-header  :name=$name :id=$id />
    <x-create-project />
    <x-footer />
</x-layout>