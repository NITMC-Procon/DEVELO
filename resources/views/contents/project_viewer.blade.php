<x-layout title="manage-course">
    <x-slot name="styles">
        @vite([
            'resources/css/columns.css',
        ])
    </x-slot>
    <x-header  />
    <div style="display: flex;"> 
        <x-project-view :project_data=$project_data></x-project-view>
        <x-course-view :course_data=$course_data></x-course-view>
    </div>
    
    <x-footer />
</x-layout>