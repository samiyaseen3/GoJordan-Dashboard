<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Tour Date - Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
</head>

<body>

@extends('source.template')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Tour Date</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('tour_dates.index') }}">Home</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Tour Date</h5>
              
              <!-- Tour Date Edit Form -->
              <form id="tourDateForm" action="{{ route('tour_dates.update', $tourDate->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This is important for PUT requests in Laravel -->

                <!-- Tour Dropdown -->
                <div class="mb-3">
                  <label for="tour_id" class="form-label">Select Tour</label>
                  <select name="tour_id" id="tour_id" class="form-select" required>
                    <option value="" disabled>Choose a Tour</option>
                    @foreach($tours as $tour)
                      <option value="{{ $tour->id }}" {{ $tour->id == $tourDate->tour_id ? 'selected' : '' }}>{{ $tour->title }}</option>
                    @endforeach
                  </select>
                  @error('tour_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- Start Date -->
                <div class="mb-3">
                  <label for="start_date" class="form-label">Start Date</label>
                  <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $tourDate->start_date }}" required>
                  @error('start_date')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- End Date -->
                <div class="mb-3">
                  <label for="end_date" class="form-label">End Date</label>
                  <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $tourDate->end_date }}" required>
                  @error('end_date')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- Availability -->
                <div class="mb-3">
                  <label for="availability" class="form-label">Availability</label>
                  <input type="number" id="availability" name="availability" class="form-control" min="1" value="{{ $tourDate->availability }}" required>
                  @error('availability')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <!-- Submit Button -->
                <div class="text-center">
                  <button type="submit" id="submitBtn" class="btn btn-primary">Update Tour Date</button>
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
document.getElementById('tourDateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitButton = document.getElementById('submitBtn');
    submitButton.disabled = true;
    submitButton.innerHTML = "Submitting...";

    // Perform date validation
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);
    const today = new Date(new Date().toISOString().split('T')[0]);

    if (startDate < today) {
        Swal.fire({
            title: 'Validation Error',
            text: 'The start date must not be in the past.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        submitButton.disabled = false;
        submitButton.innerHTML = "Update Tour Date";
        return;
    }

    if (endDate <= startDate) {
        Swal.fire({
            title: 'Validation Error',
            text: 'The end date must be after the start date.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        submitButton.disabled = false;
        submitButton.innerHTML = "Update Tour Date";
        return;
    }

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = data.redirect;
            });
        } else {
            throw data;
        }
    })
    .catch(error => {
        let errorMessage = 'An unexpected error occurred';
        if (error.errors) {
            errorMessage = Object.values(error.errors)
                .flat()
                .join('\n');
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        Swal.fire({
            title: 'Error',
            text: errorMessage,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    })
    .finally(() => {
        submitButton.disabled = false;
        submitButton.innerHTML = "Update Tour Date";
    });
});


  // Get today's date in the format YYYY-MM-DD
  const today = new Date().toISOString().split('T')[0];

  // Set the min attribute for the start and end date input fields
  document.getElementById('start_date').setAttribute('min', today);
  document.getElementById('end_date').setAttribute('min', today);

  // Client-side Validation for Dates
  document.getElementById('tourDateForm').addEventListener('submit', function (e) {
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);

    // Reset previous error messages
    let errorMessage = '';
    
    // Check if the start date is in the past
    if (startDate < new Date(today)) {
      errorMessage = 'The start date must not be in the past.';
    } 
    // Check if the end date is the same or before the start date
    else if (endDate <= startDate) {
      errorMessage = 'The end date must be after the start date.';
    }

    if (errorMessage) {
      e.preventDefault(); // Prevent form submission

      // Show SweetAlert error message
      Swal.fire({
        title: 'Validation Error',
        text: errorMessage,
        icon: 'error',
        confirmButtonText: 'OK',
      });
    }
  });
</script>

</body>

</html>
@endsection
