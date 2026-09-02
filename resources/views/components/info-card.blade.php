@props(['route', 'icon', 'title', 'text'])

<a href="{{ $route }}" class="block p-6 bg-white dark:bg-gray-800 shadow rounded hover:shadow-md">
    <div class="flex items-center">
        <svg class="w-8 h-8 text-indigo-500 mr-4"><use href="#{{ $icon }}"/></svg>
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $text }}</p>
        </div>
    </div>
</a>
