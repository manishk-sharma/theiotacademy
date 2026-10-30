<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - AI Salary Prediction</title>
    <!-- css links -->
    <link href="<?php echo asset_url(); ?>css/salary-predictor.css" rel="stylesheet">
    <!--bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="preload"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        .sidebar {
            height: 100vh;
            /* full viewport height */
            position: sticky;
            top: 0;
            overflow-y: auto;
            /* allows scrolling if content is taller than sidebar */
        }

        .sidebar .nav-link.active {
            background-color: #adadad;
            /* Bootstrap primary blue */
            color: #fff !important;
            border-radius: 4px;
        }
    </style>
    <script>
        if (localStorage.getItem("is_admin") !== "1") {
            // Not an admin, redirect to home page
            window.location.href = "https://www.theiotacademy.co/salary-predictor";
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <i class="fas fa-chart-line fa-2x text-white mb-2"></i>
                        <h5 class="text-white">Admin Dashboard</h5>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#" onclick="showSection('dashboard')">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" onclick="showSection('users')">
                                <i class="fas fa-users me-2"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" onclick="showSection('predictions')">
                                <i class="fas fa-chart-bar me-2"></i> Predictions
                            </a>
                        </li>
                        <li class="nav-item">
                            <p class="nav-link text-white dropdown-item" onclick="logout()">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </p>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="dropdown btn-group me-2">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome, Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                <li>
                                    <p class="dropdown-item" onclick="logout()"><i class="fas fa-sign-out-alt me-2"></i>
                                        Logout</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Section -->
                <div id="dashboard-section">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsers">
                                                0
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Predictions
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalPredictions">
                                                0
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Average Predicted Salary
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="avgSalary">
                                                $0
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Top Profession
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="topProfession">
                                                -
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Recent Predictions
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div id="recentPredictions">
                                        <!-- Recent predictions will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Top Countries
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div id="topCountries">
                                        <!-- Top countries will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Section -->
                <div id="users-section" style="display: none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                User Management
                            </h6>
                        </div>

                        <div class="card-body">
                            <!-- 🔎 Search Bar -->
                            <div class="mb-3">
                                <input type="text" id="userSearchInput" class="form-control mb-3"
                                    placeholder="Search by Username or Email..." />
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Users will be loaded here -->
                                    </tbody>
                                </table>
                                <!-- Pagination for users table -->
                                <div id="usersTable-pagination" class="mt-3 d-flex justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Predictions Section -->
                <div id="predictions-section" style="display: none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                All Predictions
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- 🔎 Search Bar -->
                            <div class="mb-3">
                                <input type="text" id="searchPredictionInput" class="form-control"
                                    placeholder="Search by Name or Profession..." />
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="predictionsTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Profession</th>
                                            <th>Current Salary</th>
                                            <th>Predicted Salary</th>
                                            <th>Country</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Predictions will be loaded here -->
                                    </tbody>
                                </table>
                                <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Prediction Detail Modal -->
    <div class="modal fade" id="predictionDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prediction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="predictionDetailContent">
                    <!-- Prediction details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--custom js-->

    <script>
        document.querySelectorAll(".sidebar .nav-link").forEach((link) => {
            link.addEventListener("click", function() {
                document.querySelectorAll(".sidebar .nav-link").forEach((item) => {
                    item.classList.remove("active");
                });
                this.classList.add("active");
            });
        });
    </script>
    <script src="https://www.theiotacademy.co/assets/dit/js/salary-predictor-admin.js"></script>
</body>

</html>