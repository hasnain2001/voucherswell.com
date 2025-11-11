<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - @yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

    <!-- ✅ DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- ✅ jQuery UI (for drag & drop + autocomplete) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- ✅ Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- ✅ Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">

    @stack('styles')

    <style>
        /* ✨ Optional styling for sortable handle hover */
        .handle {
            cursor: grab;
        }
        .handle:active {
            cursor: grabbing;
        }
        tr.ui-sortable-helper {
            background: #f8f9fa;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <!-- ✅ Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- ✅ Main Content -->
    <div class="main-content">
        @include('admin.layouts.navigation')

        <div class="page-content">
            @yield('content')

            {{-- <!-- ✅ Footer -->
            <footer class="footer mt-auto py-3 bg-light border-top">
                <div class="container-fluid d-flex justify-content-between text-muted small">
                    <span>&copy; {{ date('Y') }} Ubold. All rights reserved.</span>
                    <span>Design & Developed by Themesbrand</span>
                </div>
            </footer> --}}
        </div>
    </div>

<!-- ✅ Load JS in correct order -->

<!-- jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI SECOND -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap Bundle THIRD -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- ✅ Custom App JS -->
<script src="{{ asset('admin/js/app.js') }}"></script>

<!-- ✅ Global Scripts -->
<script>
// Initialize DataTables FIRST
        const table = $('#basic-datatable').DataTable({
            responsive: true,
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pageLength: 10
        });
</script>

@stack('scripts')

    @stack('scripts')
</body>
</html>
