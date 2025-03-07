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
        {{ __('Esta es una zona segura de la aplicación. Confirme su contraseña antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
