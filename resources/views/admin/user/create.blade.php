<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <style>
    .text-danger {
      color: red;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }
  </style>
</head>

<body>

@extends('source.template')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href={{ route('user.index') }}>Home</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create User</h5>
            <form class="row g-3" action="{{ route('user.store') }}" method="POST" id="userForm">
              @csrf
              <div class="col-md-6">
                <label for="inputLastName" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" class="form-select" name="gender">
                  <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                  <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <div class="input-group">
                    <input type="tel" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                </div>
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">
                    Please enter a valid phone number with your country code (e.g., +962 for Jordan). The number should start with the country code followed by the phone number.
                </small>
            </div>
              <div class="col-md-6">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
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
    document.getElementById('userForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById('submitBtn');
        submitButton.disabled = true; 
        submitButton.innerHTML = "Submitting...";

        const formData = new FormData(this);

        // Handle phone number formatting and validation
        const phoneNumber = iti.getNumber();
        formData.set('phone_number', phoneNumber);

        fetch(this.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then((data) => {
                    throw data;
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
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = data.redirect; // Redirect to the index page
                });
            }
        })
        .catch(error => {
            if (error.errors) {
                // Handle validation errors
                let errorMessages = Object.values(error.errors)
                    .map(errorArray => errorArray.join('<br>'))
                    .join('<br>');

                Swal.fire({
                    title: 'Validation Error',
                    html: errorMessages,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                // Handle general errors
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'An unexpected error occurred.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .finally(() => {
            submitButton.disabled = false; // Re-enable the button if an error occurs
            submitButton.innerHTML = "Submit"; // Reset the button text
        });
    });

    const phoneInput = document.querySelector("#phone_number");
    const iti = window.intlTelInput(phoneInput, {
        initialCountry: "auto", // Detect country code automatically
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // Get the phone number with the country code when form is submitted
    document.getElementById("userForm").addEventListener('submit', function (e) {
        if (!iti.isValidNumber()) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: "Please enter a valid phone number with the correct country code.",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
</script>

@endsection

</body>

</html>
