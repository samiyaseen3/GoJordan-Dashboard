<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('assets_userside/images/wadi_rum.jpg') }}');">

    <!-- Main Container -->
    <div class="login-card rounded-3xl p-6 w-full max-w-lg relative bg-white backdrop-filter backdrop-blur-md border border-gray-200 shadow-lg mt-12 mb-12">
        <!-- Logo Section -->
        <div class="flex justify-center mb-6">
            <svg width="140" height="56" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                <path d="M40 20 L60 60 L20 60 Z" fill="#d97706" />
                <circle cx="50" cy="35" r="8" fill="#fb923c" />
                <text x="80" y="50" font-family="Arial" font-weight="bold" font-size="24" fill="#d97706">GoJordan</text>
            </svg>
        </div>

        <!-- Error Message -->
        @if (session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
            {{ session('error') }}
        </div>
        @endif

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    placeholder="Enter your full name" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    placeholder="Enter your email" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-gray-700 font-medium mb-1">Gender</label>
                <select 
                    id="gender" 
                    name="gender" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
                    <option value="" disabled selected>Choose Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <!-- City -->
            <div>
                <label for="city" class="block text-gray-700 font-medium mb-1">City</label>
                <input 
                    id="city" 
                    type="text" 
                    name="city" 
                    placeholder="Enter your city" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
                <input 
                    id="phone" 
                    type="tel" 
                    name="phone" 
                    placeholder="Enter your phone number" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="Confirm your password" 
                    required 
                    class="input-field w-full px-4 py-3 rounded-lg bg-gray-50 text-gray-800 placeholder-gray-400 border-2 border-transparent focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                >
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="login-btn w-full py-3 rounded-lg bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold hover:from-orange-600 hover:to-amber-600 transition-all">
                Register
            </button>

            <!-- Back to Home Link -->
            

            <!-- Back to Login Link -->
            <p class="text-center text-gray-600 text-sm mt-2 flex justify-center items-center">
                Already have an account? 
                <a href="{{ route('user.login') }}" class="text-orange-600 font-semibold hover:text-orange-700 ml-2">
                    Log in here
                </a>
                <span class="mx-2">|</span> <!-- Separator -->
                <a href="{{ route('userside.index') }}" class="text-orange-600 font-semibold hover:text-orange-700 ml-2">
                    Back to Home
                </a>
            </p>
        </form>
    </div>

    <!-- Styles -->
    <style>
        .login-card {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .login-btn {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 137, 38, 0.2);
        }
    </style>
</body>
</html>
