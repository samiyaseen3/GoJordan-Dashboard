@extends('userside.source.template')
@section('content')


<style>

.carousel-item img {
        height: 300px; /* Set the desired fixed height */
        object-fit: cover; /* Ensures the image covers the area without distortion */
    }

    /* Price styling - similar to your original style */
    .carousel-price {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #f15d30; /* Customize color */
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
    .ftco-navbar-light{
        background: #000 !important;
    }
</style>

<section class="ftco-section"> 
    <div class="container mt-5">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Tours</span>
                <h2 class="mb-4">Search Results for "{{ $query }}"</h2>
            </div>
        </div>

        <!-- Tour Listing -->
        <div class="row" id="tour-list">
            @if($tours->isEmpty())
                <div class="col-md-12 text-center">
                    <p>No tours found matching your search.</p>
                </div>
            @else
                @foreach($tours as $tour)
                    <div class="col-md-4 ftco-animate tour-card">
                        <div class="project-wrap">
                            <div id="carousel{{ $tour->id }}" class="carousel slide carousel-wrapper" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($tour->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . ($image->file_name ?? 'default.jpg')) }}" class="d-block w-100" alt="Tour Image">
                                            <span class="carousel-price">${{ $tour->price }}/person</span>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel{{ $tour->id }}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel{{ $tour->id }}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="text p-4">
                                <span class="days">{{ $tour->duration }} Days</span>
                                <h3><a href="{{ route('tour.details', ['id' => $tour->id]) }}">{{ $tour->title }}</a></h3>
                                <p class="location"><span class="fa fa-map-marker"></span> {{ $tour->category->name ?? 'Uncategorized' }}</p>
                                <a href="{{ route('tour.details', ['id' => $tour->id]) }}" class="btn btn-primary">View Tour</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


@endsection