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
    <h1>Create Categories</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href={{ route('category.index') }}>Home</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create Categories</h5>
            <form class="row g-3" id="categoryForm" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
              @csrf <!-- Laravel CSRF token for security -->
          
              <!-- Category Name Field -->
              <div class="col-md-12">
                  <label for="name" class="form-label">Category Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          
              <!-- Category Description Field -->
              <div class="col-md-12">
                  <label for="description" class="form-label">Category Description</label>
                  <textarea name="description" class="form-control" id="description" rows="4">{{ old('description') }}</textarea>
                  @error('description')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          
              <!-- Category Image Field -->
              <div class="col-md-12">
                  <label for="image" class="form-label">Category Image</label>
                  <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                  @error('image')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          
              <!-- Submit Button -->
              <div class="text-center">
                  <button type="submit" class="btn" id="submitBtn" style="color: #fff;background:#d97706">Add Category</button>
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
  document.getElementById('categoryForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission
    const submitButton = document.getElementById('submitBtn');
        submitButton.disabled = true; 

        submitButton.innerHTML = "Submitting...";
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
        // Handle validation errors
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
        // Handle general errors
        Swal.fire({
          title: 'Error',
          text: error.message || 'An unexpected error occurred.',
          icon: 'error',
          confirmButtonText: 'OK',
        });
      }
    });
  });
</script>

@endsection

</body>

</html>
