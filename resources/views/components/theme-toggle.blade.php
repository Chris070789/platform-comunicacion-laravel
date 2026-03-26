<button
    x-data
    x-init="
        $el.addEventListener('click', () => {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        })
    "
    type="button"
    class="p-2 rounded-md bg-gray-200 dark:bg-gray-800
           text-gray-800 dark:text-gray-100
           hover:bg-gray-300 dark:hover:bg-gray-700
           transition">
    <span class="dark:hidden">🌙</span>
    <span class="hidden dark:inline">☀️</span>
</button>
