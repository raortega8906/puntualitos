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
        {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no lo hiciste,\'si no recibe el correo electrónico, con gusto le enviaremos otro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Reenviar correo electrónico de verificación') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Finalizar la sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>
