<x-guest-layout>
    <!-- Main Container -->
    <div class="moving-gradient min-h-[80vh] flex items-center justify-center p-4">
        <!-- Background Shapes (Optional - Can remove for simplicity) -->
        <div class="animated-shape bg-orange-300 w-72 h-72 top-0 left-0"></div>
        <div class="animated-shape bg-amber-300 w-56 h-56 bottom-0 right-0"></div>
        <div class="animated-shape bg-red-300 w-40 h-40 bottom-0 left-0"></div>

        <!-- Login Card -->
        <div class="login-card rounded-3xl p-6 w-full max-w-md relative">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <svg width="140" height="56" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                    <path d="M40 20 L60 60 L20 60 Z" fill="#d97706" />
                    <circle cx="50" cy="35" r="8" fill="#fb923c" />
                    <text x="80" y="50" font-family="Arial" font-weight="bold" font-size="24" fill="#d97706">GoJordan</text>
                </svg>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf
                <div class="space-y-3">
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium mb-1" />
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="input-field w-full px-4 py-3 rounded-xl bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium mb-1" />
                        <x-text-input 
                            id="password" 
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            class="input-field w-full px-4 py-3 rounded-xl bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <!-- Remember Me -->
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="rounded border-gray-300 text-amber-600 focus:ring-amber-500"
                        >
                        <span class="text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-amber-600 hover:text-amber-700 font-medium">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-primary-button class="login-btn w-full py-3 rounded-xl text-white font-semibold focus:outline-none bg-gradient-to-r from-amber-600 to-amber-700">
                    {{ __('Log in') }}
                </x-primary-button>

                <p class="text-center text-gray-600 text-sm mt-2">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-amber-600 font-semibold hover:text-amber-700">Sign up now</a>
                </p>
            </form>
        </div>
    </div>

    <style>
        .moving-gradient {
            background: linear-gradient(220deg, #fca5a5, #fdba74, #fcd34d);
            background-size: 180% 180%;
        }

        .animated-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            border: 2px solid transparent;
        }

        .input-field:focus {
            border-color: #d97706;
            box-shadow: 0 0 0 4px rgba(217, 119, 6, 0.1);
        }

        .login-btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2);
        }
    </style>
</x-guest-layout>
