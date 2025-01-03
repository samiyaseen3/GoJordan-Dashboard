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
                <h2 class="mb-4" style="color: #000; font-weight: bold">Tour Information</h2>
                
                <!-- Toggle Buttons -->
                <div class="toggle-buttons mb-4">
                    <button class="btn btn-toggle active" data-target="booking-content">
                        <i class="fas fa-calendar-alt mr-2"></i>Book Tour
                    </button>
                    <button class="btn btn-toggle" data-target="reviews-content">
                        <i class="fas fa-star mr-2"></i>Reviews
                    </button>
                </div>
            </div>
        </div>

        <!-- Booking Content -->
        <div id="booking-content" class="toggle-content active">
            @if($tour->dates->isEmpty()) 
                <div class="alert alert-warning text-center" role="alert">
                    There is no booking for this tour.
                </div>
            @else
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
                                <td data-label="Start Date">
                                    <p class="mb-3">{{ \Carbon\Carbon::parse($tourDate->start_date)->format('l, d M, Y') }}</p>
                                </td>
                                <td data-label="End Date">
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

        <!-- Reviews Content -->
        <div id="reviews-content" class="toggle-content">
            @if($tour->reviews->count() > 0)
                <div class="row">
                    <!-- Reviews Summary -->
                    <div class="col-md-4 mb-4">
                        <div class="reviews-summary bg-white p-4 rounded shadow-sm">
                            <h4 class="mb-3">Reviews Overview</h4>
                            @php
                                $avgRating = $tour->reviews->avg('rating');
                                $totalReviews = $tour->reviews->count();
                            @endphp
                            <div class="average-rating mb-3">
                                <div class="display-4 text-warning">{{ number_format($avgRating, 1) }}</div>
                                <div class="stars mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= round($avgRating) ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <div class="text-muted">{{ $totalReviews }} {{ Str::plural('review', $totalReviews) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="col-md-8">
                        <div class="reviews-list">
                            @foreach($tour->reviews as $review)
                                <div class="review-card bg-white p-4 rounded shadow-sm mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="mb-1">{{ $review->user->name }}</h5>
                                            <div class="stars mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-0">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <h4>No reviews yet</h4>
                    <p>Be the first to review this tour!</p>
                </div>
            @endif

            <!-- Review Form -->
            @auth
                <div class="review-form mt-4 bg-white p-4 rounded shadow-sm">
                    <h4>Write a Review</h4>
                    <form id="reviewForm" action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                        
                        <div class="form-group">
                            <label>Rating</label>
                            <div class="rating-input mb-3">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" title="{{ $i }} stars">
                                        <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">Your Review</label>
                            <textarea class="form-control" name="comment" rows="4" required 
                                      placeholder="Share your experience with this tour"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            @else
                <div class="alert alert-info mt-4">
                    Please <a href="{{ route('user.login') }}">login</a> to write a review.
                </div>
            @endauth
        </div>
    </div>
</section>

<!-- Mobile View -->
<div class="mobile-view d-md-none">
    @foreach($tour->dates as $tourDate)
    <div class="tour-card">
        <div class="date-info">
            <div class="date-label">Start Date</div>
            <div class="date-value">{{ \Carbon\Carbon::parse($tourDate->start_date)->format('l, d M, Y') }}</div>
            
            <div class="date-label mt-3">End Date</div>
            <div class="date-value">{{ \Carbon\Carbon::parse($tourDate->end_date)->format('l, d M, Y') }}</div>
        </div>

        <div class="price-info mt-3">
            <div class="price">{{ $tour->price }} JOD</div>
        </div>

        <div class="availability-info">
            <div class="availability">Only {{ $tourDate->availability }} places left</div>
        </div>

        @if(auth()->check())
            @if($tourDate->availability > 0)
                <a href="{{ route('booking.page', ['tour_id' => $tour->id, 'tour_date_id' => $tourDate->id]) }}" 
                   class="btn btn-primary btn-book">Book Now</a>
            @else
                <button class="btn btn-secondary btn-book" disabled>Fully Booked</button>
            @endif
        @else
            @if($tourDate->availability > 0)
                <button class="btn btn-primary btn-book" 
                        onclick="showLoginAlert({{ $tour->id }}, {{ $tourDate->id }})">Book Now</button>
            @else
                <button class="btn btn-secondary btn-book" disabled>Fully Booked</button>
            @endif
        @endif
    </div>
    @endforeach
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Similar Tours</span>
                <h2 class="mb-4" style="color: #000">More {{ $tour->category->name }} Tours</h2>
            </div>
        </div>

        <!-- Tour Listing -->
        <div class="row">
            @foreach($similarTours as $similarTour)
            <div class="col-md-4 ftco-animate tour-card">
                <div class="project-wrap">
                    <div id="carousel{{ $similarTour->id }}" class="carousel slide carousel-wrapper" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($similarTour->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . ($image->file_name ?? 'default.jpg')) }}"
                                    class="d-block w-100 img" alt="Tour Image">
                                <span class="carousel-price">${{ $similarTour->price }}/person</span>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel{{ $similarTour->id }}" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $similarTour->id }}" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="text p-4">
                        <span class="days">{{ $similarTour->duration }} Days</span>
                        <h3><a href="{{ route('tour.details', ['id' => $similarTour->id]) }}">{{ $similarTour->title }}</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> {{ $similarTour->category->name ?? 'Uncategorized' }}</p>
                        <a href="{{ route('tour.details', ['id' => $similarTour->id]) }}" class="btn btn-primary">View Tour</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



<!-- Styles for Book Your Tour Section -->
<style>

.carousel-item .img {
        height: 300px;
        object-fit: cover;
    }

    .carousel-price {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #f15d30;
        color: #fff;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        font-weight: bold;
    }

    .carousel-wrapper {
        position: relative;
        overflow: hidden;
    }

    .project-wrap {
        margin-bottom: 30px;
    }
    #book-your-tour {
        background: linear-gradient(135deg, #FA4032, #FA812F);
        padding: 4rem 0;
    }

    .heading-section h2 {
        font-size: 3rem;
        font-weight: 800;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        margin-bottom: 3rem;
    }

    table {
        width: 100%;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    th {
        background-color: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
        text-transform: uppercase;
        padding: 1.5rem;
        border-bottom: 2px solid #eee;
    }

    td {
        padding: 1.2rem;
        color: #2c3e50;
        border-bottom: 1px solid #eee;
    }

    td p {
        margin: 0;
    }

    .price {
        color: #FA4032;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .availability {
        font-size: 0.95rem;
    }

    .availability span {
        color: #FA4032;
        font-size: 1.1rem;
    }

    .btn-primary {
        background: linear-gradient(45deg, #FA4032, #FA812F);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(250, 64, 50, 0.3);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        opacity: 0.9;
    }

    .alert {
        border-radius: 10px;
        padding: 1.5rem;
    }

    @media (max-width: 767px) {
        .heading-section h2 {
            font-size: 2rem;
        }

        td, th {
            padding: 1rem 0.5rem;
        }

        .btn {
            padding: 0.6rem 1rem;
        }
    }

    /* Responsive styles for Book Your Tour section */
@media screen and (max-width: 992px) {
 table {
   width: 100%;
 }
 
 th, td {
   padding: 12px 8px;
   font-size: 14px;
 }
 
 .btn {
   padding: 8px 15px;
   font-size: 14px;
 }

 .price, .availability span {
   font-size: 14px; 
 }
}

@media (max-width: 768px) {
    #book-your-tour {
        padding: 2rem 1rem;
    }
    
    .tour-card {
        background: white;
        border-radius: 15px;
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .table {
        display: none;
    }

    .mobile-view {
        display: block;
    }

    .date-info, .price-info, .availability-info {
        margin-bottom: 12px;
    }

    .date-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .date-value {
        color: #666;
    }

    .price {
        color: #FA4032;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .availability {
        color: #333;
    }

    .btn-book {
        width: 100%;
        padding: 12px;
        border-radius: 25px;
        margin-top: 10px;
    }
}

.toggle-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.btn-toggle {
    padding: 0.75rem 2rem;
    border: 2px solid #FA4032;
    background: transparent;
    color: #FA4032;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-toggle.active {
    background: linear-gradient(45deg, #FA4032, #FA812F);
    color: white;
    border-color: transparent;
}

.btn-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(250, 64, 50, 0.2);
}

.toggle-content {
    display: none;
}

.toggle-content.active {
    display: block;
    animation: fadeIn 0.5s ease;
}

.rating-input {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}

.rating-input input {
    display: none;
}

.rating-input label {
    cursor: pointer;
    width: 25px;
    font-size: 25px;
    color: #ddd;
    margin: 0 2px;
}

.rating-input label:before {
    content: '\f005';
    font-family: 'Font Awesome 5 Free';
}

.rating-input input:checked ~ label,
.rating-input label:hover,
.rating-input label:hover ~ label {
    color: #ffd700;
}

.stars {
    color: #ffd700;
}

.review-card {
    transition: transform 0.2s ease;
}

.review-card:hover {
    transform: translateY(-2px);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@media (max-width: 768px) {
    .toggle-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-toggle {
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
            // Add these IDs as query parameters
            window.location.href = `/user/login?tour_id=${tourId}&tour_date_id=${tourDateId}`;
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

    document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.btn-toggle');
    const contents = document.querySelectorAll('.toggle-content');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and contents
            toggleButtons.forEach(btn => btn.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            const targetContent = document.getElementById(this.dataset.target);
            targetContent.classList.add('active');
        });
    });
});

$(document).ready(function() {
    // Add click event listener to the submit button
    $('.review-form button[type="submit"]').on('click', function(e) {
        e.preventDefault();
        
        // Check if rating is selected
        let rating = $('input[name="rating"]:checked').val();
        
        if (!rating) {
            Swal.fire({
                title: 'Rating Required',
                text: 'Please select a rating before submitting your review',
                icon: 'warning',
                confirmButtonColor: '#FA4032',
                confirmButtonText: 'OK'
            });
            return false;
        }
        
        // If rating exists, submit the form
        $('#reviewForm').submit();
    });

    // Handle the actual form submission
    $('#reviewForm').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let url = form.attr('action');
        let formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Review Submitted!',
                        text: 'Your review has been submitted and is pending admin approval. It will be visible once approved.',
                        icon: 'success',
                        confirmButtonColor: '#FA4032',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Clear the form
                        form.trigger('reset');
                        // Optionally reload the reviews section
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Something went wrong while submitting your review.',
                        icon: 'error',
                        confirmButtonColor: '#FA4032',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Something went wrong while submitting your review.';
                
                // Check if there's a specific error message from the server
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Handle validation errors
                    errorMessage = Object.values(xhr.responseJSON.errors)[0][0];
                }
                
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonColor: '#FA4032',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
    </script>

</body>
@endsection