@extends('source.template')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Tour</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->


  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="col-md-12 mt-3">
              <p>Current Images: (here you can delete images if you want)</p>
              <div class="row">
                @foreach ($tour->images as $image)
    <div class="col-md-2" id="image-card-{{ $image->id }}">
        <img src="{{ asset('storage/' . $image->file_name) }}" alt="Tour Image"
            style="width: 100px; height: 100px; border-radius: 50%;">

        <!-- Image Deletion Form (hidden, we will submit it via AJAX) -->
        <form id="deleteForm-{{ $image->id }}" action="{{ route('image.delete', ['tour' => $tour->id, 'imageId' => $image->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <button type="button" class="btn btn-danger btn-sm m-3" onclick="confirmDeleteImage({{ $image->id }})">
            Delete
        </button>
    </div>
@endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Tour</h5>
            <form class="row g-3" action="{{ route('tour.update', $tour->id) }}" method="POST" id="tourForm"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <!-- Indicate this is a PUT request -->

              <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $tour->title) }}"
                  required>
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description"
                  required>{{ old('description', $tour->description) }}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price"
                  value="{{ old('price', $tour->price) }}" required>
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="duration" class="form-label">Duration (in days)</label>
                <input type="number" class="form-control" name="duration" id="duration"
                  value="{{ old('duration', $tour->duration) }}" required>
                @error('duration')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date"
                  value="{{ old('start_date', $tour->start_date) }}" required>
                @error('start_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date"
                  value="{{ old('end_date', $tour->end_date) }}" required>
                @error('end_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id" required>
                  <option value="">Select Category</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ $tour->category_id == $category->id ? 'selected' : '' }}>{{
                    $category->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="images" class="form-label">Add New Images</label>
                <input type="file" class="form-control" name="images[]" id="images" multiple>
                @error('images.*')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-md-12">
                <h5 class="card-title">Itinerary</h5>

                <!-- This is the container where new itinerary days will be added -->
                <div id="itinerary-container">
                  @foreach ($tour->itineraries as $day)
                  <div class="itinerary-day">
                    <input type="hidden" name="itinerary[{{ $loop->index }}][id]" value="{{ $day->id }}">
                    <label for="itinerary[{{ $loop->index }}][day_number]" class="form-label">Day Number</label>
                    <input type="number" name="itinerary[{{ $loop->index }}][day_number]" class="form-control"
                      value="{{ old('itinerary.' . $loop->index . '.day_number', $day->day_number) }}" required>

                    <label for="itinerary[{{ $loop->index }}][location]" class="form-label">Location</label>
                    <input type="text" name="itinerary[{{ $loop->index }}][location]" class="form-control"
                      value="{{ old('itinerary.' . $loop->index . '.location', $day->location) }}" required>

                    <label for="itinerary[{{ $loop->index }}][activity]" class="form-label">Activity</label>
                    <textarea name="itinerary[{{ $loop->index }}][activity]" class="form-control"
                      required>{{ old('itinerary.' . $loop->index . '.activity', $day->activity) }}</textarea>

                    <label for="itinerary[{{ $loop->index }}][meal_plan]" class="form-label">Meal Plan
                      (optional)</label>
                    <input type="text" name="itinerary[{{ $loop->index }}][meal_plan]" class="form-control"
                      value="{{ old('itinerary.' . $loop->index . '.meal_plan', $day->meal_plan) }}">
                  </div>
                  @endforeach
                </div>

                <button type="button" class="btn btn-primary mt-3" id="add-itinerary">Add Another Day</button>
              </div>


              <div class="text-center">
                <button type="submit" class="btn btn-primary" id="submitBtn">Update Tour</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  

</main>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.getElementById('add-itinerary').addEventListener('click', function() {
    var container = document.getElementById('itinerary-container');  // Ensure the container is identified
    var newDay = document.createElement('div');
    newDay.classList.add('itinerary-day');
    
    // Keep track of the index of the itinerary days
    var index = container.getElementsByClassName('itinerary-day').length;

    newDay.innerHTML = `
        <label for="itinerary[${index}][day_number]" class="form-label">Day Number</label>
        <input type="number" name="itinerary[${index}][day_number]" class="form-control" required>

        <label for="itinerary[${index}][location]" class="form-label">Location</label>
        <input type="text" name="itinerary[${index}][location]" class="form-control" required>

        <label for="itinerary[${index}][activity]" class="form-label">Activity</label>
        <textarea name="itinerary[${index}][activity]" class="form-control" required></textarea>

        <label for="itinerary[${index}][meal_plan]" class="form-label">Meal Plan (optional)</label>
        <input type="text" name="itinerary[${index}][meal_plan]" class="form-control">
    `;
    
    container.appendChild(newDay);  // Append the new day to the container
});


document.getElementById('tourForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the form from reloading the page

    const submitButton = document.getElementById('submitBtn');
    submitButton.disabled = true; // Disable the button
    submitButton.textContent = 'Updating...'; // Change button text

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => { throw data; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = data.redirect; // Redirect to the tour index page
            });
        }
    })
    .catch(error => {
        if (error.errors) {
            const errorMessages = Object.values(error.errors)
                .map(errorArray => errorArray.join('<br>'))
                .join('<br>');
            Swal.fire({
                title: 'Validation Error',
                html: errorMessages,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: error.message || 'An unexpected error occurred.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .finally(() => {
        submitButton.disabled = false; // Re-enable the button
        submitButton.textContent = 'Update'; // Reset button text
    });
});

function openImageModal() {
    var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
    myModal.show();
  }

  function confirmDeleteImage(imageId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this image deletion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the image deletion form if confirmed
                document.getElementById(`deleteForm-${imageId}`).submit();
            }
        });
    }



    


</script>
@endsection