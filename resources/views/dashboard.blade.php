
@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="mb-3">
            <h1 class="h3 font-bold">Dashboard Overview</h1>
            <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.
            </p>
        </div>

        <!-- Recent Activity -->
        {{-- <div class="dashboard-row">
            <!-- Recent Students -->
            <div class="dashboard-card">
                <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                    <h5 class="dashboard-card-title mb-0">Recent Students</h5>
                    <a href="all-students.html" class="btn btn-outline-primary btn-sm">View All</a>
                </div>
                <div class="dashboard-card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center px-0 py-3">
                            <img src="https://ui-avatars.com/api/?name=John+Smith&background=0d6efd&color=fff"
                                alt="John Smith" class="rounded-circle me-3" width="40" height="40" loading="lazy">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">John Smith</h6>
                                <small class="text-muted">Computer Science - Freshman</small>
                                <div class="small text-muted">Enrolled 2 hours ago</div>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center px-0 py-3">
                            <img src="https://ui-avatars.com/api/?name=Emily+Davis&background=198754&color=fff"
                                alt="Emily Davis" class="rounded-circle me-3" width="40" height="40" loading="lazy">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Emily Davis</h6>
                                <small class="text-muted">Biology - Sophomore</small>
                                <div class="small text-muted">Enrolled 1 day ago</div>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </div>
                        <div class="list-group-item d-flex align-items-center px-0 py-3">
                            <img src="https://ui-avatars.com/api/?name=Michael+Brown&background=dc3545&color=fff"
                                alt="Michael Brown" class="rounded-circle me-3" width="40" height="40"
                                loading="lazy">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Michael Brown</h6>
                                <small class="text-muted">Mathematics - Junior</small>
                                <div class="small text-muted">Enrolled 3 days ago</div>
                            </div>
                            <span class="badge bg-warning">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
