<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
</head>

<body>

@extends('source.template')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Tour Date</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('tour_dates.index') }}">Home</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Tour Date</h5>
              
              <!-- Tour Date Form -->
              <form id="tourDateForm" action="{{ route('tour_dates.store') }}" method="POST">
                @csrf
  
                <!-- Tour Dropdown -->
                <div class="mb-3">
                  <label for="tour_id" class="form-label">Select Tour</label>
                  <select name="tour_id" id="tour_id" class="form-select" required>
                    <option value="" disabled selected>Choose a Tour</option>
                    @foreach($tours as $tour)
                      <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                    @endforeach
                  </select>
                  @error('tour_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- Start Date -->
                <div class="mb-3">
                  <label for="start_date" class="form-label">Start Date</label>
                  <input type="date" id="start_date" name="start_date" class="form-control" required>
                  @error('start_date')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- End Date -->
                <div class="mb-3">
                  <label for="end_date" class="form-label">End Date</label>
                  <input type="date" id="end_date" name="end_date" class="form-control" required>
                  @error('end_date')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- Availability -->
                <div class="mb-3">
                  <label for="availability" class="form-label">Availability</label>
                  <input type="number" id="availability" name="availability" class="form-control" min="1" required>
                  @error('availability')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- Submit Button -->
                <div class="text-center">
                  <button type="submit" id="submitBtn" class="btn btn-primary">Add Tour Date</button>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Get today's date in the format YYYY-MM-DD
  const today = new Date().toISOString().split('T')[0];

  // Set the min attribute for the start and end date input fields
  document.getElementById('start_date').setAttribute('min', today);
  document.getElementById('end_date').setAttribute('min', today);

  // Single event listener for form submission
  document.getElementById('tourDateForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission
    const submitButton = document.getElementById('submitBtn');
    submitButton.disabled = true; 
    submitButton.innerHTML = "Submitting...";

    // Date Validation
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);

    let errorMessage = '';

    // Check if the start date is in the past
    if (startDate < new Date(today)) {
      errorMessage = 'The start date must not be in the past.';
    } 
    // Check if the end date is the same or before the start date
    else if (endDate <= startDate) {
      errorMessage = 'The end date must be after the start date.';
    }

    // If validation fails
    if (errorMessage) {
      submitButton.disabled = false;
      submitButton.innerHTML = "Add Tour Date";

      // Show SweetAlert error message
      Swal.fire({
        title: 'Validation Error',
        text: errorMessage,
        icon: 'error',
        confirmButtonText: 'OK',
      });
    } else {
      // If validation passes, submit the form using AJAX
      const formData = new FormData(this); // Get form data

      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'Accept': 'application/json', // Accept JSON response
        },
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            throw data; // Throw validation errors for catch block
          });
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          Swal.fire({
            title: 'Success!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK',
          }).then(() => {
            window.location.href = data.redirect; // Redirect to index page
          });
        }
      })
      .catch(error => {
        if (error.errors) {
          const errorMessages = Object.values(error.errors)
            .map(errors => errors.join('<br>'))
            .join('<br>');

          Swal.fire({
            title: 'Validation Error',
            html: errorMessages,
            icon: 'error',
            confirmButtonText: 'OK',
          });
        } else {
          Swal.fire({
            title: 'Error',
            text: error.message || 'An unexpected error occurred.',
            icon: 'error',
            confirmButtonText: 'OK',
          });
        }
      });
    }
  });
</script>
</body>

</html>
@endsection
