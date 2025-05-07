<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/home') }}">ER-Earning</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plans') }}">Plans</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <!-- New Earning Page Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reward.index') }}">Earning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('withdrawal.form') }}">Withdraw</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light ms-2 nav-link px-3"
                                    style="border-color: #aaa; color: #ccc;">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2 nav-link px-3" href="{{ route('login') }}"
                           style="border-color: #aaa; color: #ccc;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2 nav-link px-3" href="{{ route('register') }}"
                           style="border-color: #aaa; color: #ccc;">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


<style>
.navbar {
    padding: 15px 20px;
    font-family: 'Segoe UI', sans-serif;
    transition: all 0.3s ease-in-out;
}

.navbar-brand {
    font-size: 1.7rem;
    letter-spacing: 0.5px;
    color: #cccccc !important;
}

.navbar-nav .nav-link {
    color: #ddd;
    font-weight: 500;
    transition: color 0.2s ease-in-out;
}

.navbar-nav .nav-link:hover {
    color: #9ec5fe !important; /* Light blue hover for class */
}

.btn-outline-light.nav-link {
    border-radius: 30px;
    transition: all 0.3s ease-in-out;
    font-weight: 500;
}

.btn-outline-light.nav-link:hover {
    background-color: #9ec5fe;
    color: #000 !important;
    border-color: #9ec5fe;
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .navbar-nav .nav-item {
        margin-bottom: 10px;
        text-align: center;
    }
}


</style>