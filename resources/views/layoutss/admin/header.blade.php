
        <div class="header-content">
            <h1 class="logo">Earning Resources</h1>
            <button class="open-btn" id="openSidebarBtn">&#9776; </button>

            <!-- Search bar (hidden on mobile) -->
            <div class="profile-section d-none d-md-flex">
                <input type="text" class="search-bar" placeholder="Search..." />
            </div>
        </div>

        <!-- Navigation Bar -->


<style>
/* Header Flexbox Adjustments */
.search-bar {
    padding: 10px 20px;
    width: 240px;
    border: none;
    border-radius: 30px;
    background-color: #f0f0f0;
    font-size: 15px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.search-bar::placeholder {
    color: #aaa;
    transition: color 0.3s ease;
}

.search-bar:focus {
    outline: none;
    background-color: #fff;
    border: 2px solid #5fa8d3;
    box-shadow: 0 0 8px rgba(95, 168, 211, 0.5);
}

.search-bar:hover {
    background-color: #e9ecef;
}

@media (max-width: 768px) {
    .search-bar {
        width: 100%;
        max-width: 200px;
        font-size: 14px;
    }
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    background-color: #424547;
    padding: 30px
}

/* Center logo by default on larger screens */
.logo {
    color: white;
    font-size: 32px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin: 0 auto; /* center horizontally */
}

/* Responsive: Adjust layout for mobile */
@media (max-width: 768px) {
    .header-content {
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .logo {
        margin: 0;
        font-size: 26px;
        text-align: right;
        width: 100%;
    }

    .profile-section {
        display: none !important; /* Hide search bar on small screens */
    }
}

</style>
