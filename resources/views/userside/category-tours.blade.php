@extends('userside.source.template')
@section('content')

<style>
    /* Ensure all images in the carousel have the same size */
    .carousel-item img {
        height: 300px;
        /* Set the desired fixed height */
        object-fit: cover;
        /* Ensures the image covers the area without distortion */
    }

    /* Price styling - similar to your original style */
    .carousel-price {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #f15d30;
        /* Customize color */
        color: #fff;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        font-weight: bold;
    }

    /* Carousel Wrapper Styling */
    .carousel-wrapper {
        position: relative;
        overflow: hidden;
    }

    /* General Search Section */
    #tour-section {
        /* Light gray background */
        padding: 40px 0;
    }

    /* Label Styling */
    .search-wrap-1 label {
        font-size: 14px;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    /* Input Styling */
    .form-field .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
        font-size: 16px;
        color: #495057;
        padding-left: 40px;
        /* For the search icon spacing */
        height: 50px;
        transition: all 0.3s ease-in-out;
    }

    .form-field .form-control:focus {
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        border-color: #007bff;
    }

    /* Icon Styling */
    .form-field .icon i {
        font-size: 18px;
        color: #adb5bd;
        /* Muted gray */
    }

    /* Button Styling */
    .btn-primary {
        background-color: #f45b3c;
        /* Orange */
        border: none;
        transition: background-color 0.3s ease;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #e04e2b;
        /* Darker orange */
    }
</style>

<section class="hero-wrap hero-wrap-2 js-fullheight bg-cover bg-center bg-fixed" style="
        background-image: url('{{ asset('storage/' . $category->image) }}');
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
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{route('userside.index')}}">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span>{{$category->name}} <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">{{$category->name}}</h1>
            </div>
        </div>
    </div>
</section>








<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Tours</span>
                <h2 class="mb-4">Our {{$category->name}}</h2>
            </div>
        </div>

        <!-- Tour Listing -->
        <div class="row" id="tour-list">
            @foreach($tours as $tour)
            <div class="col-md-4 ftco-animate tour-card">
                <div class="project-wrap">
                    <div id="carousel{{ $tour->id }}" class="carousel slide carousel-wrapper" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($tour->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . ($image->file_name ?? 'default.jpg')) }}"
                                    class="d-block w-100" alt="Tour Image">
                                <span class="carousel-price">${{ $tour->price }}/person</span>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel{{ $tour->id }}" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $tour->id }}" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="text p-4">
                        <span class="days">{{ $tour->duration }} Days</span>
                        <h3><a href="{{ route('tour.details', ['id' => $tour->id]) }}">{{ $tour->title }}</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> {{ $tour->category->name ??
                            'Uncategorized' }}</p>
                        <a href="{{ route('tour.details', ['id' => $tour->id]) }}" class="btn btn-primary">View Tour</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                {{ $tours->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const tourList = document.getElementById('tour-list');
    let currentPage = 1;
    let isLoading = false;

    if (loadMoreBtn) {
        console.log('Load More Button Found'); // Debugging log

        loadMoreBtn.addEventListener('click', function() {
            console.log('Load More Button Clicked'); // Debugging log
            console.log('Current Page:', currentPage); // Debugging log

            if (isLoading) {
                console.log('Already loading, returning'); // Debugging log
                return;
            }
            
            isLoading = true;
            currentPage++;
            
            console.log('Fetching tours for page:', currentPage); // Debugging log

            fetch(`{{ route('tours.full-adventure') }}?page=${currentPage}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response received'); // Debugging log
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data); // Debugging log

                if (data.tours) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.tours;
                    
                    Array.from(tempDiv.children).forEach(child => {
                        tourList.appendChild(child);
                    });

                    // Hide load more button if no more tours
                    if (!data.has_more) {
                        loadMoreBtn.style.display = 'none';
                    }
                }
                isLoading = false;
            })
            .catch(error => {
                console.error('Error:', error);
                isLoading = false;
            });
        });
    } else {
        console.log('Load More Button Not Found'); // Debugging log
    }
});
</script>



@endpush


@endsection