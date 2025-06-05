<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Terlupa kata laluan anda? Tiada masalah. Hanya beritahu kami alamat e-mel anda dan kami akan menghantar e-mel kepada anda pautan tetapan semula kata laluan yang membolehkan anda memilih yang baharu.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-Mel')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Hantar Pautan Tetapan Semula Kata Laluan E-mel') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
