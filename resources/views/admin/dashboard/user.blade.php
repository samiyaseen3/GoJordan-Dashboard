<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <style>
      /* Style for soft-deleted user rows */
      .deleted {
          background-color: red;
          color: white; /* Ensures text is visible against red background */
      }
  </style>
</head>

<body>

@extends('source.template')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Table</h5>
              <a id="addUserBtn" href="{{route('user.create')}}" class="btn" style="color: #fff;background:#d97706">Add new user</a>
              <!-- Table with stripped rows -->
              <table class="table datatable mt-3">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr class="{{ $user->trashed() ? 'deleted' : '' }}">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>
                      
                        @if ($user->trashed())
                        <form id="restoreForm-{{ $user->id }}" action="{{ route('user.restore', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button type="button" class="btn btn-warning btn-sm shadow-sm" onclick="confirmRestore({{ $user->id }} , this)">
                            <i class="bi bi-arrow-counterclockwise"></i> Restore
                        </button>
                    @else
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm" style="color: white;background:#d97706">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form id="deleteForm-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">
                            <i class="bi bi-trash"></i>
                        </button>
                    @endif
                   
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </section>

</main>

@endsection
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      // Disable button on page load
      document.addEventListener('DOMContentLoaded', function() {
          var addUserButton = document.getElementById('addUserBtn');
          addUserButton.disabled = true; // Disable the button
      });

      // Confirm delete action
      function confirmDelete(userId) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById(`deleteForm-${userId}`).submit();
              }
          });
      }

      // Confirm restore action
      function confirmRestore(userId, button) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to restore this user?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                button.disabled = true;
                button.textContent = 'Restoring...';
                document.getElementById(`restoreForm-${userId}`).submit();
            }
        });
    }

      
      window.onbeforeunload = function() {
          var addUserButton = document.getElementById('addUserBtn');
          addUserButton.disabled = true; 
      }
  </script>

</body>

</html>