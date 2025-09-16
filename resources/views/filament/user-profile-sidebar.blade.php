<div class="flex items-center p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
         alt="Profile Picture"
         class="w-11 h-11 rounded-full ring-2 ring-primary-500 dark:ring-primary-400 shadow">

    <div class="ml-3">
        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
            {{ auth()->user()->name }}
        </p>
        <span class="text-xs text-gray-500 dark:text-gray-400">
            {{ auth()->user()->email ?? 'User' }}
        </span>
    </div>
</div>
