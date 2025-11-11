@extends('layouts.master')
@section('title', 'User Dashboard')
@section('description', 'Manage your account, view your activities, and access exclusive features.')
@section('keywords', 'dashboard, user profile, account management')

@push('styles')
<style>
    :root {
        --gold-primary: #d6a751;
        --gold-light: #f9e076;
        --gold-dark: #b8860b;
        --dark-teal: #145f59;
        --dark-teal-light: #1a7a72;
        --dark-teal-dark: #0f4a45;
        --gradient-gold: linear-gradient(135deg, #f9e076 0%, #d4af37 50%, #b8860b 100%);
        --gradient-teal: linear-gradient(135deg, #145f59 0%, #1a7a72 100%);
        --light-gradient: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    /* Dashboard Header */
    .dashboard-header {
        background: var(--gradient-teal);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    .dashboard-header-content {
        position: relative;
        z-index: 2;
    }

    .welcome-text {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .welcome-subtext {
        font-size: 1.2rem;
        opacity: 0.95;
        font-weight: 300;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    /* User Profile Card */
    .profile-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .profile-header {
        background: var(--gradient-gold);
        padding: 2rem;
        text-align: center;
        color: #000;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid white;
        margin: 0 auto 1rem;
        background: var(--light-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--dark-teal);
        font-weight: bold;
    }

    .user-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .user-email {
        opacity: 0.8;
        font-size: 1rem;
    }

    .profile-body {
        padding: 2rem;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-left: 4px solid var(--gold-primary);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .stat-icon.primary { background: rgba(214, 167, 81, 0.15); color: var(--gold-dark); }
    .stat-icon.success { background: rgba(40, 167, 69, 0.15); color: #28a745; }
    .stat-icon.info { background: rgba(23, 162, 184, 0.15); color: #17a2b8; }
    .stat-icon.warning { background: rgba(255, 193, 7, 0.15); color: #ffc107; }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-teal);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Quick Actions */
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.12);
        border-color: var(--gold-primary);
        color: inherit;
        text-decoration: none;
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--light-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: var(--dark-teal);
        transition: all 0.3s ease;
    }

    .action-card:hover .action-icon {
        background: var(--gradient-gold);
        color: #000;
    }

    .action-title {
        font-weight: 600;
        color: var(--dark-teal);
        margin-bottom: 0.5rem;
    }

    .action-description {
        color: #666;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    /* Recent Activity */
    .activity-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
        border: none;
    }

    .card-header-custom {
        background: var(--gradient-teal);
        color: white;
        border: none;
        padding: 1.5rem;
        border-radius: 15px 15px 0 0 !important;
    }

    .card-header-custom h3 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background-color: #f8f9fa;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--light-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--dark-teal);
        font-size: 1rem;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        color: var(--dark-teal);
        margin-bottom: 0.25rem;
    }

    .activity-time {
        color: #666;
        font-size: 0.85rem;
    }

    /* Logout Section */
    .logout-section {
        background: var(--light-gradient);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        border: 1px solid #e9ecef;
    }

    .logout-btn {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 2rem 0;
        }

        .welcome-text {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .profile-header {
            padding: 1.5rem;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .welcome-text {
            font-size: 1.7rem;
        }

        .actions-grid {
            grid-template-columns: 1fr;
        }

        .activity-item {
            padding: 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="container">
        <div class="dashboard-header-content">
            <h1 class="welcome-text">Welcome Back, {{ Auth::user()->name }}! 👋</h1>
            <p class="welcome-subtext">Here's what's happening with your account today</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Stats Overview -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-number">24</div>
                    <div class="stat-label">Coupons Used</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="stat-number">$156.80</div>
                    <div class="stat-label">Total Savings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Favorite Stores</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">8</div>
                    <div class="stat-label">Active Deals</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-4">
                <h3 class="mb-3" style="color: var(--dark-teal); font-weight: 700;">Quick Actions</h3>
                <div class="actions-grid">
                    <a href="{{ route('coupons', ['lang' => app()->getLocale()]) }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="action-title">Find Coupons</div>
                        <div class="action-description">Discover new deals and discounts</div>
                    </a>
                    <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="action-title">Browse Stores</div>
                        <div class="action-description">Explore partner stores</div>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="action-title">Edit Profile</div>
                        <div class="action-description">Update your information</div>
                    </a>
                    <a  href="{{ route('deals', ['lang' => app()->getLocale()]) }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="action-title">Favorites</div>
                        <div class="action-description">View saved items</div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-card">
                <div class="card-header card-header-custom">
                    <h3><i class="fas fa-history me-2"></i>Recent Activity</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Used coupon at Amazon</div>
                                <div class="activity-time">2 hours ago • Saved $12.50</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Added Walmart to favorites</div>
                                <div class="activity-time">Yesterday at 3:24 PM</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Rated Best Buy deal</div>
                                <div class="activity-time">October 26, 2024</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-share"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Shared deal with friends</div>
                                <div class="activity-time">October 25, 2024</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Reached $150 total savings!</div>
                                <div class="activity-time">October 24, 2024</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- User Profile Card -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-email">{{ Auth::user()->email }}</div>
                </div>
                <div class="profile-body">
                    <div class="mb-3">
                        <strong>Member Since:</strong>
                        <p class="text-muted mb-0">{{ Auth::user()->created_at->format('F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Account Status:</strong>
                        <span class="badge bg-success">Active</span>
                    </div>
                    <div class="mb-3">
                        <strong>Membership Tier:</strong>
                        <span class="badge bg-warning text-dark">Premium Saver</span>
                    </div>
                    <div class="d-grid">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Special Offers -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-gift me-2"></i>Special Offers</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info border-0 mb-3">
                        <small><i class="fas fa-info-circle me-1"></i> <strong>Exclusive Deal:</strong> Get 20% extra cashback on first purchase this week!</small>
                    </div>
                    <div class="alert alert-success border-0">
                        <small><i class="fas fa-bolt me-1"></i> <strong>Flash Sale:</strong> Limited time offers ending soon!</small>
                    </div>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="logout-section">
                <h5 class="mb-3" style="color: var(--dark-teal);">Ready to leave?</h5>
                <p class="text-muted mb-3">Make sure to save your progress before logging out.</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animations to cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Animate stat cards
        document.querySelectorAll('.stat-card, .action-card, .activity-card, .profile-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Add click animation to buttons
        document.querySelectorAll('.btn, .action-card, .logout-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Simulate loading animation for stats
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const finalValue = parseInt(stat.textContent.replace('$', '').replace(',', ''));
            let current = 0;
            const increment = finalValue / 20;
            const timer = setInterval(() => {
                current += increment;
                if (current >= finalValue) {
                    clearInterval(timer);
                    stat.textContent = stat.textContent.includes('$') ? '$' + finalValue : finalValue;
                } else {
                    stat.textContent = stat.textContent.includes('$') ? '$' + Math.floor(current) : Math.floor(current);
                }
            }, 50);
        });
    });
</script>
@endpush
