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
      <h1>Categories</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('category.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Categories</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Category Table</h5>
              <a href="{{ route('category.create') }}" class="btn" style="color: #fff;background:#d97706">Add new category</a>
              <table class="table datatable mt-3">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>Name</th>
                    <th>Discription</th>
                    {{-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> --}}
                    <th>image</th>
                    <th>actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                      <tr>
                          <td>{{ $category->id }}</td>
                          <td>{{ $category->name }}</td>
                          <td>{{ $category->description }}</td>
                          <td>
                              
                              <img src="{{ asset('storage/' . $category->image) }}" 
                                   alt="{{ $category->name }}" 
                                   style="width: 50px; height: 50px; border-radius: 10%;">
                          </td>
                          <td>
                             
                                @if ($category->trashed())
                                <!-- Restore form -->
                                <form id="restoreForm-{{ $category->id }}" action="{{ route('category.restore', $category->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <button type="button" class="btn btn-warning btn-sm shadow-sm" onclick="confirmRestore({{ $category->id }} , this)">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            @else
                                <!-- If the user is not deleted, show the edit and delete buttons -->
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm" style="color: #fff;background:#d97706">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            
                                <form id="deleteForm-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $category->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                            
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


@endsection
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
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
      function confirmRestore(categoryId, button) {
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to restore this category?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!'
    }).then((result) => {
        if (result.isConfirmed) {
            button.disabled = true;
            button.textContent = 'Restoring...';
            document.getElementById(`restoreForm-${categoryId}`).submit();
        }
    });
}

  </script>
</body>

</html>