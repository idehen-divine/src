<div x-data="{ show: false, message: '', type: '' }" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2" x-init="$wire.on('notification', data => {
        message = data[0].message;
        type = data[0].type;
        show = true;
        setTimeout(() => show = false, 5000);
    });"
    :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
    class="fixed top-5 right-5 text-white px-4 py-3 rounded shadow-lg" role="alert">
    <span x-text="message"></span>
</div>

@script
<script>
    $wire.on('redirect', (event) => {
        window.location.href = event.url;
    });
</script>
@endscript
