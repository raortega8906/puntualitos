<x-guest-layout>

    <div class="flex items-center justify-center mb-4">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500 " />
        </a>
    </div>

    <div class="mb-4">
            <h1 class="text-3xl font-bold text-center text-green-800 mb-6" data-id="5">
                {{ __('Puntualitos') }}
            </h1>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enlace de restablecimiento') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
