<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GoJordan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-amber-50">
    <!-- Desert Pattern Overlay -->
    <div class="fixed inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+CiAgPHBhdGggZD0iTTUgNWg1MHY1MEg1eiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZjk3MzE2IiBzdHJva2Utb3BhY2l0eT0iMC4xIi8+Cjwvc3ZnPg==')] opacity-50"></div>

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="grid md:grid-cols-2 gap-0">
                <!-- Right Side - Image -->
                <div class="relative hidden md:block">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-600/90 to-amber-500/90 mix-blend-multiply"></div>
                    <img src="{{asset('assets_userside/images/petra.jpg')}}" alt="Jordan Tourism"
                        class="h-full w-full object-cover">
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-8">
                        <h2 class="text-2xl font-bold mb-3 text-center">Discover Jordan's Beauty</h2>
                        <p class="text-base text-center mb-5">Join us and explore the most beautiful tourist sites at the best prices</p>
                        <div class="grid grid-cols-2 gap-3 w-full max-w-md">
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-center">
                                <i class="fas fa-mountain text-xl mb-1"></i>
                                <p class="text-xs">Diverse Tourist Sites</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-center">
                                <i class="fas fa-dollar-sign text-xl mb-1"></i>
                                <p class="text-xs">Competitive Prices</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-center">
                                <i class="fas fa-car text-xl mb-1"></i>
                                <p class="text-xs">Organized Tours</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-center">
                                <i class="fas fa-hotel text-xl mb-1"></i>
                                <p class="text-xs">Comfortable Stay</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left Side - Form -->
                <!-- [Previous form content remains exactly the same] -->
                <div class="p-6">
                    <!-- Logo -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <svg width="140" height="56" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                                <path d="M40 20 L60 60 L20 60 Z" fill="#ea580c"/>
                                <circle cx="50" cy="35" r="8" fill="#fb923c"/>
                                <text x="80" y="50" font-family="Arial" font-weight="bold" font-size="24" fill="#ea580c">GoJordan</text>
                            </svg>
                            <div class="absolute -bottom-2 right-0 text-xs text-orange-600">Discover Jordan</div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        
                        <!-- Name Input Group -->
                        <div class="relative">
                            <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">Full Name</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="name" required
                                    class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm"
                                    placeholder="Enter your full name">
                            </div>
                        </div>

                        <!-- Email Input Group -->
                        <div class="relative">
                            <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" required
                                    class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm"
                                    placeholder="Enter your email">
                            </div>
                        </div>

                        <!-- Gender and City Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative">
                                <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">Gender</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-venus-mars"></i>
                                    </span>
                                    <select name="gender" required
                                        class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm appearance-none">
                                        <option value="" disabled selected>Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="relative">
                                <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">City</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-city"></i>
                                    </span>
                                    <input type="text" name="city" required
                                        class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm"
                                        placeholder="Enter your city">
                                </div>
                            </div>
                        </div>

                        <!-- Phone Input -->
                        <div class="relative">
                            <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">Phone Number</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="tel" name="phone" required
                                    class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm"
                                    placeholder="Enter your phone number">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="relative">
                            <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" required
                                    class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm"
                                    placeholder="Enter your password">
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="relative">
                            <label class="text-gray-700 text-xs font-semibold block mb-1 text-left">Confirm Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" required
                                    class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-left text-sm"
                                    placeholder="Confirm your password">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3 bg-gradient-to-l from-orange-600 to-amber-500 text-white rounded-xl font-bold text-base hover:from-orange-700 hover:to-amber-600 transition-all transform hover:-translate-y-1 hover:shadow-lg">
                            Create Account
                        </button>

                        <!-- Login Link -->
                        <p class="text-center text-gray-600 text-xs mt-4">
                            Already have an account? 
                            <a href="{{ route('user.login') }}" class="text-orange-600 font-semibold hover:text-orange-700">Login here</a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('userside.index') }}" class="text-orange-600 font-semibold hover:text-orange-700">
                                Back to Home
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        input::placeholder, select::placeholder {
            text-align: left;
        }
    </style>

   
</body>
</html>