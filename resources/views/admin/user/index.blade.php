@extends('admin.layouts.app')
@section('title', 'User Management')
@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="page-title mb-1">
                        <i class="fas fa-users me-2 text-primary"></i>User Management
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ubold</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Add New User
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>{{ $users->count() }}</h3>
                        <p class="text-muted">Total Users</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-icon success">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3>{{ $users->where('role', 'admin')->count() }}</h3>
                        <p class="text-muted">Administrators</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $users->count() > 0 ? ($users->where('role', 'admin')->count() / $users->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-icon warning">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3>{{ $users->where('role', 'employee')->count() }}</h3>
                        <p class="text-muted">Employees</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $users->count() > 0 ? ($users->where('role', 'employee')->count() / $users->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="stats-icon info">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3>{{ $users->where('role', 'user')->count() }}</h3>
                        <p class="text-muted">Standard Users</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-info" role="progressbar"
                                 style="width: {{ $users->count() > 0 ? ($users->where('role', 'user')->count() / $users->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table Card -->
        <div class="card shadow-lg border-0">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-list me-2"></i>Users List
                        </h5>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" placeholder="Search users..." id="searchInput">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3 border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading mb-1">Success!</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-3 border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger me-3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading mb-1">Error!</h5>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-centered mb-0" id="usersTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">User Info</th>
                                <th class="border-0">Contact</th>
                                <th class="border-0">Role</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Registered</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="user-row">
                                <td class="align-middle">
                                    <div class="fw-semibold">{{ $loop->iteration }}</div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 position-relative">
                                            @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                 alt="{{ $user->name }}"
                                                 class="rounded-circle shadow-sm"
                                                 width="48"
                                                 height="48"
                                                 onerror="this.onerror=null;this.src='{{ asset('admin/img/user.png') }}'">
                                            @else
                                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white shadow-sm"
                                                 style="width: 48px; height: 48px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            @endif
                                            @if($user->role == 'admin')
                                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-2 border-white rounded-circle">
                                                <span class="visually-hidden">Admin</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column">
                                        <a href="mailto:{{ $user->email }}" class="text-dark text-decoration-none mb-1">
                                            <i class="fas fa-envelope me-2 text-primary"></i>{{ $user->email }}
                                        </a>
                                        @if($user->phone)
                                        <small class="text-muted">
                                            <i class="fas fa-phone me-2"></i>{{ $user->phone }}
                                        </small>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if($user->role == 'admin')
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                        <i class="fas fa-crown me-1"></i>Administrator
                                    </span>
                                    @elseif($user->role == 'employee')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                        <i class="fas fa-user-tie me-1"></i>Employee
                                    </span>
                                    @else
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-user me-1"></i>Standard User
                                    </span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>Active
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $user->created_at->diffForHumans() }}</span>
                                        <small class="text-muted" data-bs-toggle="tooltip"
                                               title="{{ $user->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                            {{ $user->created_at->format('M j, Y') }}
                                        </small>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                           class="btn btn-outline-primary btn-sm rounded-start-3 px-3"
                                           data-bs-toggle="tooltip"
                                           title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-info btn-sm px-3"
                                                data-bs-toggle="tooltip"
                                                title="View Details"
                                                onclick="showUserDetails({{ $user }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm rounded-end-3 px-3 delete-btn"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete User"
                                                    data-user-name="{{ $user->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                        <h4 class="text-muted">No Users Found</h4>
                                        <p class="text-muted mb-4">Get started by creating your first user.</p>
                                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-2"></i>Add First User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- <!-- Pagination -->
                @if($users->hasPages())
                <div class="card-footer bg-white border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle me-2"></i>User Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary" id="editUserBtn">Edit User</a>
            </div>
        </div>
    </div>
</div>

<style>
.stats-card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    margin-bottom: 1.5rem;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1rem;
}

.stats-icon.primary { background: linear-gradient(135deg, #5b73e8, #4b60d2); }
.stats-icon.success { background: linear-gradient(135deg, #34c38f, #27a876); }
.stats-icon.warning { background: linear-gradient(135deg, #f1b44c, #e6a841); }
.stats-icon.info { background: linear-gradient(135deg, #50a5f1, #3d8fd6); }

.avatar-placeholder {
    font-size: 1.25rem;
}

.user-row:hover {
    background-color: rgba(91, 115, 232, 0.02);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

.empty-state {
    padding: 3rem 1rem;
}

.badge {
    font-weight: 500;
}

.progress {
    height: 6px;
    border-radius: 3px;
}

.card {
    border-radius: 1rem;
    overflow: hidden;
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #e9ecef;
}

.form-control:focus {
    border-color: #5b73e8;
    box-shadow: 0 0 0 0.2rem rgba(91, 115, 232, 0.1);
}
</style>
@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('.user-row');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Delete confirmation
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const userName = this.getAttribute('data-user-name');
        const form = this.closest('.delete-form');

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete user "${userName}". This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// User details modal
function showUserDetails(user) {
    const modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
    const content = document.getElementById('userDetailsContent');
    const editBtn = document.getElementById('editUserBtn');

    // Format registration date
    const regDate = new Date(user.created_at);
    const formattedDate = regDate.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    content.innerHTML = `
        <div class="row">
            <div class="col-md-4 text-center mb-3">
                ${user.avatar ?
                    `<img src="{{ asset('storage/') }}/${user.avatar}"
                         alt="${user.name}"
                         class="rounded-circle shadow-sm mb-3"
                         width="100"
                         height="100"
                         onerror="this.onerror=null;this.src='{{ asset('admin/img/user.png') }}'">` :
                    `<div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white shadow-sm mx-auto mb-3"
                         style="width: 100px; height: 100px;">
                        <i class="fas fa-user fa-2x"></i>
                    </div>`
                }
                <h5 class="mb-1">${user.name}</h5>
                <span class="badge ${user.role === 'admin' ? 'bg-danger' : user.role === 'employee' ? 'bg-warning' : 'bg-success'}">
                    ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                </span>
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-muted mb-1">Email Address</label>
                        <p class="mb-0">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <a href="mailto:${user.email}" class="text-decoration-none">${user.email}</a>
                        </p>
                    </div>
                    ${user.phone ? `
                    <div class="col-12">
                        <label class="form-label text-muted mb-1">Phone Number</label>
                        <p class="mb-0">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            ${user.phone}
                        </p>
                    </div>
                    ` : ''}
                    <div class="col-12">
                        <label class="form-label text-muted mb-1">User ID</label>
                        <p class="mb-0">
                            <i class="fas fa-id-card me-2 text-primary"></i>
                            ${user.id}
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted mb-1">Registration Date</label>
                        <p class="mb-0">
                            <i class="fas fa-calendar me-2 text-primary"></i>
                            ${formattedDate}
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted mb-1">Last Updated</label>
                        <p class="mb-0">
                            <i class="fas fa-clock me-2 text-primary"></i>
                            ${new Date(user.updated_at).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            })}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    `;

    editBtn.href = `/admin/user/${user.id}/edit`;
    modal.show();
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Export functionality (optional)
function exportUsers(format) {
    // Implement export functionality here
    alert(`Exporting users as ${format.toUpperCase()} - This would be implemented with a backend endpoint.`);
}
</script>
@endpush
