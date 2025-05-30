<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="dashboard-wrapper">
        <h2 class="mb-4 text-center">Dashboards</h2>
        <div class="row justify-content-center g-4">

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 text-center dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Timeslots</h5>
                        <p class="card-text">Add or delete timeslots.</p>
                        <a href="../cruds/timeslotcrud.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 text-center dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Appointments</h5>
                        <p class="card-text">View, edit, or delete appointments.</p>
                        <a href="../cruds/contactcrud.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 text-center dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">View, edit, or delete appointments.</p>
                        <a href="../cruds/usercrud.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>