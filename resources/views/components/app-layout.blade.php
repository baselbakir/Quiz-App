{{-- resources/views/components/app-layout.blade.php --}}
@props(['header'])

<x-layouts.app>
    @isset($header)
        <x-slot name="header">
            {{ $header }}
        </x-slot>
    @endisset

    @yield('content')

</x-layouts.app>
