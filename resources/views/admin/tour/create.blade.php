<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Create Tour</title>
</head>

<body>

@extends('source.template')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create Tour</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href={{ route('tour.index') }}>Home</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create Tour</h5>
            <form class="row g-3" action="{{ route('tour.store') }}" method="POST" id="tourForm" enctype="multipart/form-data">
              @csrf
              <div class="col-md-6">
                <label for="inputTitle" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="inputPrice" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" required>
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="inputDuration" class="form-label">Duration (in days)</label>
                <input type="number" class="form-control" name="duration" id="duration" value="{{ old('duration') }}" required>
                @error('duration')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                @error('end_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id" required>
                    <!-- Assuming categories are passed from the controller -->
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="images" class="form-label">Tour Images</label>
                <input type="file" class="form-control" name="images[]" id="images" multiple required>
                @error('images')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-12">
                <label for="itinerary" class="form-label">Itinerary</label>
                <div id="itinerary-container">
                    <div class="itinerary-day">
                        <label for="itinerary[0][day_number]" class="form-label">Day Number</label>
                        <input type="number" name="itinerary[0][day_number]" class="form-control" value="1" required>
            
                        <label for="itinerary[0][location]" class="form-label">Location</label>
                        <input type="text" name="itinerary[0][location]" class="form-control" required>
            
                        <label for="itinerary[0][activity]" class="form-label">Activity</label>
                        <textarea name="itinerary[0][activity]" class="form-control" required></textarea>
            
                        <label for="itinerary[0][meal_plan]" class="form-label">Meal Plan (optional)</label>
                        <input type="text" name="itinerary[0][meal_plan]" class="form-control">
                    </div>
                </div>
                <button type="button" class="btn mt-3" id="add-itinerary" style="color: #fff;background:#d97706">Add Another Day</button>
              </div>

            <div class="text-center">
              <button type="submit" class="btn" id="submitBtn" style="color: #fff;background:#d97706">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
       document.getElementById('add-itinerary').addEventListener('click', function () {
    // Get the container holding all itinerary items
    var itineraryContainer = document.getElementById('itinerary-container');

    // Get the last day number, or default to 0 if no items exist
    var lastDayNumber = itineraryContainer.querySelectorAll('.itinerary-day').length;

    // Calculate the new day number
    var newDayNumber = lastDayNumber + 1;

    // Generate the new itinerary day HTML
    var newItineraryDay = `
        <div class="itinerary-day">
            <h4>Day ${newDayNumber}</h4>
            <label for="itinerary[${newDayNumber - 1}][day_number]" class="form-label">Day Number</label>
            <input type="number" name="itinerary[${newDayNumber - 1}][day_number]" 
                   class="form-control" value="${newDayNumber}" readonly required>

            <label for="itinerary[${newDayNumber - 1}][location]" class="form-label">Location</label>
            <input type="text" name="itinerary[${newDayNumber - 1}][location]" 
                   class="form-control" required>

            <label for="itinerary[${newDayNumber - 1}][activity]" class="form-label">Activity</label>
            <textarea name="itinerary[${newDayNumber - 1}][activity]" 
                      class="form-control" required></textarea>

            <label for="itinerary[${newDayNumber - 1}][meal_plan]" class="form-label">Meal Plan (optional)</label>
            <input type="text" name="itinerary[${newDayNumber - 1}][meal_plan]" 
                   class="form-control">
        </div>
    `;

    // Append the new itinerary day to the container
    itineraryContainer.insertAdjacentHTML('beforeend', newItineraryDay);
});


  // Get today's date in the required format (YYYY-MM-DD)
  var today = new Date().toISOString().split('T')[0];

  // Set the 'min' attribute of the start date input field to today's date
  document.getElementById('start_date').setAttribute('min', today);
  
  // Set the 'min' attribute of the end date input field to today's date
  document.getElementById('end_date').setAttribute('min', today);

  // Ensure that the end date is after the start date
  document.getElementById('start_date').addEventListener('change', function () {
      var startDate = document.getElementById('start_date').value;
      document.getElementById('end_date').setAttribute('min', startDate);
  });

  // Ensure that the end date cannot be before the start date
  document.getElementById('end_date').addEventListener('change', function () {
      var startDate = document.getElementById('start_date').value;
      var endDate = document.getElementById('end_date').value;
      if (endDate < startDate) {
          alert("End date must be after start date.");
          document.getElementById('end_date').value = ''; // Clear the invalid end date
      }
  });

  document.getElementById('tourForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from reloading the page

    const submitButton = document.getElementById('submitBtn');
    submitButton.disabled = true; // Disable the button
    submitButton.textContent = 'Submitting...'; // Change button text

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
        submitButton.textContent = 'Add Tour'; // Reset button text
    });
});
</script>

@endsection

</body>
</html>
