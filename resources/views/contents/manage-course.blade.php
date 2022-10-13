<x-layout title="manage-course">
    <x-slot name="styles">
        @vite([
        ])
    </x-slot>
    <x-header  />
    <x-manage-course :course_data=$course_data  />
    <x-footer />
</x-layout>