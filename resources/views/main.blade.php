<x-cons :name=$name :id=$id>
    <x-slot name="title">ホーム</x-slot>
    <x-slot name="styles">
        @vite([
            "resources/css/main.css",
        ])
    </x-slot>
    <x-homepage />
</x-cons>