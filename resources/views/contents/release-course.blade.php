<x-layout title="release-course">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    @php
        $project_data = $data['project'];
        $course_data = $data['course'];
    @endphp
    <x-header  />
    <x-release-course :data=$data/>
    <x-footer />
</x-layout>