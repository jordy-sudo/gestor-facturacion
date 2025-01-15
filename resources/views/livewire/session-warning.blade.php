<div>
    <div x-data="{ timeRemaining: @entangle('timeRemaining'), showWarning: false }" x-init="
        setInterval(() => {
            if (timeRemaining > 0) {
                timeRemaining--;
                if (timeRemaining <= 300) {
                    showWarning = true;
                }
            }
        }, 1000);
    ">
        <!-- Mensaje de advertencia -->
        <div x-show="showWarning" class="fixed bottom-0 right-0 bg-yellow-500 text-white p-4 rounded-lg shadow-lg" x-transition>
            <p>Tu sesión está a punto de expirar. Por favor, renueva tu sesión para evitar ser desconectado.</p>
            <button @click="window.location.reload()" class="mt-2 bg-blue-500 px-4 py-2 rounded">
                Renovar sesión
            </button>
        </div>
    </div>
</div>
