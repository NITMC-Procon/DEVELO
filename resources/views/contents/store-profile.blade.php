<x-layout title="store-profile">
    <x-slot name="styles">
        @vite([
        ])
    </x-slot>
    <x-header  />
    <x-store-profile :profile=$profile  />
    <x-footer />
</x-layout>