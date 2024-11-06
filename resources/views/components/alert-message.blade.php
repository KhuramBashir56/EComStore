<div id="alert" class="hidden fixed right-4 bottom-0 z-50 mb-4 max-w-lg ml-4 rounded-md   border-l-[13px] p-4" role="alert">
    <div class="flex gap-x-4 items-center">
        <div id="icon-wrapper" class="flex w-fit aspect-square items-center justify-center rounded-full text-white p-1">
            <span id="alert-icon" class="material-symbols-outlined text-4xl font-extrabold"></span>
        </div>
        <div class="flex w-full flex-col">
            <h3 class="text-lg font-medium test-2xl" id="alert-title"></h3>
            <p class="text-body-color text-sm" id="alert-message"></p>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        document.addEventListener('livewire:init', () => {
            Livewire.on('alert', (event) => {
                const alert = document.getElementById('alert');
                document.getElementById('alert-message').innerHTML = event.message;
                const icon_wrapper = document.getElementById('icon-wrapper');
                const icon = document.getElementById('alert-icon');
                const alert_title = document.getElementById('alert-title');
                if (event.type == 'success') {
                    alert.classList.add('bg-green-200', 'border-l-green-500');
                    icon_wrapper.classList.add('bg-green-500');
                    icon.innerHTML = 'check';
                    alert_title.innerHTML = 'Operation Successful!'
                } else if (event.type == 'error') {
                    alert.classList.add('bg-red-200', 'border-l-red-500');
                    icon_wrapper.classList.add('bg-red-500');
                    icon.innerHTML = 'close';
                    alert_title.innerHTML = 'Error! Something Wrong';
                } else if (event.type == 'warning') {
                    alert.classList.add('bg-amber-200', 'border-l-amber-500');
                    icon_wrapper.classList.add('bg-amber-500');
                    icon.innerHTML = 'error';
                    alert_title.innerHTML = 'Warning! Something Wrong';
                }

                alert.classList.remove('hidden');
                setTimeout(() => {
                    alert.classList.add('hidden');
                    alert.classList.remove('bg-green-200', 'border-l-green-500', 'bg-red-200', 'border-l-red-500', 'bg-amber-200', 'border-l-amber-500');
                    icon_wrapper.classList.remove('bg-green-500', 'bg-red-500', 'bg-amber-500');
                }, 5000);
            });
        });
    </script>
@endpush
