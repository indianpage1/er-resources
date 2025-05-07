<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Add your CSS links here -->
    
    @stack('styles')
</head>
<body>
    @include('layoutss.admin.header') <!-- Include header -->
    
    
    
    @include('layoutss.admin.sidebar') <!-- Include sidebar -->
    
    
    <div class="container mt-4 mb-5">
        <!-- Main content -->
        @yield('content')
    </div>
    
    @include('layoutss.admin.footer') <!-- Include footer -->
    
</body>
</html>
