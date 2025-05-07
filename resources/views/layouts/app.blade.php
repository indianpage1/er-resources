    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ST-Earning</title>
        
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        
            <!-- Custom CSS -->
            {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        
            @stack('head')  {{-- This is fine --}}
            @stack('styles') 
             {{-- ✅ Add this line here --}}
        </head>
        
    <body>
        <!-- Include Header -->
        
        <!-- Include Navbar -->
        @include('layouts.navbar')
        
        <div class="container mt-4 mb-5">
            <!-- Main content -->
            @yield('content')
        </div>
        
        <!-- Include Footer -->
        @include('layouts.header')
        @include('layouts.footer')

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        @stack('scripts')
    </body>
    </html>
