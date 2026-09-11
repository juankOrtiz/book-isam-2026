<div class="relative inline-block text-left" data-dropdown>
    <div>
        <button type="button" class="flex items-center p-2 text-gray-500 hover:text-gray-600 focus:outline-none"
            data-dropdown-button aria-haspopup="true" aria-expanded="true">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            @if(auth()->user()->unreadNotifications->count())
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-600"></span>
            @endif
        </button>
    </div>

    <div data-dropdown-panel
        class="dropdown-panel absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
        role="menu" aria-orientation="vertical" aria-labelledby="notification-button">
        <div class="py-1" role="none">
            @forelse (auth()->user()->unreadNotifications as $notification)
                <div
                    class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ !$notification->read_at ? 'bg-gray-200' : '' }}">
                    <span>{{ $notification->data['message'] }}</span>
                    <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>

                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST"
                        class="flex items-center justify-end pr-2">
                        @csrf
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <button type="submit" class="text-xs text-gray-500 hover:text-gray-700 focus:outline-none">
                            Marcar como leído
                        </button>
                    </form>
                </div>
            @empty
                <div class="px-4 py-2 text-sm text-gray-700">No tienes notificaciones sin leer.</div>
            @endforelse
        </div>
        <div class="border-t border-gray-200">
            <div class="px-4 py-2 text-sm text-gray-500 text-center">
                <a href="#" class="hover:text-blue-600">Ver todo</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('[data-dropdown]');

        dropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('[data-dropdown-button]');
            const panel = dropdown.querySelector('[data-dropdown-panel]');

            button.addEventListener('click', () => {
                const isOpen = !panel.classList.contains('hidden');

                // Cierra todos los demás dropdowns antes de abrir el actual
                document.querySelectorAll('[data-dropdown-panel]').forEach(otherPanel => {
                    if (otherPanel !== panel && !otherPanel.classList.contains('hidden')) {
                        otherPanel.classList.classList.add('hidden');
                    }
                });

                // Alterna la visibilidad del dropdown actual
                panel.classList.toggle('hidden', isOpen);
            });
        });

        // Cierra cualquier dropdown si se hace clic fuera del botón o el panel
        window.addEventListener('click', (event) => {
            dropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('[data-dropdown-button]');
                const panel = dropdown.querySelector('[data-dropdown-panel]');

                if (!button.contains(event.target) && !panel.contains(event.target)) {
                    panel.classList.add('hidden');
                }
            });
        });
    });

</script>
