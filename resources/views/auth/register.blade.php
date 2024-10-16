<x-guest-layout>

    <div class="flex items-center justify-center mb-4">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500 "/>
        </a>
    </div>

    <div class="mb-4">
        <h1 class="text-3xl font-bold text-center text-green-800 mb-6" data-id="5">
            {{ __('Puntualitos') }}
        </h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="first_name" :value="__('Nombre')"/>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                          :value="old('first_name')" required autofocus autocomplete="first_name"/>
            <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Apellidos')"/>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                          :value="old('last_name')" required autofocus autocomplete="last_name"/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
        </div>

    {{--        <!-- Departments -->--}}
    {{--        <div class="mt-4">--}}
    {{--            <x-input-label for="departments" :value="__('Departments')" />--}}
    {{--            <x-text-input id="departments" class="block mt-1 w-full" type="text" name="departments" :value="old('departments')" required autofocus autocomplete="departments" />--}}
    {{--            <x-input-error :messages="$errors->get('departments')" class="mt-2" />--}}
    {{--        </div>--}}

        <!-- Departments -->
        <div class="mt-4">
            <x-input-label for="departments" :value="__('Departmentos')" />
            <select id="departments" name="departments" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required autofocus>
                <option value="0" disabled selected></option>
                <option value="Desarrollo">Desarrollo</option>
                <option value="Cuentas">Cuentas</option>
                <option value="Diseño">Diseño</option>
                <option value="Vídeo">Vídeo</option>
                <option value="RRHH">RRHH</option>
            </select>
            <x-input-error :messages="$errors->get('departments')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registro') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
