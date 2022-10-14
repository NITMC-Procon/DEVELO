<x-layout title="manage-course">
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
    <x-project-view :project_data=$project_data></x-project-view>
    <x-course-view :course_data=$course_data></x-course-view>
    <x-footer />
</x-layout>