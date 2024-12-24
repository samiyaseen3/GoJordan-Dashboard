@extends('userside.source.template')

@section('content')



<body style="background:#f8f8f8">
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight bg-cover bg-center bg-fixed" style="
        background-image: url('{{ asset('storage/' . ($tour->images->first()->file_name ?? 'default.jpg')) }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
    ">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-0 bread">{{ $tour->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation Tabs -->
    <section class="tour-nav sticky-nav">
        <div class="container">
            <ul class="nav nav-tabs border-0 justify-content-between">
                <li class="nav-item">
                    <a class="nav-link active" href="#summary-section">SUMMARY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#itinerary-section">ITINERARY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#booking-section">BOOK NOW</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="ftco-section" id="main-content">
        <div class="container">
            <div class="row">
                <!-- Left Column - Content -->
                <div class="col-lg-8">
                    <!-- Carousel Section -->
                    <div class="mb-4">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($tour->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset('storage/' . $image->file_name) }}"
                                        alt="Tour Image">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <!-- Content Sections -->
                    <div class="bg-white shadow-sm p-4 mb-4">
                        <!-- Summary Section -->
                        <div id="summary-section" class="mb-5">
                            <h2 class="mb-4">Summary</h2>
                            <p>{{ $tour->description }}</p>
                        </div>

                        <!-- Itinerary Section -->
                        <div id="itinerary-section">
                            <h2 class="mb-4">Itinerary</h2>
                            <div class="itinerary-list">
                                @foreach($tour->itineraries as $day => $detail)
                                    <div class="itinerary-day">
                                        <div class="day-header">
                                            <h3 class="mb-0 text-white">
                                                Day {{ $day + 1 }}: {{ $detail->title }}
                                                <span class="toggle-icon">+</span>
                                            </h3>
                                        </div>
                                        <div class="day-content">
                                            <p><span style="font-weight: bold">Location</span>: {{ $detail->location }}</p>
                                            <p><span style="font-weight: bold">Activity</span>: {{ $detail->activity }}</p>
                                            <p><span style="font-weight: bold">The Meal</span>: {{ $detail->meal_plan }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking Card -->
                <div class="col-lg-4">
                    <div id="booking-section" class="card shadow-sm sticky-booking">
                        <div class="card-body text-center">
                            <h3 class="card-title font-weight-bold">{{ $tour->title }}</h3>
                            <p class="card-text"><strong>DAYS:</strong> {{ $tour->duration }}</p>
                            <p class="card-text"><strong>PRICE (JOD):</strong> {{ $tour->price }}</p>
                            <a href="javascript:void(0);" class="btn btn-primary btn-block" id="dates-availability-btn">Dates & Availability</a> <!-- Added id here -->
                            <p class="card-text mt-3 mb-1">Have a question?</p>
                            <a href="{{route('userside.contact')}}" class="btn btn-secondary btn-block">CONTACT US</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Book Your Tour Section -->
<section class="ftco-section bg-light" id="book-your-tour">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section">
                <h2 class="mb-4" style="color: #fff; font-weight: bold">Book Your Tour</h2>
            </div>
        </div>

        @if($tour->dates->isEmpty()) 
            <!-- Display this message if there are no dates available for the tour -->
            <div class="alert alert-warning text-center" role="alert">
                There is no booking for this tour.
            </div>
        @else
            <!-- Display the table of dates if there are dates available -->
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tour->dates as $tourDate)
                        <tr>
                            <td>
                                <p class="mb-3">{{ \Carbon\Carbon::parse($tourDate->start_date)->format('l, d M, Y') }}</p>
                            </td>
                            <td>
                                <p class="mb-1">{{ \Carbon\Carbon::parse($tourDate->end_date)->format('l, d M, Y') }}</p>
                            </td>
                            <td>
                                <p class="price mb-1">{{ $tour->price }} JOD</p>
                            </td>
                            <td>
                                <p class="availability mb-3">Only <span style="font-weight: bold">{{ $tourDate->availability }}</span> places left</p>
                            </td>
                            <td>
                                @if(auth()->check())
                                    @if($tourDate->availability > 0)
                                        <a href="{{ route('booking.page', ['tour_id' => $tour->id, 'tour_date_id' => $tourDate->id]) }}" 
                                           class="btn btn-primary btn-block">Book Now</a>
                                    @else
                                        <button class="btn btn-secondary btn-block" disabled>Fully Booked</button>
                                    @endif
                                @else
                                    @if($tourDate->availability > 0)
                                        <button class="btn btn-primary btn-block" 
                                                onclick="showLoginAlert({{ $tour->id }}, {{ $tourDate->id }})">Book Now</button>
                                    @else
                                        <button class="btn btn-secondary btn-block" disabled>Fully Booked</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>



<!-- Styles for Book Your Tour Section -->
<style>
    #book-your-tour {
        background: linear-gradient( #FA4032 ,#FA812F ) !important;
    }
    table {
    width: 100%;
    margin-top: 20px;
    background-color: #fff;
    border-collapse: collapse; /* Ensures borders collapse to one */
}

th, td {
    padding: 15px;
    text-align: center;
    border: none; /* Removes the borders */
}

th {
    background-color: #fff;
    color: #000;
}

td h3 {
    margin-bottom: 5px;
}

.btn {
    width: 100%;
    padding: 10px;
}

@media (max-width: 767px) {
        #book-your-tour .container {
            padding: 0 15px;
        }

        .table th, .table td {
            padding: 10px;
        }

        .btn {
            padding: 12px;
        }

        /* Adjust the header font size for smaller screens */
        .heading-section h2 {
            font-size: 1.8rem;
        }

        /* Ensure the "Book Now" button is full width on mobile */
        .btn-block {
            width: 100%;
        }
    }
</style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hide all content initially
            $('.day-content').removeClass('active');

            // Handle click on day headers
            $('.day-header').click(function() {
                const content = $(this).next('.day-content');
                const icon = $(this).find('.toggle-icon');

                // Toggle the clicked content
                content.toggleClass('active');

                // Update the icon
                if (content.hasClass('active')) {
                    icon.text('−');
                } else {
                    icon.text('+');
                }
            });
        });

        // Smooth scrolling with active state management
        const navLinks = document.querySelectorAll('.tour-nav .nav-link');
        const sections = document.querySelectorAll('section[id], div[id]');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                // Remove active class from all links
                navLinks.forEach(link => link.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');

                // Smooth scroll to target
                targetSection.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Update active state on scroll
        window.addEventListener('scroll', () => {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        function showLoginAlert(tourId, tourDateId) {
    Swal.fire({
        title: 'Login Required',
        text: 'You must be logged in to book a tour.',
        icon: 'warning',
        confirmButtonText: 'Log In',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to login page and pass the tour and date IDs as query parameters
            window.location.href = "{{ route('user.login') }}?tour_id=" + tourId + "&tour_date_id=" + tourDateId;
        }
    });
}

    $(document).ready(function() {
        // When the "Dates & Availability" button is clicked, scroll to the booking section
        $('#dates-availability-btn').on('click', function() {
            $('html, body').animate({
                scrollTop: $('#book-your-tour').offset().top
            }, 1000); // Smooth scroll to the #book-your-tour section
        });

        // Handle the "Book Now" button for logged-in users
        $('#book-now-btn').on('click', function() {
            Swal.fire({
                title: 'You must be logged in to book a tour.',
                text: 'Please log in to continue.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Go to Login',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the login page if user clicks "Go to Login"
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        });
    });
    </script>

</body>
@endsection
