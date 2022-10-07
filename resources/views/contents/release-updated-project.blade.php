<x-layout title="release-project">
    <x-slot name="styles">
        @vite([
        ])
    </x-slot>
    <x-header  />
    <x-release-updated-project :data=$data  />
    <x-footer />
</x-layout>