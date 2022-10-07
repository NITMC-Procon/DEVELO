@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('入力内容が間違っています。') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
        </ul>
    </div>
@endif
