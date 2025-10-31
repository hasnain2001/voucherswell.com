@extends('employee.layouts.app')
@section('title', 'employee Dashboard')
@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('employee.Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
      <!-- Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon primary">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3>$28,210</h3>
                            <p class="text-muted">Total Revenue</p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon success">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3>1,685</h3>
                            <p class="text-muted">Total Customers</p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 82%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon warning">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3>235</h3>
                            <p class="text-muted">Total Orders</p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 48%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon info">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h3>68.5%</h3>
                            <p class="text-muted">Conversion Rate</p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Tables Row -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Revenue Overview</h5>
                            <div id="revenue-chart" style="height: 320px; background: #f8f9fa; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <p class="text-muted">Revenue chart would be displayed here</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Top Products</h5>
                            <div class="activity-timeline">
                                <div class="activity-item">
                                    <h6 class="mb-1">Nike Sneakers</h6>
                                    <p class="text-muted mb-1">$128.50</p>
                                    <small class="text-muted">245 sold</small>
                                </div>
                                <div class="activity-item">
                                    <h6 class="mb-1">Adidas Shoes</h6>
                                    <p class="text-muted mb-1">$98.75</p>
                                    <small class="text-muted">198 sold</small>
                                </div>
                                <div class="activity-item">
                                    <h6 class="mb-1">Wireless Headphones</h6>
                                    <p class="text-muted mb-1">$79.99</p>
                                    <small class="text-muted">156 sold</small>
                                </div>
                                <div class="activity-item">
                                    <h6 class="mb-1">Smart Watch</h6>
                                    <p class="text-muted mb-1">$149.99</p>
                                    <small class="text-muted">132 sold</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Recent Orders</h5>
                            <div class="table-responsive">
                                <table class="table table-centered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#UB1234</td>
                                            <td>John Doe</td>
                                            <td>Nike Sneakers</td>
                                            <td>$128.50</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td>Oct 15, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>#UB1235</td>
                                            <td>Jane Smith</td>
                                            <td>Adidas Shoes</td>
                                            <td>$98.75</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td>Oct 16, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>#UB1236</td>
                                            <td>Michael Johnson</td>
                                            <td>Wireless Headphones</td>
                                            <td>$79.99</td>
                                            <td><span class="badge bg-primary">Shipped</span></td>
                                            <td>Oct 17, 2023</td>
                                        </tr>
                                        <tr>
                                            <td>#UB1237</td>
                                            <td>Emily Davis</td>
                                            <td>Smart Watch</td>
                                            <td>$149.99</td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            <td>Oct 18, 2023</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
