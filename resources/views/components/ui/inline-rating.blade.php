@props(['value'])
<div class="w-full flex items-center gap-1">
    <div class="flex items-center text-gray-400 dark:text-gray-500 relative">
        <span class="material-symbols-outlined text-[18px]">star</span>
        <span class="material-symbols-outlined text-[18px]">star</span>
        <span class="material-symbols-outlined text-[18px]">star</span>
        <span class="material-symbols-outlined text-[18px]">star</span>
        <span class="material-symbols-outlined text-[18px]">star</span>
        <div class="flex items-center text-yellow-400 absolute left-0 top-0 overflow-hidden" style="width: {{ $value * 20 }}%;">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
        </div>
    </div>
    <span class="text-gray-500 dark:text-gray-400 font-bold text-sm">{{ number_format($value, 1) }}</span>
</div>
