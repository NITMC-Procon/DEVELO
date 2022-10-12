<x-layout title="updata-diary">
    <x-slot name="styles">
        @vite([
        ])
    </x-slot>
    <x-header/>
    <x-updata-diary main_title="開発日誌" mode="update" :project_diary=$project_diary></x-updata-diary>
    <x-footer />
</x-layout>