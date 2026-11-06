@props(['message'])

<div data-toast role="status" aria-live="polite" class="toast toast-hidden fixed left-4 right-4 top-4 z-[100] mx-auto flex max-w-md items-start gap-3 rounded-2xl border border-green-200 bg-white p-4 text-sm text-gray-800 shadow-xl sm:left-auto sm:right-6 sm:top-6 dark:border-green-900 dark:bg-gray-900 dark:text-gray-100">
    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200" aria-hidden="true">
        <svg viewBox="0 0 20 20" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
            <path d="m5 10 3.2 3.2L15.5 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>
    <p class="flex-1 pt-1 font-semibold">{{ $message }}</p>
    <button type="button" data-toast-close aria-label="Tutup notifikasi" class="rounded-md p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-white">×</button>
</div>
