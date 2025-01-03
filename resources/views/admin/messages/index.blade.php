@extends('source.template')

@section('content')
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .btn-view {
            color: #fff;
            background: linear-gradient(45deg, #FA4032, #FA812F);
        }
    </style>
</head>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Contact Messages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Messages</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Messages Table</h5>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <table class="table datatable mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr data-message-id="{{ $message->id }}">
                                    <td>{{ $message->id }}</td>
                                    <td>
                                        @if(!$message->is_read)
                                            <span class="badge bg-success status-badge">New</span>
                                        @else
                                            <span class="badge bg-secondary status-badge">Read</span>
                                        @endif
                                    </td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ Str::limit($message->subject, 30) }}</td>
                                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-view btn-sm view-message" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#messageModal{{ $message->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <form action="{{ route('admin.messages.destroy', $message->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Message Modal -->
                                <!-- In both navbar.blade.php and index.blade.php, update the modal structure -->
<div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message from {{ $message->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Status:</strong> 
                    <span class="message-status">
                        @if(!$message->is_read)
                            New
                        @else
                            Read
                        @endif
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Email:</strong> {{ $message->email }}
                </div>
                <div class="mb-3">
                    <strong>Subject:</strong> {{ $message->subject }}
                </div>
                <div class="mb-3">
                    <strong>Message:</strong><br>
                    {{ $message->message }}
                </div>
                <div class="text-muted">
                    Received: {{ $message->created_at->format('M d, Y H:i') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="mailto:{{ $message->email }}" class="btn btn-view">Reply</a>
            </div>
        </div>
    </div>
</div>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Function to mark message as read
    function markMessageAsRead(messageId) {
        $.post(`/admin/messages/${messageId}/mark-as-read`, {
            _token: $('meta[name="csrf-token"]').attr('content')
        })
        .done(function(response) {
            if(response.success) {
                // Update UI elements
                updateMessageStatus(messageId);
                updateUnreadCount(response.unreadCount);
                
                // Also update the main messages table if it exists
                updateMessagesTable(messageId);
                
                // Show success notification
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Message marked as read',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    // Function to update message status in navbar
    function updateMessageStatus(messageId) {
        // Remove 'New' badge from dropdown items
        $(`.message-item[data-message-id="${messageId}"]`)
            .find('.badge.bg-success')
            .fadeOut(300, function() { $(this).remove(); });
            
        // Update the message item status in dropdown
        $(`#messageModal${messageId}`).find('.message-status').text('Read');
    }

    // Function to update the main messages table
    function updateMessagesTable(messageId) {
        // Update status badge in messages table if it exists
        $(`tr[data-message-id="${messageId}"]`)
            .find('.status-badge')
            .removeClass('bg-success')
            .addClass('bg-secondary')
            .text('Read');
    }

    // Function to update unread count everywhere
    function updateUnreadCount(count) {
        // Update main navbar badge
        const navBadge = $('.badge-number');
        if (count > 0) {
            navBadge.text(count).show();
        } else {
            navBadge.hide();
        }

        // Update dropdown header
        $('.dropdown-header').first().html(
            `You have ${count} new message(s) <a href="{{ route('admin.messages.index') }}">` +
            '<span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>'
        );
    }

    // Handle all modal opens (both in navbar and main page)
    $('.modal').on('show.bs.modal', function (e) {
        const messageId = $(this).attr('id').replace('messageModal', '');
        markMessageAsRead(messageId);
    });

    // Handle clicking on message items in navbar dropdown
    $('.message-item a').on('click', function() {
        const messageId = $(this).closest('.message-item').data('message-id');
        if (messageId) {
            markMessageAsRead(messageId);
        }
    });

    // Handle view button clicks in main messages table
    $('.view-message').on('click', function() {
        const messageId = $(this).closest('tr').data('message-id');
        if (messageId) {
            markMessageAsRead(messageId);
        }
    });
});
</script>
@endpush

@endsection