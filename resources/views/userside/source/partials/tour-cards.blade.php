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
                <h3><a href="">{{ $tour->title }}</a></h3>
                <p class="location"><span class="fa fa-map-marker"></span> {{ $tour->category->name ?? 'Uncategorized' }}</p>
                <a href="" class="btn btn-primary">View Tour</a>
            </div>
        </div>
    </div>
@endforeach