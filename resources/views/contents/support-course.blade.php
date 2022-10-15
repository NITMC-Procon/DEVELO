<x-layout title="support-course">
    <x-slot name="styles">
        @vite([
            'resources/css/support-course.css',
            'resources/js/support-course.js',
        ])
    </x-slot>
    <x-header  />
    <x-support-course :course_data=$course_data :user_data=$user_data :pack=$pack />
    <x-footer />
</x-layout>