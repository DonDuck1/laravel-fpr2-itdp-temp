<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Organisation -->
        <div class="mt-4">
            <x-input-label for="organisation" :value="__('Organisation')" />
            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="organisation" name="organisation">
                <option value="" selected disabled hidden>-- Choose an organisation --</option>
                @foreach($organisations as $organisation)
                    <option {{ old('organisation') == $organisation->name ? "selected" : "" }} value="{{ $organisation->name }}">{{ $organisation->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('organisation')" class="mt-2" />
        </div>

        <!-- Organisation -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="role" name="role">
                <option value="" selected disabled hidden>-- Choose a role --</option>
                @foreach($roles as $role)
                    @if($role->id !== App\Models\Role::IS_ADMIN)
                        <option {{ old('role') == $role->name ? "selected" : "" }} value="{{ $role->name }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('dashboard') }}">
                {{ __('Back to dashboard?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
