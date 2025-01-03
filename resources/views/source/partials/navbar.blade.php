<!-- ======= Header ======= -->
<link href="{{asset('assets/img/favicon.png')}}" rel="icon">
<link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

<style>
    .btn-view {
        color: #fff;
        background: linear-gradient(45deg, #FA4032, #FA812F);
    }
    .dropdown-menu-arrow.messages {
        max-height: 400px;
        overflow-y: auto;
    }
    .message-item {
        transition: background-color 0.3s;
    }
    .message-item:hover {
        background-color: #f6f9ff;
    }
</style>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between logo-color">
        <a href="{{ route('dashboard.index') }}" class="logo d-flex align-items-center">
            <h2 style="color:#000"><span style="color: #d97706;">Go</span>Jordan</h2>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <!-- Search Icon for Mobile -->
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <!-- Messages Nav -->
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    @if($unreadMessages > 0)
                        <span class="badge bg-success badge-number">{{ $unreadMessages }}</span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have {{ $unreadMessages }} new message(s)
                        <a href="{{ route('admin.messages.index') }}">
                            <span class="badge rounded-pill bg-primary p-2 ms-2">View all</span>
                        </a>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>

                    @forelse($recentMessages as $message)
                        <li class="message-item" data-message-id="{{ $message->id }}">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}">
                                <div>
                                    <h4>{{ $message->name }}</h4>
                                    <p>{{ Str::limit($message->subject, 35) }}</p>
                                    <p class="text-muted mb-0">
                                        <small>{{ $message->created_at->diffForHumans() }}</small>
                                        @if(!$message->is_read)
                                            <span class="badge bg-success">New</span>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @empty
                        <li class="message-item text-center py-3">
                            <p class="text-muted mb-0">No new messages</p>
                        </li>
                    @endforelse

                    <li class="dropdown-footer">
                        <a href="{{ route('admin.messages.index') }}">Show all messages</a>
                    </li>
                </ul>
            </li>

            <!-- Profile Nav -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->role }}</span>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>



                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center" href="#" 
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<!-- Message Modals -->
@foreach($recentMessages as $message)
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

@push('scripts')
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
            }
        });
    }

    // Function to update message status in UI
    function updateMessageStatus(messageId) {
        // Update status in navbar dropdown
        const messageItem = $(`.message-item[data-message-id="${messageId}"]`);
        messageItem.find('.badge.bg-success').remove();
    }

    // Function to update unread count everywhere
    function updateUnreadCount(count) {
        // Update navbar badge
        const navBadge = $('.nav-link .badge-number');
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

    // Handle modal open event
    $('.message-item a').on('click', function() {
        const messageId = $(this).closest('.message-item').data('message-id');
        if (messageId) {
            markMessageAsRead(messageId);
        }
    });
});
</script>
@endpush