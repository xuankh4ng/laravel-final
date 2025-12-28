@props(['route', 'activeRoute'])

@php
    $isActive = request()->routeIs($activeRoute ?? $route);
    $classes = $isActive ? 'bg-ef-bg-4 text-ef-green' : 'text-ef-fg hover:bg-ef-bg-3 hover:text-ef-blue';
    $iconClasses = $isActive ? 'text-ef-green' : 'text-ef-grey-1 group-hover:text-ef-blue';
@endphp

<a href="{{ route($route) }}"
    {{ $attributes->merge(['class' => 'flex items-center px-4 py-2.5 rounded-md font-medium transition-all group ' . $classes]) }}>
    <div class="{{ $iconClasses }} mr-3 transition-colors">
        {{ $icon }}
    </div>
    <span>{{ $slot }}</span>
</a>
