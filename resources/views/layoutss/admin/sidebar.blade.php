<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABQ7i5L7b6VY1m6Xbg6z5lsr+VqC7qxu4Y+ZG4p5Kym3xYDLuD0o1f6" crossorigin="anonymous">
</head>
<body>
    <!-- Button to trigger sidebar toggle -->
    
    <!-- Off-Canvas Sidebar -->
<aside class="sidebar" id="offCanvasSidebar">
        <div class="sidebar-header">
            <h2></h2>
            <button class="close-btn" id="closeSidebarBtn">&times;</button>
        </div>
   <ul class="sidebar-menu">
       <li>   <a href="{{ route('admin.dashboard') }}" class="sidebar-item">Manage Dashboard</a></li>
       <li>   <a href="{{ route('plans.index') }}" class="sidebar-item">Manage Plans</a></li>
       <li>   <a href="{{ route('users.index') }}" class="sidebar-item">Manage Users</a></li>
       <li>   <a href="{{ route('contacts.index') }}" class="sidebar-item">Manage contact</a></li>
       <li>   <a href="{{ route('admin.wallet_summaries.index') }}" class="sidebar-item">Manage wallet summaires</a></li>
       <li>   <a href="{{ route('admin.transactions.index') }}" class="sidebar-item">User Transactions</a></li>
       <li>   <a href="{{ route('admin.withdrawals.index') }}" class="sidebar-item">User Withdrawl Request</a></li>
       <li>   <a href="{{ route('admin.user_plans.index') }}" class="sidebar-item">User Plan</a></li>
       <li><a href="{{ route('admin.save-accounts.index') }}" class="sidebar-item">Manage User Account</a>
  </ul>

</aside>
 
    <!-- Overlay to darken background when sidebar is active -->
    <div id="overlay" class="overlay"></div>

    <!-- Bootstrap JS and Popper.js (for tooltips and popovers) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  
    <script>
        // jQuery for opening and closing the sidebar
        $(document).ready(function() {
            // Open sidebar
            $("#openSidebarBtn").click(function() {
                $("#offCanvasSidebar").addClass("active"); // Show the sidebar
                $("#overlay").addClass("active"); // Show overlay
            });

            // Close sidebar
            $("#closeSidebarBtn").click(function() {
                $("#offCanvasSidebar").removeClass("active"); // Hide the sidebar
                $("#overlay").removeClass("active"); // Hide overlay
            });

            // Close sidebar if overlay is clicked
            $("#overlay").click(function() {
                $("#offCanvasSidebar").removeClass("active");
                $("#overlay").removeClass("active");
            });
        });
    </script>

    <style>
        /* Global styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Button to open the sidebar */
        .open-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #424547;
            color: #f4f4f5;
            border: none;
            padding: 12px 15px;
            font-size: 28px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            z-index: 2000; /* Ensure it's above other content */
            border-radius: 5px;
        }

        .open-btn:hover {
            background-color:   #424547;
            color: #ffffff;
        }

        /* Sidebar Styles */
     /* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100vh;
    background-color: #424547;
    color: white;
    transition: left 0.3s ease-in-out;
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    display: flex;
    flex-direction: column;
}

/* Sidebar active state */
.sidebar.active {
    left: 0;
}

/* Header */
.sidebar-header {
    padding: 20px;
    padding-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #424547;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

/* Header Title */
.sidebar-header h2 {
    color: white;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}

/* Close Button */
.close-btn {
    background: transparent;
    border: none;
    color: white;
    font-size: 26px;
    cursor: pointer;
}

/* Menu */
.sidebar-menu {
    list-style: none;
    padding: 10px 0;
    margin: 0;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.sidebar-menu li {
    margin: 4px 0;
}

/* Menu Item */
.sidebar-item {
    display: block;
    padding: 10px 20px;
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s ease;
    border-radius: 4px;
}

.sidebar-item:hover {
    background-color: #2e3031;
    color: #fff;
}


        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 999;
        }

        /* When sidebar is active, show overlay */
        .sidebar.active {
            left: 0;
        }

        .overlay.active {
            visibility: visible;
            opacity: 1;
        }

        /* Responsive Design for smaller screens */
        @media (max-width: 768px) {
            .open-btn {
                font-size: 30px;
                padding: 15px;
            }

            .sidebar-menu li {
                text-align: center;
            }

            .sidebar-header {
                padding-top: 30px;
                padding-bottom: 30px;
            }

            .sidebar-item {
                font-size: 20px;
            }
        }
    </style>
</body>
</html>
