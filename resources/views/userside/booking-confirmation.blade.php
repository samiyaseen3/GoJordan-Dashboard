<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-custom-orange {
            background-color: #F15A29;
        }
        .text-custom-orange {
            color: #F15A29;
        }
        .hover\:bg-custom-orange-dark:hover {
            background-color: #d94e21;
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 p-8 text-center border-b">
                    <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-check text-custom-orange text-3xl"></i>
                    </div>
                    <h2 class="mt-4 text-3xl font-bold text-gray-900">Booking Confirmed!</h2>
                    <p class="mt-2 text-lg text-gray-600">Thank you for choosing our service</p>
                </div>

                <div class="p-8">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b">
                            <div class="text-sm text-gray-500">Booking Reference</div>
                            <div class="text-lg font-semibold">#{{ $booking->id }}</div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-map-marker-alt text-custom-orange text-xl"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Tour</div>
                                    <div class="font-medium">{{ $booking->tour->title }}</div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <i class="far fa-calendar text-custom-orange text-xl"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Date</div>
                                    <div class="font-medium">{{ \Carbon\Carbon::parse($booking->tour_date->date)->format('D, d M Y') }}</div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <i class="fas fa-users text-custom-orange text-xl"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Guests</div>
                                    <div class="font-medium">{{ $booking->number_of_guests }} {{ Str::plural('person', $booking->number_of_guests) }}</div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <i class="far fa-credit-card text-custom-orange text-xl"></i>
                                <div>
                                    <div class="text-sm text-gray-500">Payment Method</div>
                                    <div class="font-medium">{{ $booking->payment_method }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-6">
                    <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('userside.profile') }}" 
                           class="inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-custom-orange hover:bg-custom-orange-dark transition duration-150">
                            View My Bookings
                        </a>
                        <a href="{{ route('userside.index') }}" 
                           class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 rounded-lg text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>