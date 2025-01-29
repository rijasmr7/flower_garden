<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Login') }}
        </h2>
    </x-slot>

    <div class="mt-4">
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="mt-4">
                <x-button>
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </div>
</x-guest-layout>