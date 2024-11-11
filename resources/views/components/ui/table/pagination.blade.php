@if ($paginator->hasPages())
    <div class="flex justify-between items-center uppercase sm:grid-cols-9 print:hidden">
        <div class="flex justify-between w-full md:hidden">
            @if ($paginator->onFirstPage())
                <button type="button" disabled class="flex justify-center items-center ps-1.5 pe-3 py-1 gap-1 transition-colors duration-500 text-gray-500 cursor-not-allowed" title="Previous">
                    <span class="material-symbols-outlined">first_page</span>
                    <span>Previous</span>
                </button>
            @else
                <button type="button" wire:click="previousPage" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" class="flex justify-center items-center ps-1.5 pe-3 py-1 gap-1 rounded-md text-white transition-colors duration-500 bg-primary-500 dark:bg-secondary-500 hover:bg-primary-700 dark:hover:bg-secondary-700" title="Previous">
                    <span class="material-symbols-outlined">keyboard_double_arrow_left</span>
                    <span>Previous</span>
                </button>
            @endif
            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" class="flex justify-center items-center ps-3 pe-1.5 py-1 gap-1 rounded-md text-white transition-colors duration-500 bg-primary-500 dark:bg-secondary-500 hover:bg-primary-700 dark:hover:bg-secondary-700" title="Next">
                    <span>Next</span>
                    <span class="material-symbols-outlined">keyboard_double_arrow_right</span>
                </button>
            @else
                <button type="button" disabled class="flex justify-center items-center ps-3 pe-1.5 py-1 gap-1 transition-colors duration-500 text-gray-500 cursor-not-allowed" title="Next">
                    <span>Next</span>
                    <span class="material-symbols-outlined">last_page</span>
                </button>
            @endif
        </div>

        <div class="lg:block hidden capitalize text-gray-900 dark:text-gray-400">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }}
                {!! __('to') !!}
                {{ $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            {{ $paginator->total() }}
        </div>

        <ul class="md:flex hidden justify-center items-center gap-1 lg:w-fit md:w-full w-fit">
            <li>
                @if ($paginator->onFirstPage())
                    <button type="button" disabled class="flex justify-center items-center p-1 text-gray-500 transition-colors duration-500 cursor-not-allowed" title="Previous">
                        <span class="material-symbols-outlined">keyboard_arrow_left</span>
                    </button>
                @else
                    <button type="button" wire:click="previousPage" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" class="flex justify-center items-center p-1 transition-colors duration-500 bg-transparent text-primary-500 dark:text-secondary-500 hover:text-white dark:hover:text-gray-200 hover:bg-primary-700 dark:hover:bg-secondary-700 rounded-md" title="Previous">
                        <span class="material-symbols-outlined">keyboard_double_arrow_left</span>
                    </button>
                @endif
            </li>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="flex items-center">
                        <span class="px-2 mb-2 text-gray-500 font-extrabold leading-none">{{ $element }}</span>
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <button type="button" disabled class="flex justify-center items-center px-2.5 py-1 transition-colors duration-500 bg-primary-500 dark:bg-secondary-500 text-white dark:text-gray-200 rounded-md cursor-not-allowed">
                                    {{ $page }}
                                </button>
                            </li>
                        @else
                            <li>
                                <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" class="flex justify-center items-center px-2.5 py-1 transition-colors duration-500 bg-transparent text-primary-500 dark:text-secondary-500 hover:text-white dark:hover:text-gray-200 hover:bg-primary-700 dark:hover:bg-secondary-700 rounded-md">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li>
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage" wire:loading.attr="disabled" wire:offline.attr="disabled" wire:loading.class="cursor-wait" class="flex justify-center items-center p-1 transition-colors duration-500 bg-transparent text-primary-500 dark:text-secondary-500 hover:text-white dark:hover:text-gray-200 hover:bg-primary-700 dark:hover:bg-secondary-700 rounded-md" title="Next">
                        <span class="material-symbols-outlined">keyboard_double_arrow_right</span>
                    </button>
                @else
                    <button type="button" disabled class="flex justify-center items-center p-1 text-gray-500 transition-colors duration-500 cursor-not-allowed" title="Next">
                        <span class="material-symbols-outlined">keyboard_arrow_right</span>
                    </button>
                @endif
            </li>
        </ul>
    </div>
@endif
