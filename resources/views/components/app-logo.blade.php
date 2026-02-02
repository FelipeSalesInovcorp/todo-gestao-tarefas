@props([
    'sidebar' => false,
])

@php
    $appName = config('app.name');
@endphp

@if ($sidebar)
    <flux:sidebar.brand name="{{ $appName }}" {{ $attributes }}>
        <x-slot name="logo">
            <div
                class="flex aspect-square size-10 items-center justify-center rounded-xl
                    bg-white/70 p-1.5 shadow-sm ring-1 ring-zinc-200
                    dark:bg-zinc-900/60 dark:ring-zinc-800">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="{{ $appName }} logo"
                    class="h-full w-full object-contain"
                >
            </div>
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="{{ $appName }}" {{ $attributes }}>
        <x-slot name="logo">
            <div
                class="flex aspect-square size-8 items-center justify-center rounded-xl
                       bg-white/70 p-1.5 shadow-sm ring-1 ring-zinc-200
                       dark:bg-zinc-900/60 dark:ring-zinc-800">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="{{ $appName }} logo"
                    class="h-full w-full object-contain"
                >
            </div>
        </x-slot>
    </flux:brand>
@endif
